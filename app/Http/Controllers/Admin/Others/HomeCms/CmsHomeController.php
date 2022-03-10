<?php

namespace App\Http\Controllers\Admin\Others\HomeCms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CMS\CmsHomeModel;

class CmsHomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $getHomeQuery = CmsHomeModel::get();
        return view('admin.dashboard.pages.other-pages.home',compact('getHomeQuery'));
    }
    public function submit_fx(Request $request){
        $getChooseQuery = CmsHomeModel::get();
        if(count($getChooseQuery) > 0)
        {
            foreach ($getChooseQuery as $key_value) {
                $getChooseImg1 = $key_value->largest_collection_of_courses_img;
                $getChooseImg2 = $key_value->welcome_to_kanani_image_name;
                $getChooseImg3 = $key_value->lets_see_online_education_image;
            }
            #img1
            if($request->hasFile('largest_collection_of_courses_img')){
                $img1 = $request->file('largest_collection_of_courses_img')->store('public/cms/home');
            }else{
                $img1 = $getChooseImg1;
            }
            #img2
            if($request->hasFile('welcome_to_kanani_image_name')){
                $img2 = $request->file('welcome_to_kanani_image_name')->store('public/cms/home');
            }else{
                $img2 = $getChooseImg2;
            }
            #img3
            if($request->hasFile('lets_see_online_education_image')){
                $img3 = $request->file('lets_see_online_education_image')->store('public/cms/home');
            }else{
                $img3 = $getChooseImg3;
            }
            $insertArr = [ 
                "largest_collection_of_courses_name"  => $request->input('largest_collection_of_courses_name'), "largest_collection_of_courses_paragraph_name"  => $request->input('largest_collection_of_courses_paragraph_name'), "largest_collection_of_courses_img"  => $img1, 
                "welcome_to_kanani_name"  => $request->input('welcome_to_kanani_name'), 
                "welcome_to_kanani_paragraph_name"  => $request->input('welcome_to_kanani_paragraph_name'), 
                "welcome_to_kanani_image_name"  => $img2, 
                "lets_see_online_education_name"  => $request->input('lets_see_online_education_name'), "lets_see_online_education_description_name"  => $request->input('lets_see_online_education_description_name'), "lets_see_online_education_image"  => $img3, 
                "install_zoom_heading_name"  => $request->input('install_zoom_heading_name'),
                "install_zoom_paragraph_name"  => $request->input('install_zoom_paragraph_name'),
                "join_a_trail_class_heading_name" => $request->input('join_a_trail_class_heading_name'), 
                "join_a_trail_class_paragraph_name" => $request->input('join_a_trail_class_paragraph_name'), 
                "select_a_course_class_heading_name" => $request->input('select_a_course_class_heading_name'), 
                "select_a_course_class_paragraph_name" => $request->input('select_a_course_class_paragraph_name'), "start_your_journey_class_heading_name" => $request->input('start_your_journey_class_heading_name'), "start_your_journey_class_paragraph_name" => $request->input('start_your_journey_class_paragraph_name'), 
                "blog_class_heading_name" => $request->input('blog_class_heading_name'), 
                "blog_class_paragraph_name" => $request->input('blog_class_paragraph_name'), 
                "our_courses_class_heading_name" => $request->input('our_courses_class_heading_name'), 
                "our_courses_class_paragraph_name" => $request->input('our_courses_class_paragraph_name'),
                "updated_at" => date('Y-m-d H:i:s')
            ];
            $insertQuery = CmsHomeModel::where('id',1)->update($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully updated');
            }else{
                $request->session()->flash('error_msg','Something went wrong');
            }
            return redirect()->back();
        }else{
            #img1
            if($request->hasFile('largest_collection_of_courses_img')){
                $img1 = $request->file('largest_collection_of_courses_img')->store('public/cms/home');
            }else{
                $img1 = "";
            }
            #img2
            if($request->hasFile('welcome_to_kanani_image_name')){
                $img2 = $request->file('welcome_to_kanani_image_name')->store('public/cms/home');
            }else{
                $img2 = "";
            }
            #img3
            if($request->hasFile('lets_see_online_education_image')){
                $img3 = $request->file('lets_see_online_education_image')->store('public/cms/home');
            }else{
                $img3 = "";
            }
            $insertArr = [
                "largest_collection_of_courses_name"  => $request->input('largest_collection_of_courses_name'), "largest_collection_of_courses_paragraph_name"  => $request->input('largest_collection_of_courses_paragraph_name'), "largest_collection_of_courses_img"  => $img1, 
                "welcome_to_kanani_name"  => $request->input('welcome_to_kanani_name'), 
                "welcome_to_kanani_paragraph_name"  => $request->input('welcome_to_kanani_paragraph_name'), 
                "welcome_to_kanani_image_name"  => $img2, 
                "lets_see_online_education_name"  => $request->input('lets_see_online_education_name'), "lets_see_online_education_description_name"  => $request->input('lets_see_online_education_description_name'), "lets_see_online_education_image"  => $img3, 
                "install_zoom_heading_name"  => $request->input('install_zoom_heading_name'),
                "install_zoom_paragraph_name"  => $request->input('install_zoom_paragraph_name'),
                "join_a_trail_class_heading_name" => $request->input('join_a_trail_class_heading_name'), 
                "join_a_trail_class_paragraph_name" => $request->input('join_a_trail_class_paragraph_name'), 
                "select_a_course_class_heading_name" => $request->input('select_a_course_class_heading_name'), 
                "select_a_course_class_paragraph_name" => $request->input('select_a_course_class_paragraph_name'), "start_your_journey_class_heading_name" => $request->input('start_your_journey_class_heading_name'), "start_your_journey_class_paragraph_name" => $request->input('start_your_journey_class_paragraph_name'), 
                "blog_class_heading_name" => $request->input('blog_class_heading_name'), 
                "blog_class_paragraph_name" => $request->input('blog_class_paragraph_name'), 
                "our_courses_class_heading_name" => $request->input('our_courses_class_heading_name'), 
                "our_courses_class_paragraph_name" => $request->input('our_courses_class_paragraph_name'),
                "created_at" => date('Y-m-d H:i:s'), 
                "updated_at" => date('Y-m-d H:i:s')
            ];
            $insertQuery = CmsHomeModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully inserted');
            }else{
                $request->session()->flash('error_msg','Something went wrong');
            }
            return redirect()->back();
        }
    }
}
