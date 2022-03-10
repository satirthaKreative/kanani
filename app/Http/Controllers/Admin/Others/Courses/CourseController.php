<?php

namespace App\Http\Controllers\Admin\Others\Courses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CMS\CmsMainCoursesModel;
use App\Model\Backend\CMS\Courses\AllCoursesModel;
use App\Model\Backend\CMS\Courses\CourseStructureModel;

class CourseController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $chooseQuery = CmsMainCoursesModel::get();
        return view('admin.dashboard.pages.cms.courses.main-courses',compact('chooseQuery'));
    }

    public function submit_fx(Request $request){
        $getChooseQuery = CmsMainCoursesModel::get();
        if(count($getChooseQuery) > 0)
        {
            $insertArr = [
                "headline" => $request->input('headline'), 
                "main_description" => $request->input('main_description'), 
                "kids_english_course" => $request->input('kids_english_course'),
                "kids_english_course_short_description" => $request->input('kids_english_course_short_description'), 
                "teen_english_course_short_description" => $request->input('teen_english_course_short_description'),  
                "adult_english_course_short_description" => $request->input('adult_english_course_short_description'),
                "kids_price" => $request->input('kids_english_courses_price_name'), 
                "teen_english_course" => $request->input('teen_english_course'), 
                "teen_price" => $request->input('teen_english_courses_price_name'), 
                "adult_english_course" => $request->input('adult_english_course'), 
                "adult_price" => $request->input('adult_english_courses_price_name'), 
                "lets_see_online_education" => $request->input('lets_see_online_education'), 
                "lets_see_online_education_description" => $request->input('lets_see_online_education_des'), 
                "updated_at" => date('Y-m-d H:i:s')
            ];
            $insertQuery = CmsMainCoursesModel::where('id',1)->update($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully updated');
            }else{
                $request->session()->flash('error_msg','Something went wrong');
            }
            return redirect()->back();
        }else{
            $insertArr = [
                "headline" => $request->input('headline'), 
                "main_description" => $request->input('main_description'), 
                "kids_english_course" => $request->input('kids_english_course'),
                "kids_english_course_short_description" => $request->input('kids_english_course_short_description'), 
                "teen_english_course_short_description" => $request->input('teen_english_course_short_description'),  
                "adult_english_course_short_description" => $request->input('adult_english_course_short_description'), 
                "kids_price" => $request->input('kids_english_courses_price_name'), 
                "teen_english_course" => $request->input('teen_english_course'), 
                "teen_price" => $request->input('teen_english_courses_price_name'), 
                "adult_english_course" => $request->input('adult_english_course'), 
                "adult_price" => $request->input('adult_english_courses_price_name'), 
                "lets_see_online_education" => $request->input('lets_see_online_education'), 
                "lets_see_online_education_description" => $request->input('lets_see_online_education_des'), 
                "created_at" => date('Y-m-d H:i:s'), 
                "updated_at" => date('Y-m-d H:i:s')
            ];
            $insertQuery = CmsMainCoursesModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully inserted');
            }else{
                $request->session()->flash('error_msg','Something went wrong');
            }
            return redirect()->back();
        }
    }

    public function adult_child_teen_courses_fx(Request $request){
        $chooseQuery = AllCoursesModel::get();
        return view('admin.dashboard.pages.other-pages.courses.adult-teen-kids',compact('chooseQuery'));
    }

    public function adult_child_teen_courses_submit_fx(Request $request){
        $getChooseQuery = AllCoursesModel::where('course_user_type',$request->input('course_user_type'))->get();
        if(count($getChooseQuery) > 0)
        {
            foreach ($getChooseQuery as $key_value) {
                $getChooseImg1 = $key_value->main_img;
                $getChooseImg2 = $key_value->get_started_img;
                $getChooseImg3 = $key_value->lets_see_online_img;
            }
            #img1
            if($request->hasFile('main_img')){
                $img1 = $request->file('main_img')->store('public/courses/cms');
            }else{
                $img1 = $getChooseImg1;
            }
            #img2
            if($request->hasFile('get_started_img')){
                $img2 = $request->file('get_started_img')->store('public/courses/cms');
            }else{
                $img2 = $getChooseImg2;
            }
            #img3
            if($request->hasFile('lets_see_online_img')){
                $img3 = $request->file('lets_see_online_img')->store('public/courses/cms');
            }else{
                $img3 = $getChooseImg3;
            }
            $insertArr = [
                'main_img' => $img1, 
                'main_course_type' => $request->input('main_course_type'), 
                'total_chapters' => $request->input('total_chapters'), 
                'total_lessons' => $request->input('total_lessons'), 
                'course_heading' => $request->input('course_heading'), 
                'course_description' => $request->input('course_description'), 
                'get_started_img' => $img2, 
                'get_started_video_link' => $request->input('get_started_video_link'),
                'get_started_heading' => $request->input('get_started_heading'), 
                'get_started_discount_price' => $request->input('get_started_discount_price'), 
                'get_started_total_price' => $request->input('get_started_total_price'), 
                'get_started_percentage_price' => $request->input('get_started_percentage_price'), 
                'this_course_includes_heading' => $request->input('this_course_includes_heading'), 
                'this_course_includes_paragraph' => $request->input('this_course_includes_paragraph'),
                'lets_see_online_img' => $img3,
                'lets_see_online_upper_heading' => $request->input('lets_see_online_upper_heading'), 
                'lets_see_online_main_heading' => $request->input('lets_see_online_main_heading'), 
                'lets_see_online_main_paragraph' => $request->input('lets_see_online_main_paragraph'), 
                'course_user_type' => $request->input('course_user_type'), 
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $insertQuery = AllCoursesModel::where('course_user_type',$request->input('course_user_type'))->update($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully updated');
            }else{
                $request->session()->flash('error_msg','Something went wrong');
            }
            return redirect()->back();
        }else{
            #img1
            if($request->hasFile('main_img')){
                $img1 = $request->file('main_img')->store('public/courses/cms');
            }else{
                $img1 = "";
            }
            #img2
            if($request->hasFile('get_started_img')){
                $img2 = $request->file('get_started_img')->store('public/courses/cms');
            }else{
                $img2 = "";
            }
            #img3
            if($request->hasFile('lets_see_online_img')){
                $img3 = $request->file('lets_see_online_img')->store('public/courses/cms');
            }else{
                $img3 = "";
            }
            $insertArr = [
                'main_img' => $img1, 
                'main_course_type' => $request->input('main_course_type'), 
                'total_chapters' => $request->input('total_chapters'), 
                'total_lessons' => $request->input('total_lessons'), 
                'course_heading' => $request->input('course_heading'), 
                'course_description' => $request->input('course_description'), 
                'get_started_img' => $img2, 
                'get_started_video_link' => $request->input('get_started_video_link'),
                'get_started_heading' => $request->input('get_started_heading'), 
                'get_started_discount_price' => $request->input('get_started_discount_price'), 
                'get_started_total_price' => $request->input('get_started_total_price'), 
                'get_started_percentage_price' => $request->input('get_started_percentage_price'), 
                'this_course_includes_heading' => $request->input('this_course_includes_heading'), 
                'this_course_includes_paragraph' => $request->input('this_course_includes_paragraph'),
                'lets_see_online_img' => $img3,
                'lets_see_online_upper_heading' => $request->input('lets_see_online_upper_heading'), 
                'lets_see_online_main_heading' => $request->input('lets_see_online_main_heading'), 
                'lets_see_online_main_paragraph' => $request->input('lets_see_online_main_paragraph'), 
                'course_user_type' => $request->input('course_user_type'), 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $insertQuery = AllCoursesModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully inserted');
            }else{
                $request->session()->flash('error_msg','Something went wrong');
            }
            return redirect()->back();
        }
    }

    public function edit_adult_child_teen_courses_fx(Request $request, $id){
        $chooseQuery = AllCoursesModel::where('id',$id)->get();
        return view('admin.dashboard.pages.other-pages.courses.edit-adult-teen-kids',compact('chooseQuery'));
    }

    public function course_structure_fx(Request $request, $id){
        $chooseQuery = AllCoursesModel::where('id',$id)->get();
        foreach($chooseQuery as $cQuery){
            $courseStructure = $cQuery->course_user_type;
        }
        $courseStructureQuery = CourseStructureModel::where('course_user_type',$courseStructure)->get();
        return view('admin.dashboard.pages.other-pages.courses.course-structure',compact('chooseQuery','courseStructureQuery'));
    }

    public function course_structure_submit_fx(Request $request){
            $getUseTypeQuery = AllCoursesModel::where('id',$request->input('course_structure_name'))->get();
            foreach($getUseTypeQuery as $gQuery){
                $user_type_name = $gQuery->course_user_type;
            }
            $insertArr = [
                'course_type' => $request->input('course_type'), 
                'course_details' => $request->input('course_details'), 
                'course_lessons' => $request->input('course_lessons'), 
                'course_units' => $request->input('course_units'), 
                'course_duration' => $request->input('course_duration'), 
                'age_type' => $request->input('age_type'), 
                'course_user_type' => $user_type_name, 
                'cms_course_main_tbl_id' => $request->input('course_structure_name'), 
                'created_at' => date("y-m-d H:i:s"), 
                'updated_at' => date("y-m-d H:i:s")
            ];
            $insertQuery = CourseStructureModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully inserted');
            }else{
                $request->session()->flash('error_msg','Something went wrong');
            }
            return redirect()->back();
    }

    public function edit_course_structure_fx(Request $request, $id){
        $courseStructureQuery = CourseStructureModel::where('id',$id)->get();
        return view('admin.dashboard.pages.other-pages.courses.edit-course-structure',compact('courseStructureQuery'));
    }

    public function edit_course_structure_submit_fx(Request $request){
        
        $insertArr = [
            'course_type' => $request->input('course_type'), 
            'course_details' => $request->input('course_details'), 
            'course_lessons' => $request->input('course_lessons'), 
            'course_units' => $request->input('course_units'), 
            'course_duration' => $request->input('course_duration'), 
            'age_type' => $request->input('age_type'), 
            'cms_course_main_tbl_id' => $request->input('course_structure_name'), 
            'updated_at' => date("y-m-d H:i:s")
        ];
        $insertQuery = CourseStructureModel::where('id',$request->input('course_structure_name'))->update($insertArr);
        if($insertQuery){
            $request->session()->flash('success_msg','Successfully updated');
        }else{
            $request->session()->flash('error_msg','Something went wrong');
        }
        return redirect()->back();
    }

}