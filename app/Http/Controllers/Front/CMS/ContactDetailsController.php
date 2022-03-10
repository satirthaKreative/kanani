<?php

namespace App\Http\Controllers\Front\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CMS\CmsContactDetailsModel;

class ContactDetailsController extends Controller
{
    public function index(Request $request){
        $getCMSquery = CmsContactDetailsModel::get();
        if(count($getCMSquery) > 0){
            foreach($getCMSquery as $getCMSq){
                $html['contact_number'] = $getCMSq->cms_phone_number;
                $html['email_address'] = $getCMSq->cms_email_address;
                $html['cms_facebook'] = $getCMSq->cms_facebook;
                $html['cms_instagram'] = $getCMSq->cms_instagram;
                $html['cms_twitter'] = $getCMSq->cms_twitter;
                $html['cms_youtube'] = $getCMSq->cms_youtube;
                $html['cms_copyright'] = $getCMSq->cms_copyright;
                $html['cms_footer_head'] = $getCMSq->cms_footer_heading;
                $html['cms_footer_content'] = $getCMSq->cms_footer_content;
            }
        }else{
            $html['contact_number'] = "";
            $html['email_address'] = "";
            $html['cms_facebook'] = "";
            $html['cms_instagram'] = "";
            $html['cms_twitter'] = "";
            $html['cms_youtube'] = "";
            $html['cms_copyright'] = "";
            $html['cms_footer_head'] = "";
            $html['cms_footer_content'] = "";
        }
        echo json_encode($html);
    }
}
