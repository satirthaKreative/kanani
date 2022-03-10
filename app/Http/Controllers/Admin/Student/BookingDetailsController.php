<?php

namespace App\Http\Controllers\Admin\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Model\Backend\MainCourseModel;
use App\Model\Backend\CoursePackageModel;
use App\Model\Backend\StudentTimeSlotBookingModel;
use App\Model\Backend\StudentTimeSlotSubBookingModel;
use App\Model\Backend\FreetrailConfigModel;
use App\Model\Backend\Student\StudentTimeIntervalSlotModel;
use App\Model\Backend\Student\StudentTimeSlotModel;
use App\Model\Backend\Student\StudentAdditionalBookingModel;

class BookingDetailsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(Request $request, $id){
        $getQuery = DB::table('student_booking_tbls')
                        ->select('student_booking_tbls.id','student_booking_tbls.paypal_package_price_name','student_booking_tbls.student_interval_time','student_booking_tbls.course_comment_name','users.first_name','users.last_name','users.email','course_package_tbls.no_of_lessons_per_month','course_main_tbls.main_course_name','course_tbls.course_name', 'course_tbls.no_of_units', 'course_tbls.no_of_lessons','course_tbls.topic_name')
                        ->join('users','users.id','=','student_booking_tbls.user_id')
                        ->join('course_package_tbls','course_package_tbls.id','=','student_booking_tbls.paypal_package_name')
                        ->join('course_main_tbls','course_main_tbls.id','=','course_package_tbls.course_id')
                        ->join('course_tbls','course_tbls.id','=','student_booking_tbls.paypal_package_main_course_name')
                        ->where('student_booking_tbls.id', base64_decode($id))
                        ->get();
        $getBookingQuery = DB::table('student_booking_tbls')
                                ->select('student_booking_tbls.id','student_booking_timeslot_tbls.student_booking_date','student_booking_timeslot_tbls.course_class_start_time_name', 'student_booking_timeslot_tbls.course_class_end_time_name')
                                ->join('student_booking_timeslot_tbls','student_booking_timeslot_tbls.student_booking_id','=','student_booking_tbls.id')
                                ->where('student_booking_tbls.id', base64_decode($id))
                                ->get();
        $getMultiBookingQuery = DB::table('student_booking_tbls')
                                ->select('student_booking_tbls.id','next3_student_booking_tbls.student_booking_date','next3_student_booking_tbls.course_class_start_time_name', 'next3_student_booking_tbls.course_class_end_time_name')
                                ->join('next3_student_booking_tbls','next3_student_booking_tbls.student_booking_id','=','student_booking_tbls.id')
                                ->where('student_booking_tbls.id', base64_decode($id))
                                ->orderBy('next3_student_booking_tbls.student_booking_date','ASC')
                                ->get();
        $getMonthlyBookingQuery = DB::table('monthly_pay_tbls')
                                ->where('booking_id', base64_decode($id))
                                ->get();
        return view('admin.dashboard.pages.student.view-single-booking',compact('getQuery','getBookingQuery','getMultiBookingQuery','getMonthlyBookingQuery'));
    }

}