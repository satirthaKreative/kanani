<?php

namespace App\Http\Controllers\Admin\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CMS\CmsContactDetailsModel;

class ContactDetailsController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $getCMSquery = CmsContactDetailsModel::get();
        return view('admin.dashboard.pages.cms.contact-details',compact('getCMSquery'));
    }

    public function contact_details_submit_fx(Request $request){
        $phone_number = $request->input('user_name');
        $email_address = $request->input('user_email');
        $cms_facebook = $request->input('cms_facebook');
        $cms_instagram = $request->input('cms_instagram');
        $cms_twitter = $request->input('cms_twitter');
        $cms_youtube = $request->input('cms_youtube');
        $cms_copyright = $request->input('cms_copyright');
        $cms_footer_heading = $request->input('cms_footer_heading');
        $cms_footer_content = $request->input('cms_footer_content');

        if($phone_number == null || $phone_number == ""){
            $request->session()->flash('error_msg','Contact number cannot be empty');
        }else if($email_address == null || $email_address == ""){
            $request->session()->flash('error_msg','Email address cannot be empty');
        }else if($cms_facebook == null || $cms_facebook == ""){
            $request->session()->flash('error_msg','Facebook link cannot be empty');
        }else if($cms_instagram == null || $cms_instagram == ""){
            $request->session()->flash('error_msg','Instagram link cannot be empty');
        }else if($cms_twitter == null || $cms_twitter == ""){
            $request->session()->flash('error_msg','Twitter link cannot be empty');
        }else if($cms_youtube == null || $cms_youtube == ""){
            $request->session()->flash('error_msg','Youtube link cannot be empty');
        }else if($cms_copyright == null || $cms_copyright == ""){
            $request->session()->flash('error_msg','Copyright cannot be empty');
        }else if($cms_footer_heading == null || $cms_footer_heading == ""){
            $request->session()->flash('error_msg','Footer heading cannot be empty');
        }else if($cms_footer_content == null || $cms_footer_content == ""){
            $request->session()->flash('error_msg','Footer content cannot be empty');
        }else{
            $checkingCMSquery = CmsContactDetailsModel::get();
            if(count($checkingCMSquery) > 0){
                $insertArr = [
                    "cms_phone_number" => $phone_number, 
                    "cms_email_address" => $email_address, 
                    "cms_facebook" => $cms_facebook, 
                    "cms_instagram" => $cms_instagram, 
                    "cms_twitter" => $cms_twitter, 
                    "cms_youtube" => $cms_youtube, 
                    "cms_copyright" => $cms_copyright, 
                    "cms_footer_heading" => $cms_footer_heading, 
                    "cms_footer_content" => $cms_footer_content,
                    "created_at" => date('Y-m-d H:i:s'), 
                    "updated_at" => date('Y-m-d H:i:s')
                ];
                $insertQuery = CmsContactDetailsModel::where('id',1)->update($insertArr);
                if($insertQuery){
                    $request->session()->flash('success_msg','Successfully updated');
                }else{
                    $request->session()->flash('error_msg','Something went wrong! Try again later');
                }
            }else{
                $insertArr = [
                    "cms_phone_number" => $phone_number, 
                    "cms_email_address" => $email_address, 
                    "cms_facebook" => $cms_facebook, 
                    "cms_instagram" => $cms_instagram, 
                    "cms_twitter" => $cms_twitter, 
                    "cms_youtube" => $cms_youtube, 
                    "cms_copyright" => $cms_copyright, 
                    "cms_footer_heading" => $cms_footer_heading, 
                    "cms_footer_content" => $cms_footer_content,
                    "created_at" => date('Y-m-d H:i:s'), 
                    "updated_at" => date('Y-m-d H:i:s')
                ];
                $insertQuery = CmsContactDetailsModel::insert($insertArr);
                if($insertQuery){
                    $request->session()->flash('success_msg','Successfully enter details');
                }else{
                    $request->session()->flash('error_msg','Something went wrong! Try again later');
                }
            }
        }
        return redirect()->back();
    }
}