<?php

namespace App\Http\Controllers\Admin\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Model\Backend\MainCourseModel;
use App\Model\Backend\CoursePackageModel;
use App\Model\Backend\StudentTimeSlotBookingModel;
use App\Model\Backend\StudentTimeSlotSubBookingModel;

class BookingController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $mainQuery = DB::table('student_booking_tbls')
                    ->select('student_booking_tbls.id','student_booking_tbls.paypal_package_price_name','student_booking_tbls.course_comment_name','student_booking_tbls.student_booking_status','course_package_tbls.no_of_lessons_per_month','course_package_tbls.price_per_month','course_package_tbls.course_id','users.first_name','users.last_name','users.email','course_main_tbls.main_course_name')
                    ->join('course_package_tbls','course_package_tbls.id', '=', 'student_booking_tbls.paypal_package_name')
                    ->join('course_main_tbls','course_main_tbls.id', '=', 'course_package_tbls.course_id')
                    ->join('users','users.id', '=', 'student_booking_tbls.user_id')
                    ->where(['paypal_payment_status' => 'active'])
                    ->get();
        return view('admin.dashboard.pages.student.booking',compact('mainQuery'));
    }

    public function getting_fx(Request $request){
        $mainQuery = DB::table('student_booking_tbls')
                    ->select('student_booking_tbls.id','student_booking_tbls.paypal_package_price_name','student_booking_tbls.course_comment_name','student_booking_tbls.student_booking_status','course_package_tbls.no_of_lessons_per_month','course_package_tbls.price_per_month','course_package_tbls.course_id','users.first_name','users.last_name','users.email','course_main_tbls.main_course_name','users.user_role')
                    ->join('course_package_tbls','course_package_tbls.id', '=', 'student_booking_tbls.paypal_package_name')
                    ->join('course_main_tbls','course_main_tbls.id', '=', 'course_package_tbls.course_id')
                    ->join('users','users.id', '=', 'student_booking_tbls.user_id')
                    ->where('student_booking_tbls.id','=',$_GET['id'])
                    ->get();
        $html['user_name'] = "";
        $html['user_email'] = "";
        $html['course_name'] = "";
        $html['course_price'] = "";
        $html['package_details'] = "";
        $html['package_price'] = "";
        if(count($mainQuery) > 0)
        {
            foreach($mainQuery as $mQuery)
            {
                $html['user_name'] = $mQuery->first_name." ".$mQuery->last_name;
                $html['user_email'] = $mQuery->email;
                $html['course_name'] = $mQuery->main_course_name;
                $html['course_price'] = $mQuery->price_per_month;
                $html['package_details'] = $mQuery->course_comment_name;
                $html['package_price'] = $mQuery->paypal_package_price_name;
                if($mQuery->user_role == 1){
                    $html['user_role'] = "Child";
                }else if($mQuery->user_role == 2){
                    $html['user_role'] = "Teens";
                }else if($mQuery->user_role == 3){
                    $html['user_role'] = "Adult";
                }
                $html['user_per_lessons_month'] = $mQuery->no_of_lessons_per_month." lessons in a month $".$mQuery->price_per_month;
            }
        }
        echo json_encode($html);
    }

    public function student_booking_slot_delete_fx(Request $request){
        $delQuery = DB::table('student_booking_tbls')->where('id',$_GET['id'])->delete();
        $delQuery1 = DB::table('student_booking_timeslot_tbls')->where('student_booking_id',$_GET['id'])->delete();
        $delQuery2 = DB::table('next3_student_booking_tbls')->where('student_booking_id',$_GET['id'])->delete();

        if($delQuery && $delQuery1 && $delQuery2){
            $msg = "success";
        }else{
            $msg = "error";
        }
        echo json_encode($msg);
    }

    public function student_booking_slot_change_status_fx(Request $request){
        $updateStateArr = [
            "student_booking_status" => $_GET['new_state'],
        ];
        $updateStateQuery = DB::table('student_booking_tbls')->where(['id' => $_GET['id'] ])->update($updateStateArr);
        $msg = "error";
        if($updateStateQuery){
            $msg = "success";
        }
        echo  json_encode($msg);
    }
}
