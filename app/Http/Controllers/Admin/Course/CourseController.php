<?php

namespace App\Http\Controllers\Admin\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CourseModel;
use App\Model\Backend\MainCourseModel;
use App\Model\Backend\CourseAgeModel;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        // course 
        $courseQuery = CourseModel::get();
        // main course 
        $mainCourseQuery = MainCourseModel::get();
        // age course
        $mainAgeQuery = CourseAgeModel::get();

        $courseAllQuery = DB::table('course_tbls')
                            ->select('course_tbls.id','course_tbls.course_name','course_tbls.no_of_units','course_tbls.no_of_lessons','course_tbls.times_in_minutes', 'course_tbls.topic_name','course_age_tbls.age_from','course_age_tbls.age_to','course_main_tbls.main_course_name','course_tbls.course_status','course_tbls.course_total_price')
                            ->join('course_age_tbls','course_age_tbls.id','=','course_tbls.age_id')
                            ->join('course_main_tbls','course_main_tbls.id','=','course_tbls.main_course_id')
                            ->get();

        return view('admin.dashboard.pages.course.course',compact('courseQuery','mainCourseQuery','mainAgeQuery','courseAllQuery'));
    }

    public function change_course_status_fx(Request $request)
    {
        $change_course_query = CourseModel::where('id',$_GET['id'])->update(['course_status' => $_GET['update_state']]);
        $msg = "error";
        if($change_course_query)
        {
            $msg = "success";
        }
        echo json_encode($msg);
    }

    public function course_del_fx(Request $request)
    {
        $delete_id = $_GET['id'];
        $deleteQuery = CourseModel::where('id',$delete_id)->delete();
        $msg = "error";
        if($deleteQuery)
        {
            $msg = "success";
        }
        echo json_encode($msg);
    }

    // course age
    public function add_age_of_course(Request $request)
    {
        $from_age = $request->input('from_age_name');
        $to_age = $request->input('to_age_name');

        $ageQuery = CourseAgeModel::where(['age_from' => $from_age, 'age_to' => $to_age])->get();
        if(count($ageQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This age group already added');
        }
        else
        {
            $insertArr = [
                "age_from" => $from_age, 
                "age_to" => $to_age,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ];
    
            $insertQuery = CourseAgeModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Successfully added');
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
            }
        }
        return redirect()->back();
    }

    public function edit_age_of_course(Request $request)
    {
        $editMainCourseQuery = CourseAgeModel::where('id',$_GET['id'])->get();
        $html['from_age'] = ""; 
        $html['to_age'] = "";
        if(count($editMainCourseQuery) > 0)
        {
            foreach($editMainCourseQuery as $editMQuery)
            {
                $html['from_age'] = $editMQuery->age_from;
                $html['to_age'] = $editMQuery->age_to;
            }
        }
        echo json_encode($html);
    }

    public function update_age_of_course(Request $request)
    {
        $from_age = $request->input('edit_from_age_name');
        $to_age = $request->input('edit_to_age_name');
        $course_id = $request->input('course_age_hidden_name');

        if($from_age > $to_age)
        {
            $request->session()->flash('error_msg', "From-age cannot greater than To-age ");
        }
        else if($from_age == $to_age)
        {
            $request->session()->flash('error_msg', "From-age cannot be same with To-age ");
        }
        else
        {
            $insertArr = [
                "age_from" => $from_age, 
                "age_to" => $to_age,
                "updated_at" => date('Y-m-d H:i:s')
            ];
    
            $insertQuery = CourseAgeModel::where('id',$course_id)->update($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Successfully updated');
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
            }
        }
        return redirect()->back();
    }

    public function delete_age_of_course(Request $request)
    {
        $delete_id = $_GET['id'];
        $deleteQuery = CourseAgeModel::where('id',$delete_id)->delete();
        $msg = "error";
        if($deleteQuery)
        {
            $msg = "success";
        }
        echo json_encode($msg);
    }

    // end of course age 

    // main course

    public function add_main_of_course(Request $request)
    {
        $main_course_name = $request->input('main_course_name');

        $ageQuery = MainCourseModel::where(['main_course_name' => strtolower($main_course_name)])->get();
        if(count($ageQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This course already added');
        }
        else
        {
            $insertArr = [ 
                "main_course_name" => strtolower($main_course_name),
                "user_role" => $request->input('user_role'),
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ];
    
            $insertQuery = MainCourseModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Successfully added');
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
            }
        }
        return redirect()->back();
    }

    public function edit_main_of_course(Request $request)
    {
        $getMainCourse = MainCourseModel::where('id',$_GET['id'])->get();
        $html['main_course'] = "";
        $html['user_role'] = "";
        if(count($getMainCourse) > 0)
        {
            foreach ($getMainCourse as $key_value) {
                $html['main_course'] = $key_value->main_course_name;
                // main user role
                $html['user_role'] = '<option value="">Choose a user role</option>';
                $check_user_role1 = '';
                if($key_value->user_role == 1)
                {
                    $check_user_role1 = 'selected';
                }
                $html['user_role'] .= '<option value="1" '.$check_user_role1.'>Child</option>';
                $check_user_role2 = '';
                if($key_value->user_role == 2)
                {
                    $check_user_role2 = 'selected';
                }
                $html['user_role'] .= '<option value="2" '.$check_user_role2.'>Teen</option>';
                $check_user_role3 = '';
                if($key_value->user_role == 3)
                {
                    $check_user_role3 = 'selected';
                }
                $html['user_role'] .= '<option value="3" '.$check_user_role3.'>Adult</option>';
            }
        }
        echo json_encode($html);
    }

    public function update_main_of_course(Request $request)
    {
        $main_course_name = $request->input('edit_main_course_name');
        $edit_main_course_id = $request->input('edit_main_course_hidden_name');

        $mainCheckQuery = MainCourseModel::where('id','!=',$edit_main_course_id)->where('main_course_name',$main_course_name)->get();
        if(count($mainCheckQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This course already added');
        }
        else
        {
            $insertArr = [ 
                "main_course_name" => strtolower($main_course_name),
                "user_role" => $request->input('edit_user_role'),
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ];
    
            $updateQuery = MainCourseModel::where('id',$edit_main_course_id)->update($insertArr);
            if($updateQuery){
                $request->session()->flash('success_msg', 'Successfully updated');
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
            }
        }
        return redirect()->back();
    }


    public function delete_main_of_course(Request $request)
    {
        $delete_id = $_GET['id'];
        $deleteQuery = MainCourseModel::where('id',$delete_id)->delete();
        $msg = "error";
        if($deleteQuery)
        {
            $msg = "success";
        }
        echo json_encode($msg);
    }

    // end of main course

    // add course details
    public function add_course_fx(Request $request)
    {
        $role_name = $request->input('main_role_name');
        $main_course_name = $request->input('main_course_name');
        $sub_course_name = $request->input('sub_course_name');
        $main_age_name = $request->input('main_age_name');
        $no_unit_name = $request->input('no_unit_name');
        $no_lessons_name = $request->input('no_lessons_name');
        $no_of_course_duration_name = $request->input('no_of_course_duration_name');
        $topic_name = $request->input('topics_name');
        $course_in_month = $request->input('no_of_month_duration_name');

        if($role_name == "" || $role_name == null)
        {
            $request->session()->flash('error_msg', 'Please choose a role');
        }
        else if($main_course_name == "" || $main_course_name == null)
        {
            $request->session()->flash('error_msg', 'Please choose a course name');
        }
        else if($main_age_name == "" || $main_age_name == null)
        {
            $request->session()->flash('error_msg', 'Please choose a age group');
        }
        else 
        {
            $checkQuery = CourseModel::where(['course_name' => strtolower($sub_course_name), 'main_course_id' => $main_course_name, 'topic_name' => strtolower($topic_name), 'age_id' => $main_age_name])->get();
            if(count($checkQuery) > 0)
            {
                $request->session()->flash('error_msg', 'This course package already added');
            }
            else
            {
                $insertArr = [ 
                    'course_name' => strtolower($sub_course_name), 
                    'user_role' => $role_name, 
                    'course_price' => 0, 
                    'main_course_id' => $main_course_name, 
                    'age_id' => $main_age_name, 
                    'no_of_units' => $no_unit_name, 
                    'no_of_lessons' => $no_lessons_name, 
                    'times_in_minutes' => $no_of_course_duration_name, 
                    'topic_name' => strtolower($topic_name),
                    'course_in_month' => $course_in_month,
                    'course_total_price' => $request->input('course_total_price'),
                    'course_status' => 'active', 
                    'created_at' => date('Y-m-d'), 
                    'updated_at' => date('Y-m-d')
                ];
        
                $updateQuery = CourseModel::insert($insertArr);
                if($updateQuery){
                    $request->session()->flash('success_msg', 'Successfully inserted');
                }else{
                    $request->session()->flash('error_msg', 'Something went wrong! Try again');
                }
            }
        }
        return redirect()->back();
    }


    public function course_update_fx(Request $request)
    {
        $role_name = $request->input('main_role_name');
        $main_course_name = $request->input('main_course_name');
        $sub_course_name = $request->input('sub_course_name');
        $main_age_name = $request->input('main_age_name');
        $no_unit_name = $request->input('no_unit_name');
        $no_lessons_name = $request->input('no_lessons_name');
        $no_of_course_duration_name = $request->input('no_of_course_duration_name');
        $topic_name = $request->input('topics_name');
        $course_in_month = $request->input('no_of_month_duration_name');

        if($role_name == "" || $role_name == null)
        {
            $request->session()->flash('error_msg', 'Please choose a role');
        }
        else if($main_course_name == "" || $main_course_name == null)
        {
            $request->session()->flash('error_msg', 'Please choose a course name');
        }
        else if($main_age_name == "" || $main_age_name == null)
        {
            $request->session()->flash('error_msg', 'Please choose a age group');
        }
        else 
        {
            $checkQuery = CourseModel::where(['course_name' => strtolower($sub_course_name), 'main_course_id' => $main_course_name, 'topic_name' => strtolower($topic_name), 'age_id' => $main_age_name])->where('id','!=',$request->input('course_edit_hidden_id_name'))->get();
            if(count($checkQuery) > 0)
            {
                $request->session()->flash('error_msg', 'This course package already added');
            }
            else
            {
                $insertArr = [ 
                    'course_name' => strtolower($sub_course_name), 
                    'user_role' => $role_name, 
                    'course_price' => 0, 
                    'main_course_id' => $main_course_name, 
                    'age_id' => $main_age_name, 
                    'no_of_units' => $no_unit_name, 
                    'no_of_lessons' => $no_lessons_name, 
                    'times_in_minutes' => $no_of_course_duration_name, 
                    'topic_name' => strtolower($topic_name),
                    'course_in_month' => $course_in_month,
                    'course_total_price' => $request->input('total_course_amount'),
                    'course_status' => 'active', 
                    'created_at' => date('Y-m-d'), 
                    'updated_at' => date('Y-m-d')
                ];
        
                $updateQuery = CourseModel::where('id',$request->input('course_edit_hidden_id_name'))->update($insertArr);
                if($updateQuery){
                    $request->session()->flash('success_msg', 'Successfully updated');
                }else{
                    $request->session()->flash('error_msg', 'Something went wrong! Try again');
                }
            }
        }
        return redirect()->back();
    }


    public function course_edit_fx(Request $request)
    {
        $courseQuery = CourseModel::where('id',$_GET['id'])->get();
        foreach($courseQuery as $cQuery)
        {
            $html['sub_course_name'] = $cQuery->course_name;
            
            // main course name
            $html['main_course_name'] = '<option value="">Choose a main course</option>';
            $mainCourseQuery = MainCourseModel::get();
            foreach($mainCourseQuery as $mainCourse)
            {
                $mainSelection = "";
                if($cQuery->main_course_id == $mainCourse->id)
                {
                    $mainSelection = "selected";
                }
                $html['main_course_name'] .= '<option value="'.$mainCourse->id.'" '.$mainSelection.'>'.$mainCourse->main_course_name.'</option>';
            }

            // main age name
            $html['age_course_name'] = '<option value="">Choose a course age</option>';
            $mainAgeQuery = CourseAgeModel::get();
            foreach($mainAgeQuery as $mainAge)
            {
                $ageSelection = "";
                if($cQuery->age_id == $mainAge->id)
                {
                    $ageSelection = "selected";
                }
                $html['age_course_name'] .= '<option value="'.$mainAge->id.'" '.$ageSelection.'>'.$mainAge->age_from.' to '.$mainAge->age_to.' years</option>';
            }

            // main user role
            $html['user_role'] = '<option value="">Choose a user role</option>';
            $check_user_role1 = '';
            if($cQuery->user_role == 1)
            {
                $check_user_role1 = 'selected';
            }
            $html['user_role'] .= '<option value="1" '.$check_user_role1.'>Child</option>';
            $check_user_role2 = '';
            if($cQuery->user_role == 2)
            {
                $check_user_role2 = 'selected';
            }
            $html['user_role'] .= '<option value="2" '.$check_user_role2.'>Teen</option>';
            $check_user_role3 = '';
            if($cQuery->user_role == 3)
            {
                $check_user_role3 = 'selected';
            }
            $html['user_role'] .= '<option value="3" '.$check_user_role3.'>Adult</option>';

            $html['topic_name'] = $cQuery->topic_name;

            $html['no_of_units'] = $cQuery->no_of_units;

            $html['no_of_lessons'] = $cQuery->no_of_lessons;

            $html['times_in_minutes'] = $cQuery->times_in_minutes;

            $html['course_in_month'] = $cQuery->course_in_month;

            $html['course_total_price'] = $cQuery->course_total_price;
        }

        echo json_encode($html);
    }
}