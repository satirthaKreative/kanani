<?php

namespace App\Http\Controllers\Admin\CMS\testimonials;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CMS\testimonials\CustomersModel;

class CustomersController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $getComments = CustomersModel::where('post_state','active')->get();
        return view('admin.dashboard.pages.cms.testimonials.testimonials',compact('getComments'));
    }

    public function submit_testimonials_fx(Request $request){
        $customer_id = $request->input('customer_id');
        if($customer_id == 0 || $customer_id == "0"){
            if($request->hasFile('customers_images')){
                $img = $request->file('customers_images')->store('public/customerTestimonials');
            }else{
                $img = "";
            }
            $insertArr = [
                "customers_images" => $img, 
                "customer_comment" => $request->input('customer_comment'), 
                "customer_name" => $request->input('customer_name'), 
                "customer_email" => $request->input('customer_email'), 
                "customer_post" => $request->input('customer_post'), 
                "post_state" => 'active',
                "created_at" => date('Y-m-d H:i:s'), 
                "updated_at" => date('Y-m-d H:i:s')
            ];
            $insertQuery = CustomersModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully inserted');
            }else{
                $request->session()->flash('error_msg','Something went wrong! Try again');
            }
        }else{
            $checkQuery = CustomersModel::where('id',$customer_id)->get();
            if($request->hasFile('customers_images')){
                $img = $request->file('customers_images')->store('public/customerTestimonials');
            }else{
                foreach($checkQuery as $cQuery){
                    $img = $cQuery->customers_images;
                }
            }
            $insertArr = [
                "customers_images" => $img, 
                "customer_comment" => $request->input('customer_comment'), 
                "customer_name" => $request->input('customer_name'), 
                "customer_email" => $request->input('customer_email'), 
                "customer_post" => $request->input('customer_post'), 
                "post_state" => 'active',
                "updated_at" => date('Y-m-d H:i:s')
            ];
            $insertQuery = CustomersModel::where('id',$customer_id)->update($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully updated');
            }else{
                $request->session()->flash('error_msg','Something went wrong! Try again');
            }
        }
        return redirect()->back();
    }

    public function update_testimonials_show(Request $request, $id){
        $getComments = CustomersModel::where('id',$id)->get();
        return view('admin.dashboard.pages.cms.testimonials.edit-testimonials',compact('getComments'));
    }

    public function delete_testimonials_show(Request $request){
        $deleteQuery = CustomersModel::where('id',$_GET['id'])->delete();
        if($deleteQuery){
            $msg = "success";
        }else{
            $msg = "error";
        }
        echo json_encode($msg);
    }
}
