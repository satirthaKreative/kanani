<?php

namespace App\Http\Controllers\Admin\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CoursePackageModel;
use App\Model\Backend\MainCourseModel;
use Illuminate\Support\Facades\DB;

class CoursePackageController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $mainCourse = MainCourseModel::get();
        $coursePackageQuery = DB::table('course_package_tbls')
                                    ->select('course_package_tbls.id','course_package_tbls.no_of_lessons_per_month','course_package_tbls.price_per_month','course_package_tbls.package_status','course_package_tbls.course_id','course_main_tbls.main_course_name')  
                                    ->join('course_main_tbls','course_package_tbls.course_id','=','course_main_tbls.id')                      
                                    ->get();
        return view('admin.dashboard.pages.course.course-package',compact('coursePackageQuery','mainCourse'));
    }

    public function add_course_package(Request $request){
        $main_course_name = $request->input('main_course_name');
        $no_of_lesson_per_month = $request->input('no_of_lesson_name');
        $lesson_price_per_month = $request->input('lesson_price_name');

        if($main_course_name == "" || $main_course_name == null){
            $request->session()->flash('error_msg','Please choose a course');
        }else if($no_of_lesson_per_month == "" || $no_of_lesson_per_month == null){
            $request->session()->flash('error_msg','Please enter a number of lessons per month');
        }else if($no_of_lesson_per_month == "" || $no_of_lesson_per_month == null){
            $request->session()->flash('error_msg','Please enter price per month');
        }else{
            $checkingQuery = CoursePackageModel::where(['course_id' => $main_course_name, 'no_of_lessons_per_month' => $no_of_lesson_per_month])->get();
            if(count($checkingQuery) > 0){
                $request->session()->flash('error_msg','Already this package added before');
            }else{
                $insertArr = [
                    'course_id' => $main_course_name, 
                    'no_of_lessons_per_month' => $no_of_lesson_per_month, 
                    'price_per_month' => $lesson_price_per_month, 
                    'package_status' => 'active', 
                    'created_at' => date('Y-m-d H:i:s'), 
                    'updated_at' => date('Y-m-d H:i:s')
                ];
        
                $insertQuery = CoursePackageModel::insert($insertArr);
                if($insertQuery){
                    $request->session()->flash('success_msg', 'Successfully added');
                }else{
                    $request->session()->flash('error_msg', 'Something went wrong! Try again');
                }
            }
        }
        return redirect()->back();
    }

    public function change_course_status_fx(Request $request)
    {
        $change_course_query = CoursePackageModel::where('id',$_GET['id'])->update(['package_status' => $_GET['new_state']]);
        $msg = "error";
        if($change_course_query)
        {
            $msg = "success";
        }
        echo json_encode($msg);
    }

    public function delete_course_package(Request $request)
    {
        $delete_id = $_GET['id'];
        $deleteQuery = CoursePackageModel::where('id',$delete_id)->delete();
        $msg = "error";
        if($deleteQuery)
        {
            $msg = "success";
        }
        echo json_encode($msg);
    }

    public function edit_course_package(Request $request)
    {
        $editMainCourseQuery = CoursePackageModel::where('id',$_GET['id'])->get();
        $html['no_of_lessons_per_month'] = ""; 
        $html['price_per_month'] = "";
        $html['main_courses'] = '<option value="">Choose Main Course</option>';
        if(count($editMainCourseQuery) > 0)
        {
            foreach($editMainCourseQuery as $editMQuery)
            {
                $html['no_of_lessons_per_month'] = $editMQuery->no_of_lessons_per_month;
                $html['price_per_month'] = $editMQuery->price_per_month;

                $coursePackage = MainCourseModel::get();
                
                foreach($coursePackage as $cPackage)
                {
                    $selected = "";
                    if($cPackage->id == $editMQuery->course_id)
                    {
                        $selected = "selected";
                    }
                    $html['main_courses'] .= '<option value="'.$cPackage->id.'"  '.$selected.'>'.ucwords($cPackage->main_course_name).'</option>';
                }
            }
        }
        echo json_encode($html);
    }

    public function update_course_package(Request $request)
    {
        $main_course_name = $request->input('main_course_name');
        $no_of_lesson_per_month = $request->input('no_of_lesson_name');
        $lesson_price_per_month = $request->input('lesson_price_name');
        $course_package_hidden_name = $request->input('course_package_hidden_name');

        if($main_course_name == "" || $main_course_name == null){
            $request->session()->flash('error_msg','Please choose a course');
        }else if($no_of_lesson_per_month == "" || $no_of_lesson_per_month == null){
            $request->session()->flash('error_msg','Please enter a number of lessons per month');
        }else if($no_of_lesson_per_month == "" || $no_of_lesson_per_month == null){
            $request->session()->flash('error_msg','Please enter price per month');
        }else{
            $checkingQuery = CoursePackageModel::where('id','!=',$course_package_hidden_name)->where(['course_id' => $main_course_name, 'no_of_lessons_per_month' => $no_of_lesson_per_month])->get();
            if(count($checkingQuery) > 0){
                $request->session()->flash('error_msg','Already this package added before');
            }else{
                $insertArr = [
                    'course_id' => $main_course_name, 
                    'no_of_lessons_per_month' => $no_of_lesson_per_month, 
                    'price_per_month' => $lesson_price_per_month, 
                    'package_status' => 'active', 
                    'updated_at' => date('Y-m-d H:i:s')
                ];
        
                $insertQuery = CoursePackageModel::where('id',$course_package_hidden_name)->update($insertArr);
                if($insertQuery){
                    $request->session()->flash('success_msg', 'Successfully updated');
                }else{
                    $request->session()->flash('error_msg', 'Something went wrong! Try again');
                }
            }
        }
        return redirect()->back();
    }
}