<?php

namespace App\Http\Controllers\Front\Dashboard\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CourseAgeModel;
use App\Model\Backend\LearningTypeModel;
use App\Model\Backend\AdminFreeTrailModel;
use App\Model\Backend\Config\FreeTrailConfigModel;
use App\Model\Frontend\FreeTrailBookingModel;
use App\Model\Backend\FreetrailConfigNewModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\FreeTrailEmail;
use App\Model\Backend\CourseModel;
use App\Model\Backend\Order\OrderModel;
use App\Model\Backend\CoursePackageModel;
use App\Model\Frontend\Student\MonthlyPayModel;
use App\Model\Backend\StudentTimeSlotBookingModel;
use App\Model\Backend\StudentTimeSlotSubBookingModel;
use App\Model\Backend\Student\StudentAdditionalBookingModel;
use App\Model\Backend\CountryTimezone\TimezoneModel;


class CourseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function course_page_fx(Request $request){

        $countFreeTrailCountQuery = FreetrailConfigNewModel::where('user_id',Auth::user()->id)->where('user_action','active')->get();
        $courseQuery = CourseAgeModel::get();
        $learningTypeQuery = LearningTypeModel::where('learning_status','active')->get();
        $countryTimezoneQuery = TimezoneModel::get();
        return view('front.pages.dashboard-student.pages.course.course',compact('courseQuery','learningTypeQuery','countFreeTrailCountQuery','countryTimezoneQuery'));
    }

    public function show_all_courses_fx(Request $request){
        $courseQuery = DB::table('student_booking_tbls')
                        ->select('student_booking_tbls.id','course_tbls.course_name', 'course_tbls.id as course_tbls_id', 'course_tbls.no_of_units', 'course_tbls.no_of_lessons', 'course_main_tbls.main_course_name')
                        ->join('course_tbls','student_booking_tbls.paypal_package_main_course_name','=','course_tbls.id')
                        ->join('course_main_tbls','course_main_tbls.id','=','course_tbls.main_course_id')
                        ->where('student_booking_tbls.user_id',Auth::user()->id)
                        ->where('student_booking_tbls.paypal_payment_status','active')
                        ->orderBy('student_booking_tbls.id','DESC')
                        ->get();
        $html['all_course'] = '<tr><th>No</th><th>Date</th><th>Main Course Name</th><th>Course Name</th><th>Unit</th><th>Lesson</th><th>Teacher</th><th>Zoom link</th></tr>';
        $i = 0;
        if(count($courseQuery) > 0)
        {
            $count = 1;
            foreach($courseQuery as $cQuery)
            {
                # checking assign tutor
                $assign_tutor_query = DB::table('assign_tutors_tbls')->where(['student_id' => Auth::user()->id, 'course_id' => $cQuery->course_tbls_id ])->get();
                if(count($assign_tutor_query) > 0){
                    foreach($assign_tutor_query as $assignTQ){
                        $teacher_id = $assignTQ->teacher_id;
                        # teacher Query
                        $teacherQuery = DB::table('tutors_personal_details')
                                        ->where('id',$teacher_id)
                                        ->get();
                        foreach($teacherQuery as $tutorQ){
                            $tutor_name = $tutorQ->first_name." ".$tutorQ->last_name;
                        }
                    }
                }else{
                    $tutor_name = 'No teacher assigned';
                }
                # end checking assign tutor
                if($i < 10){ $i = "0".($i+1); }
                # number of units
                $unit_no = $cQuery->no_of_units;
                if($unit_no < 10){ $unit_no = "0".$unit_no; }
                # number of lessons
                $lessons_no = $cQuery->no_of_lessons;
                if($lessons_no < 10){ $lessons_no = "0".$lessons_no; }
                # class date
                $get_class_date = $this->checking_course_dates_fx($cQuery->id);
                # zoom link
                $get_zoom_links = $this->check_zoom_links_fx($cQuery->id);
                # monthly pay table
                $monthly_pay_query = MonthlyPayModel::where('booking_id',$cQuery->id)->where('user_id',Auth::user()->id)->get();
                $notification_pay_button = "";
                if(count($monthly_pay_query) > 0){
                    foreach($monthly_pay_query as $monthQuery){
                        $left_months = $monthQuery->left_months;
                        $pending_amount = $monthQuery->pending_amount;
                        $total_left_number_of_class = $monthQuery->total_left_number_of_class;
                        $notification_date = $monthQuery->notification_date;
                        $booking_end_date = $monthQuery->booking_end_date;
                        if($left_months > 0 && $pending_amount > 0 && $total_left_number_of_class > 0){
                            $notification_pay_button = "";
                            if( (strtotime(date('Y-m-d')) >= strtotime($notification_date)) && (strtotime($booking_end_date) >= strtotime(date('Y-m-d'))) ){
                                $notification_pay_button = '<td><a href="javascript:;" onclick="course_left_pay_fx('.$cQuery->id.','.$monthQuery->id.')" class="btn btn-success btn-sm text-white">Pay</a></td>';
                            }else if(strtotime(date('Y-m-d')) > strtotime($booking_end_date)){
                                $notification_pay_button = '<td><a href="javascript:;" onclick="course_tenure_expire_pay_fx('.$cQuery->id.','.$monthQuery->id.')" class="btn btn-danger btn-sm text-white">Tenure Expire ! Pay Now</a></td>';
                            }
                        }
                    }
                }
                # all courses
                $html['all_course'] .= '<tr>
                                            <td>'.$count.'</td>
                                            <td>'.$get_class_date.'</td>
                                            <td>'.ucwords($cQuery->main_course_name).'</td>
                                            <td>'.ucwords($cQuery->course_name).'</td>
                                            <td>'.$unit_no.'</td>
                                            <td>'.$lessons_no.'</td>
                                            <td>'.ucwords($tutor_name).'</td>
                                            <td>'.$get_zoom_links.'</td>
                                            '.$notification_pay_button.'
                                        </tr>';
                $i++;
                $count++;
            }

        }
        else
        {
            $html['all_course'] .= '<tr><td colspan=9><span class="text-danger"><center><i class="fa fa-times"></i> No courses are booked yet! Book a course to improve your skill</center></span></td></tr>';
        }

        $html['course_progress'] = "";
        $getCourseProgressQuery = DB::table('student_booking_tbls')->where('user_id',Auth::user()->id)->get();
        $bookingIds = array();
        foreach($getCourseProgressQuery as $getCourseProgressQ){
            $bookingIds[] = $getCourseProgressQ->id;
        }

        $countProgress = 0;
        $gettingLoopQuery1 = DB::table('student_booking_timeslot_tbls')->whereIn('student_booking_id',$bookingIds)->get();
        if(count($gettingLoopQuery1) > 0){
            foreach($gettingLoopQuery1 as $getLoop1){
                $countProgress = $countProgress + 1;
            }
        }else{
            $countProgress = $countProgress;
        }

        $gettingLoopQuery2 = DB::table('next3_student_booking_tbls')->whereIn('student_booking_id',$bookingIds)->get();
        if(count($gettingLoopQuery2) > 0){
            foreach($gettingLoopQuery2 as $getLoop2){
                $countProgress = $countProgress + 1;
            }
        }else{
            $countProgress = $countProgress;
        }

        $html['course_progress'] = $countProgress;
        $attendClasses = $this->attendant_class_fx();
        $html['attend_classes'] = $attendClasses;
        $html['course_percentage'] = round(($attendClasses/$countProgress)*100);
        $html['attendance_percentage'] = round(($attendClasses/$countProgress)*100);
        $html['remain_percentage'] = round(100 - (($attendClasses/$countProgress)*100));
        $html['remain_classes'] = $countProgress - $attendClasses;
        echo json_encode($html);
    }

    # class attendance
    public function attendant_class_fx(){
        $count_classes = 0;
        $getClassesQuery = DB::table('student_booking_tbls')->where('user_id',Auth::user()->id)->get();
        foreach($getClassesQuery as $getCourseProgressQ){
            $bookingId = $getCourseProgressQ->id;
            $gettingLoopQuery1 = DB::table('student_booking_timeslot_tbls')->where('student_booking_id',$bookingId)->get();
            foreach($gettingLoopQuery1 as $getLoopQ1){
                if(strtotime(date('Y-m-d')) >= strtotime($getLoopQ1->student_booking_date)){
                    $count_classes = $count_classes+1;
                }else{
                    break;
                }
            }

            $gettingLoopQuery2 = DB::table('next3_student_booking_tbls')->where('student_booking_id',$bookingId)->get();
            foreach($gettingLoopQuery2 as $getLoopQ2){
                if(strtotime(date('Y-m-d')) >= strtotime($getLoopQ2->student_booking_date)){
                    $count_classes = $count_classes+1;
                }else{
                    break;
                }
            }
        }
        return $count_classes;
    }

    # zoom link
    public function check_zoom_links_fx($id){
        # student booking table
        $checkingActiveBookingTable_Query = StudentTimeSlotBookingModel::where('id',$id)->where('paypal_payment_status','active')->get();
        $flag = 1;
        #student sub booking table
        if(count($checkingActiveBookingTable_Query) > 0){
            $checkingActiveSubBookingTable_Query = StudentTimeSlotSubBookingModel::where('student_booking_id',$id)->get();
            if(count($checkingActiveSubBookingTable_Query) > 0){
                foreach($checkingActiveSubBookingTable_Query as $checkingSubQuery){
                    $getFirstBookingDate = $checkingSubQuery->student_booking_date;
                    if(strtotime($getFirstBookingDate) >= strtotime(date('Y-m-d'))){
                        $flag = 1;
                        $next_class_date = '<a target="_blank" href="'.$checkingSubQuery->zoom_links.'">'.$checkingSubQuery->zoom_links.'</a>';
                        break;
                    }else{
                        $flag = 0;
                        $checkingNextAdditional_query = StudentAdditionalBookingModel::where('student_booking_id',$id)->get();
                        if(count($checkingNextAdditional_query) > 0)
                        {
                            foreach($checkingNextAdditional_query as $checkNextQuery)
                            {
                                $getNextBookingDate = $checkNextQuery->student_booking_date;
                                if(strtotime($getNextBookingDate) >= strtotime(date('Y-m-d'))){
                                    $flag = 1;
                                    $next_class_date = '<a target="_blank" href="'.$checkNextQuery->zoom_links.'">'.$checkNextQuery->zoom_links.'</a>';
                                    break;
                                }
                            }
                        }
                        else
                        {
                            $flag = 0;
                            $next_class_date = '<a href="#">No zoom link shared</a>';
                        }
                    }
                }
            }
        }
        return $next_class_date;
    }

    public function checking_course_dates_fx($id){
        # student booking table
        $checkingActiveBookingTable_Query = StudentTimeSlotBookingModel::where('id',$id)->where('paypal_payment_status','active')->get();
        $flag = 1;
        #student sub booking table
        if(count($checkingActiveBookingTable_Query) > 0){
            $checkingActiveSubBookingTable_Query = StudentTimeSlotSubBookingModel::where('student_booking_id',$id)->get();
            if(count($checkingActiveSubBookingTable_Query) > 0){
                foreach($checkingActiveSubBookingTable_Query as $checkingSubQuery){
                    $getFirstBookingDate = $checkingSubQuery->student_booking_date;
                    if(strtotime($getFirstBookingDate) >= strtotime(date('Y-m-d'))){
                        $flag = 1;
                        $next_class_date = date('m/d/Y',strtotime($getFirstBookingDate))." ( ".date("h:i a",strtotime($checkingSubQuery->course_class_start_time_name))." ) ";
                        break;
                    }else{
                        $flag = 0;
                        $checkingNextAdditional_query = StudentAdditionalBookingModel::where('student_booking_id',$id)->get();
                        if(count($checkingNextAdditional_query) > 0)
                        {
                            foreach($checkingNextAdditional_query as $checkNextQuery)
                            {
                                $getNextBookingDate = $checkNextQuery->student_booking_date;
                                if(strtotime($getNextBookingDate) >= strtotime(date('Y-m-d'))){
                                    $flag = 1;
                                    $next_class_date = date('m/d/Y',strtotime($getNextBookingDate))." ( ".date("h:i a",strtotime($checkingSubQuery->course_class_start_time_name))." ) ";
                                    break;
                                }
                            }
                        }
                        else
                        {
                            $flag = 0;
                            $next_class_date = "No Classes";
                        }
                    }
                }
            }
        }
        return $next_class_date;
    }

    # course rest pay modal
    public function rest_pay_course_modal_view_fx(Request $request){
        $booking_tbl_id = $_GET['booking_tbl_id'];
        $monthly_booking_tbl_id = $_GET['monthly_booking_tbl_id'];
        # get course rest pay modal
        $getCourseBookingQuery = StudentTimeSlotBookingModel::where('id',$booking_tbl_id)->get();
        if(count($getCourseBookingQuery) > 0)
        {
            foreach($getCourseBookingQuery as $getBookingQuery){
                $packagePrice = $getBookingQuery->paypal_package_price_name;
                $packageTblId = $getBookingQuery->paypal_package_name;
                # get course package
                $getCoursePackageQuery =  CoursePackageModel::where('id',$packageTblId)->get();
                if(count($getCoursePackageQuery) > 0){
                    foreach($getCoursePackageQuery as $coursePackageQuery){
                        $package_no_of_lessons_in_month = $coursePackageQuery->no_of_lessons_per_month;
                    }
                }
            }
        }
        $html['package_single_month_price'] = $packagePrice;
        $html['package_lessons_in_a_month'] = $package_no_of_lessons_in_month;
        # get monthly pay of course
        $getMonthlyPayCourseQuery = MonthlyPayModel::where(['id'=> $monthly_booking_tbl_id, 'booking_id' => $booking_tbl_id ])->get();
        if(count($getMonthlyPayCourseQuery) > 0)
        {
            foreach($getMonthlyPayCourseQuery as $monthlyBookingQuery){
                $total_months = $monthlyBookingQuery->total_months;
                $rest_months = $monthlyBookingQuery->left_months;
            }
        }
        # get course months and details
        $html['months_count'] = "";
        if($package_no_of_lessons_in_month > 10){
            if($rest_months > 0)
            {
                if($rest_months == 1){
                    $html['months_count'] .= '<option value="1">One Month( $ '.($packagePrice*1).')</option>';
                }else if($rest_months > 1 && $rest_months <= 2){
                    $html['months_count'] .= '<option value="1">One Month Pay( $ '.($packagePrice*1).')</option>';
                    $html['months_count'] .= '<option value="2">Two Month Pay( $ '.($packagePrice*2).')</option>';
                }else if($rest_months > 2){
                    $html['months_count'] .= '<option value="1">One Month Pay( $ '.($packagePrice*1).')</option>';
                    $html['months_count'] .= '<option value="2">Two Month Pay( $ '.($packagePrice*2).')</option>';
                    $html['months_count'] .= '<option value="'.$rest_months.'">Full Pay( $ '.($packagePrice*$rest_months).')</option>';
                }
                $html['base_monthly_package_price'] = $packagePrice;
            }
        }else{
            if($rest_months > 0)
            {
                if($rest_months == 1){
                    $html['months_count'] .= '<option value="1">One Month( $ '.($packagePrice*1).')</option>';
                }else if($rest_months > 1 && $rest_months <= 3){
                    $html['months_count'] .= '<option value="1">One Month Pay( $ '.($packagePrice*1).')</option>';
                    $html['months_count'] .= '<option value="'.$rest_months.'">Full Pay( $ '.($packagePrice*$rest_months).')</option>';
                }else if($rest_months > 3 && $rest_months <= 6){
                    $html['months_count'] .= '<option value="1">One Month Pay( $ '.($packagePrice*1).')</option>';
                    $html['months_count'] .= '<option value="3">Three Month Pay( $ '.($packagePrice*3).')</option>';
                    $html['months_count'] .= '<option value="'.$rest_months.'">Full Pay( $ '.($packagePrice*$rest_months).')</option>';
                }else if($rest_months > 6){
                    $html['months_count'] .= '<option value="1">One Month Pay( $ '.($packagePrice*1).')</option>';
                    $html['months_count'] .= '<option value="3">Three Month Pay( $ '.($packagePrice*3).')</option>';
                    $html['months_count'] .= '<option value="6">Six Month Pay( $ '.($packagePrice*6).')</option>';
                    $html['months_count'] .= '<option value="'.$rest_months.'">Full Pay( $ '.($packagePrice*$rest_months).')</option>';
                }
                $html['base_monthly_package_price'] = $packagePrice;
            }
        }
        echo json_encode($html);
    }

    # course rest payment submit
    public function course_rest_pay_submit_fx(Request $request){
        $month_tenure = $request->input('course_rest_month_name');
        $total_paid_price = $request->input('course_monthly_total_pay_price_name');
        $single_package_price = $request->input('course_package_pay_price_name');
        $monthly_lessons = $request->input('course_monthly_lessons_name');
        $booking_tbls_id = $request->input('course_booking_id_name');
        $booking_monthly_tbls_id = $request->input('course_booking_monthly_id_name');

        /* echo "Months: ".$month_tenure." Paid: ".$total_paid_price." single package : ".$single_package_price." lessons : ".$monthly_lessons." booking tbls id: ".$booking_tbls_id." monthly booking id ".$booking_monthly_tbls_id; */

        #session
        $request->session()->put('paid_months',$month_tenure);
        $request->session()->put('total_paid_price',$total_paid_price);
        $request->session()->put('single_package_price',$single_package_price);
        $request->session()->put('monthly_lessons',$monthly_lessons);
        $request->session()->put('booking_tbls_id',$booking_tbls_id);
        $request->session()->put('booking_monthly_tbls_id',$booking_monthly_tbls_id);
        #endsession

        return redirect()->route('satirtha.rest-paypal-payment-processing',['book_id'=>base64_encode($booking_tbls_id),'book_price'=>base64_encode($total_paid_price)]);
    }

    # Paypal show part
    public function payment_process_fx(Request $request,$id,$pay_price){
        return view('front.pages.dashboard-student.pages.paypal.rest-payment',compact('id','pay_price'));
    }

    # paypal rest payment -- success
    public function payment_success_process_fx(Request $request,$id){
        # get sessions
        $month_tenure = $request->session()->get('paid_months');
        $total_paid_price = $request->session()->get('total_paid_price');
        $single_package_price = $request->session()->get('single_package_price');
        $monthly_lessons = $request->session()->get('monthly_lessons');
        $booking_tbls_id = $request->session()->get('booking_tbls_id');
        $booking_monthly_tbls_id = $request->session()->get('booking_monthly_tbls_id');
        #end sessions
        #update date on booking tbls
        $bookingArr = [
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $bookingUpdateQuery = StudentTimeSlotBookingModel::where('id',base64_decode($id))->update($bookingArr);
        # get monthly booking tbls data
        $getMonthlyBookingQuery = MonthlyPayModel::where('id',$booking_monthly_tbls_id)->get();
        if(count($getMonthlyBookingQuery) > 0){
            foreach($getMonthlyBookingQuery as $monthlyBookingQ){
                $booking_end_date = $monthlyBookingQ->booking_end_date;
                $total_left_classes = $monthlyBookingQ->total_left_number_of_class;
                $left_months = $monthlyBookingQ->left_months;
                $paid_amount = $monthlyBookingQ->paid_amount;
                $pending_amount = $monthlyBookingQ->pending_amount;
                $end_date = $monthlyBookingQ->booking_end_date;
                $notification_date = $monthlyBookingQ->notification_date;
            }
        }
        #checking booking query in existing end date or not
        if(strtotime($booking_end_date) >= strtotime(date('Y-m-d'))){
            #checking first dates -- sub booking tbls
            $foundSubBookingId_query = StudentTimeSlotSubBookingModel::where(['student_booking_id' => $booking_tbls_id])->get();
            foreach($foundSubBookingId_query as $foundSubBookingId){
                $sub_booking_id = $foundSubBookingId->id;
                $paid_months = $month_tenure;
                #last additional dates
                $foundAdditionalLastDate_Query = StudentAdditionalBookingModel::where(['student_booking_timeslot_tbls_id' => $sub_booking_id, 'student_booking_id' => $booking_tbls_id ])->limit(1)->orderBy('id','DESC')->get();
                    foreach( $foundAdditionalLastDate_Query as $foundAdditionalLastDateQ ){
                        $last_book_date = $foundAdditionalLastDateQ->student_booking_date;
                        $last_book_start_datetime = $foundAdditionalLastDateQ->course_class_start_time_name;
                        $last_book_end_datetime = $foundAdditionalLastDateQ->course_class_end_time_name;
                    }
                    for($count = 1; $count <= ($paid_months*4); $count++){
                        $newCountInsertArr = [
                            'student_booking_timeslot_tbls_id' => $sub_booking_id,
                            'student_id' => Auth::user()->id,
                            'student_booking_id' => $booking_tbls_id,
                            'student_booking_date' => date('Y-m-d',strtotime("+7 day",strtotime($last_book_date))),
                            'course_class_start_time_name' => date("H:i:s",strtotime($last_book_start_datetime)),
                            'course_class_end_time_name' => date("H:i:s",strtotime($last_book_end_datetime)),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        $newCountInsertQuery = StudentAdditionalBookingModel::insert($newCountInsertArr);
                        $last_book_date = date('Y-m-d',strtotime("+7 day",strtotime($last_book_date)));
                    }
            }
            #update on monthly package booking tbls
            if($monthly_lessons == 4){ $per_week_count_no = $monthly_lessons/4; }
            if($monthly_lessons == 8){ $per_week_count_no = $monthly_lessons/4; }
            if($monthly_lessons == 12){ $per_week_count_no = $monthly_lessons/4; }

            $month_end_datetime_data = date('Y-m-d',strtotime('+ '.$month_tenure.'months',strtotime($end_date)));
            $updateMonthlyPackageArr = [
                'total_left_number_of_class' => ($total_left_classes - ($month_tenure*4*$per_week_count_no)),
                'left_months' => ($left_months - $month_tenure),
                'paid_amount' => ($paid_amount + $total_paid_price),
                'pending_amount' => ($pending_amount - $total_paid_price),
                'booking_end_date' => date('Y-m-d',strtotime('+ '.$month_tenure.'months',strtotime($end_date))),
                'notification_date' => date('Y-m-d',strtotime('-5 days',strtotime($month_end_datetime_data))),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $monthlyPackageQuery = MonthlyPayModel::where(['id' => $booking_monthly_tbls_id])->update($updateMonthlyPackageArr);
        }

        #update monthly booking tbls
        $payerId =  $_GET['PayerID'];
        $tokanId = $_GET['token'];
        $mfid = $_GET['mfid'];
        $rcache = $_GET['rcache'];

        # updating order
        // $updatePaymentState = StudentTimeSlotBookingModel::where(['id' => base64_decode($id)])->update(['paypal_payment_status' => 'active']);
            $insertArr = [
                'booking_id' => base64_decode($id),
                'layer_id' => $payerId,
                'tokanId' => $tokanId,
                'mfid' => $mfid,
                'rcache' => $rcache,
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ];
            $insertOrderQuery = OrderModel::insert($insertArr);

        if($insertOrderQuery){
            $request->session()->flash('success_msg','Successfully booked');

            $request->session()->forget('paid_months');
            $request->session()->forget('total_paid_price');
            $request->session()->forget('single_package_price');
            $request->session()->forget('monthly_lessons');
            $request->session()->forget('booking_tbls_id');
            $request->session()->forget('booking_monthly_tbls_id');
        }else{
            $request->session()->flash('error_msg','Payment not accepted ! Try again');
        }
        return redirect()->route('satirtha.show-course-page');
    }

    # paypal rest payment -- error
    public function payment_error_process_fx(Request $request){
        $request->session()->flash('error_msg','Payment canceled ! Try again');
        return redirect()->route('satirtha.show-course-page');
    }
}
