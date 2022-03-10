<?php

namespace App\Http\Controllers\Front\Dashboard\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CourseModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Model\Backend\MainCourseModel;
use App\Model\Backend\CoursePackageModel;
use App\Model\Backend\StudentTimeSlotBookingModel;
use App\Model\Backend\StudentTimeSlotSubBookingModel;
use App\Model\Backend\FreetrailConfigModel;
use App\Model\Backend\Student\StudentTimeIntervalSlotModel;
use App\Model\Backend\Student\StudentTimeSlotModel;
use App\Model\Backend\Student\StudentAdditionalBookingModel;
use App\Model\Frontend\Student\MonthlyPayModel;
use Validator;
use URL;
use Illuminate\Support\Facades\Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\Model\Backend\CountryTimezone\TimezoneModel;

class BookingController extends Controller
{
    private $_api_context;
    public function __construct(){
        $this->middleware('auth');
        // paypal
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }
    // paypal part
    public function postPaymentWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

    	$item_1 = new Item();

        $item_1->setName('Project')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Enter Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('paywithpaypal');
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('paywithpaypal');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        \Session::put('error','Unknown error occurred');
    	return Redirect::route('paywithpaypal');
    }

    public function getPaymentStatus(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            \Session::put('success','Payment success !!');
            return Redirect::route('paywithpaypal');
        }

        \Session::put('error','Payment failed !!');
		return Redirect::route('paywithpaypal');
    }
    // end of paypal part

    public function booking_page_fx(Request $request){
        $studentBookingQuery = DB::table('student_booking_tbls')
                                ->where('user_id',Auth::user()->id)
                                ->where('paypal_payment_status','active')
                                ->get();
        $tagInId = [];
        foreach($studentBookingQuery as $studentQuery)
        {
            $tagInId[] = $studentQuery->paypal_package_main_course_name;
        }
        $tagedImplodeId = implode(",",$tagInId);
        // print_r($tagedImplodeId);
        // die();
        // $courseDBquery = DB::table('course_tbls')->where('user_role',Auth::user()->user_role)->groupBy('times_in_minutes')->get();
        $courseDBsubQuery = DB::table('course_tbls')
                            ->select('course_tbls.id', 'course_tbls.course_name', 'course_tbls.user_role', 'course_tbls.course_price', 'course_tbls.main_course_id', 'course_tbls.age_id', 'course_tbls.no_of_units', 'course_tbls.no_of_lessons', 'course_tbls.times_in_minutes', 'course_tbls.topic_name', 'course_tbls.course_in_month', 'course_tbls.course_status', 'course_tbls.created_at', 'course_tbls.updated_at')
                            ->where('course_tbls.user_role',Auth::user()->user_role)
                            ->whereNotIn('course_tbls.id',$tagInId)
                            ->get();
        $bookingCourseQuery = MainCourseModel::where('user_role',Auth::user()->user_role)->get();
        foreach($bookingCourseQuery as $bookingCourseQ)
        {
            $courseId = $bookingCourseQ->id;
        }
        $role_wish_price_list = CoursePackageModel::where('course_id',$courseId)->get();
        $countryTimezoneQuery = TimezoneModel::get();
        return view('front.pages.dashboard-student.pages.booking.booking',compact('courseDBsubQuery','role_wish_price_list','countryTimezoneQuery'));
    }

    public function full_pay_tenure_checking_fx(Request $request){
        $course_hidden_id = $_GET['course_hidden_id'];
        $getQuery = DB::table('course_tbls')
                        ->where('id',$course_hidden_id)
                        ->get();
        if(count($getQuery) > 0){
            foreach($getQuery as $gQuery){
                if($gQuery->course_total_price == 0){
                    $full_pay_price = 0;
                }else{
                    $full_pay_price = $gQuery->course_total_price;
                }
            }
        }else{
            $full_pay_price = 0;
        }
        echo json_encode($full_pay_price);
    }

    public function booking_price_list_fx(Request $request){

    }

    public function change_booking_price_list_fx(Request $request){
        $price_on_package = CoursePackageModel::where('id',$_GET['id'])->get();
        foreach($price_on_package as $package_price)
        {
            // $singleLessonPrice = (($package_price->price_per_month)/($package_price->no_of_lessons_per_month));
	    $singleLessonPrice = $package_price->price_per_month;
        }

        $choose_course = CourseModel::where('id',$_GET['course_id'])->get();
        foreach($choose_course as $chooseC)
        {
            $number_of_lessons = $chooseC->no_of_lessons;
        }

        // $single_price = intval($singleLessonPrice*$number_of_lessons);
	    $single_price = intval($singleLessonPrice);
        echo json_encode($single_price);
    }

    public function get_end_client_choose_time_fx(Request $request){
        $interval_time_query = DB::table('config_admin_free_trail_tbl')->where('id',1)->get();
        foreach($interval_time_query as $intervalQuery)
        {
            $hours_to_mins_name = (($intervalQuery->config_time_hrs_interval)*60);
            $mins_name = $intervalQuery->config_time_mins_interval;

            $total_min = $hours_to_mins_name+$mins_name;
        }

        // end time calculation
        $course_time = $_GET["course_start_time"];
        $course_end_time = date('H:i',strtotime(" + ".$total_min." minute",strtotime($course_time)));
        echo json_encode($course_end_time);
    }

    // booking submit
    public function booking_from_student_submit_fx(Request $request)
    {
        $paypal_package_name = $request->input('paypal_package_name');
        $paypal_package_radio_name = $request->input('paypal_package_radio_name');
        $paypal_package_price_name = $request->input('paypal_package_price_name');
        $hidden_lessons_count_name = $request->input('lessons_per_week_count_hidden_name');
        $course_comment_name = $request->input('course_comment_name');
        $course_payable_price_name = $request->input('course_payable_price_name');
        $course_pay_tenure_name = $request->input('course_pay_tenure_name');

        if($paypal_package_name == "" || $paypal_package_name == null || $paypal_package_name == 0){
            $request->session()->flash('error_msg','Please choose a package plan');
            return redirect()->back();
        }else if($paypal_package_radio_name == "" || $paypal_package_radio_name == null || $paypal_package_radio_name == 0){
            $request->session()->flash('error_msg','Please choose a package');
            return redirect()->back();
        }else if($paypal_package_price_name == "" || $paypal_package_price_name == null || $paypal_package_price_name == 0){
            $request->session()->flash('error_msg','Please choose a package price');
            return redirect()->back();
        }else if($course_comment_name == "" || $course_comment_name == null){
            $request->session()->flash('error_msg','Please choose a course comment');
            return redirect()->back();
        }else if($course_pay_tenure_name == ""){
            $request->session()->flash('error_msg','Please choose a course pay tenure');
            return redirect()->back();
        }else if($course_payable_price_name == "" || $course_payable_price_name == null || $course_payable_price_name == 0){
            $request->session()->flash('error_msg','Payable price cannot be null');
            return redirect()->back();
        }else{
            $insertArr = [
                'user_id' => Auth::user()->id,
                'paypal_package_name' => $paypal_package_name,
                'paypal_package_main_course_name' => $request->input('paypal_package_main_course_name'),
                'paypal_package_radio_name' => $paypal_package_radio_name,
                'paypal_package_price_name' => $paypal_package_price_name,
                'course_class_start_time_name' => '0:00',
                'course_class_end_time_name' => '0:00',
                'course_comment_name' => $course_comment_name,
                'student_interval_time' => $request->input('booking_interval_hidden_time_name'),
                'student_booking_status' => 'active',
                'timezone_tbl_id' => $request->input('course_timezone_name'),
                'admin_shown_status' => 'unseen',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $insertQuery = StudentTimeSlotBookingModel::insert($insertArr);
            if($insertQuery){
                $getLastQuery = StudentTimeSlotBookingModel::where(['user_id' => Auth::user()->id])->orderBy('id','DESC')->limit(1)->get();
                foreach($getLastQuery as $getLQuery){
                    $studentBookingTableLastId = $getLQuery->id;
                    $studentBookingTableLastCourseId = $getLQuery->paypal_package_main_course_name;
                    # checking
                    $total_number_of_classes = $request->input('booking_no_of_lessons_hidden_name');
                    $lessons_per_months = $request->input('lessons_per_month_count_hidden_name');
                    $total_number_of_months_for_classes = $request->input('month_count_hidden_name');
                    $tenure_name = $request->input('course_pay_tenure_name');
                    if($tenure_name == "full"){
                        $tenure_month = $total_number_of_months_for_classes;
                    }else{
                        $tenure_month = $tenure_name;
                    }
                    $total_left_months_for_classes = ($total_number_of_classes-($tenure_month*$lessons_per_months));
                    $left_month = $total_number_of_months_for_classes-$tenure_month;
                    $single_package_price = $request->input('paypal_package_price_name');
                    $paid_amount = $request->input('course_payable_price_name');
                    $all_total_amount = $total_number_of_months_for_classes*$single_package_price;
                    $total_payable_amount = $single_package_price*$tenure_month;
                    $pending_amount = $all_total_amount - $paid_amount;
                    $package_starting_date = date('Y-m-d',strtotime($request->input('course_start_date_name'.$hidden_lessons_count_name)));
                    $package_ending_date = date('Y-m-d',strtotime("+".$tenure_month."months",strtotime($package_starting_date)));
                    $notifing_date = date('Y-m-d',strtotime("- 5 days",strtotime($package_ending_date)));
                    # end checking
                    $payMonthArr = [
                        'booking_id' => $studentBookingTableLastId,
                        'user_id' => Auth::user()->id,
                        'timezone_tbl_id' => $request->input('course_timezone_name'),
                        'course_tbl_id' => $studentBookingTableLastCourseId,
                        'total_number_of_class' => $total_number_of_classes,
                        'total_left_number_of_class' => $total_left_months_for_classes,
                        'monthly_cost_package' => $single_package_price,
                        'total_months' => $total_number_of_months_for_classes,
                        'left_months' => $left_month,
                        'total_payable_amount' => $all_total_amount,
                        'paid_amount' => $paid_amount,
                        'pending_amount' => $pending_amount,
                        'booking_start_date' => $package_starting_date,
                        'booking_end_date' => $package_ending_date,
                        'notification_date' => $notifing_date,
                        'booking_state' => 'active',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $payMonthInsertQuery = MonthlyPayModel::insert($payMonthArr);
                    #end checking
                }
                for($j=1;$j<=$hidden_lessons_count_name;$j++)
                {
                    $newInsertArr = [
                        'student_booking_id' => $studentBookingTableLastId,
                        'student_booking_date' => date('Y-m-d',strtotime($request->input('course_start_date_name'.$j))),
                        'course_class_start_time_name' => $request->input('course_class_start_time_name'.$j),
                        'course_class_end_time_name' => $request->input('course_class_end_time_name'.$j),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $newInsertQuery = StudentTimeSlotSubBookingModel::insert($newInsertArr);
                    // additional 3 weeks date
                    $getLastStudentTimeBookingQuery = StudentTimeSlotSubBookingModel::where(['student_booking_id' => $studentBookingTableLastId, 'student_booking_date' => date('Y-m-d',strtotime($request->input('course_start_date_name'.$j))), 'course_class_start_time_name' => $request->input('course_class_start_time_name'.$j), 'course_class_end_time_name' => $request->input('course_class_end_time_name'.$j)])->orderBy('id','DESC')->limit(1)->get();
                    foreach($getLastStudentTimeBookingQuery as $lastStudentTimeBookingQuery){
                        $lastStudentBookid = $lastStudentTimeBookingQuery->id;
                    }
                    $getCourseDate = date('Y-m-d',strtotime($request->input('course_start_date_name'.$j)));
                    for($count = 1; $count <= (($tenure_month*4)-1); $count++){
                        $newCountInsertArr = [
                            'student_booking_timeslot_tbls_id' => $lastStudentBookid,
                            'student_id' => Auth::user()->id,
                            'student_booking_id' => $studentBookingTableLastId,
                            'student_booking_date' => date('Y-m-d',strtotime("+7 day",strtotime($getCourseDate))),
                            'course_class_start_time_name' => $request->input('course_class_start_time_name'.$j),
                            'course_class_end_time_name' => $request->input('course_class_end_time_name'.$j),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        $newCountInsertQuery = StudentAdditionalBookingModel::insert($newCountInsertArr);
                        $getCourseDate = date('Y-m-d',strtotime("+7 day",strtotime($getCourseDate)));
                    }
                }
                $request->session()->flash('success_msg','Successfully booked');
                return redirect()->route('satirtha.paypal-payment-processing',['book_id'=>base64_encode($studentBookingTableLastId),'book_price'=>base64_encode($paid_amount)]);
            }else{
                $request->session()->flash('error_msg','Something went wrong');
                return redirect()->back();
            }
        }

    }

    public function package_checking_for_days_fx(Request $request){
        $packageQuery = DB::table('course_package_tbls')
                            ->where('id',$_GET['choose_pack_id'])
                            ->get();

        foreach($packageQuery as $packageQ){
            $lessons_per_week = (($packageQ->no_of_lessons_per_month)/4);
            $no_of_lessons_per_month = $packageQ->no_of_lessons_per_month;
        }
        $html['lessons_per_Week_name'] = $lessons_per_week;
        $html['no_of_lessons_per_month'] = $no_of_lessons_per_month;
        $html['package_for_days'] = "";
        for($i=0;$i<$lessons_per_week;$i++)
        {
	    if(($i+1) == 1){
		    $stand_var = 'st';
	    }else if(($i+1) == 2){
		    $stand_var = 'nd';
        }else if(($i+1) == 3){
		    $stand_var = 'rd';
        }else if(($i+1) >= 4){
		    $stand_var = 'th';
        }
            $html['package_for_days'] .= '<div class="row">
                                            <div class="col-lg-6">
                                                <label for="">Start date ('.($i+1).$stand_var.' day of the week)</label>
                                                <input type="text" onkeydown="return false" class="course-start-date-class" name="course_start_date_name'.($i+1).'" placeholder="Select course start date" id="course-start-date-id'.($i+1).'" autocomplete="off" onchange="avail_check('.($i+1).')" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="">Class time</label>
                                                <div class="row">
                                                    <input type="hidden" name="course_class_start_time_name'.($i+1).'" required id="course-class-start-time-id'.($i+1).'" />
                                                    <div class="col-lg-12">
                                                        <select name="course_class_end_time_name'.($i+1).'" onchange="booking_class_previous_time_found_fx('.($i+1).')" id="avail-date-time-id'.($i+1).'">
                                                            <option value="">Choose time</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        echo json_encode($html);
                                                    // <div class="col-lg-6">
                                                    //     <input type="time" name="course_class_start_time_name'.($i+1).'" onchange="course_class_start_time_fx('.($i+1).')" required id="course-class-start-time-id'.($i+1).'" />
                                                    //     <select name="course_class_start_time_name'.($i+1).'" id="avail-date-time-id'.($i+1).'">
                                                    //         <option value="">Choose time</option>
                                                    //     </select>
                                                    // </div>
                                                    // <div class="col-lg-6">
                                                    //     <input type="time" name="course_class_end_time_name'.($i+1).'" id="course-class-end-time-id'.($i+1).'" required />
                                                    // </div>
    }

    public function student_booking_calenders_fx(Request $request){
        $calenderQuery = StudentTimeSlotModel::where('students_avail','active')->get();
        $calenderArr = array();
        foreach($calenderQuery as $calenderQ)
        {
            $calenderArr[] = $calenderQ->student_date;
        }

        $todayDate = date("Y-m-d");
        $outCalenderArr = array();
        $outCalenderArr[] = $todayDate;
        for($i = 1; $i < 30; $i++)
        {
            $checkdates = date('Y-m-d',strtotime($todayDate."+ ".$i." days"));
            if(!in_array($checkdates , $calenderArr))
            {
                $outCalenderArr[] = date('Y-m-d',strtotime($todayDate."+ ".$i." days"));
            }
        }

        echo json_encode($outCalenderArr);
    }

    public function student_booking_calender_time_page_fx(Request $request)
    {
        // config interval
        $checkIntervalQuery =  StudentTimeIntervalSlotModel::where('id',1)->get();
        if(count($checkIntervalQuery) > 0)
        {
            foreach ($checkIntervalQuery as $key_value) {
                $hrs_time = $key_value->config_time_hrs_interval;
                $mins_time = $key_value->config_time_mins_interval;

                $total_count_in_mins = (($hrs_time*60)+$mins_time);
            }
        }

        $html['interval_time_of_date'] = $total_count_in_mins;

        $checkQuery = StudentTimeSlotModel::where('student_date',date('Y-m-d',strtotime($_GET['avail_checked_date'])))->get();
        if(count($checkQuery) > 0){
            foreach($checkQuery as $checkQ){
                $checking_time = $checkQ->avail_from_time;
                // diff times
                $start = strtotime($checkQ->avail_from_time);
                $end = strtotime($checkQ->avail_to_time);
                $mins = ($end - $start) / 60;
                // diff times
            }
        }

        $getChoosenDate = $_GET['avail_checked_date'];

        $divide_time = $mins/$total_count_in_mins;
        $whole_time = (int) $divide_time;

        $html['whole_main_time'] = '<option value="">Choose time</option>';
        $addingMinutes= date('H:i',strtotime("+ ".$hrs_time." hour + ".$mins_time." minute",strtotime($checking_time)));
        $disabled_var = '';
        // if($this->choose_time_checking_fx($addingMinutes, $getChoosenDate))
        // {
        //     $disabled_var = 'disabled';
        // }
        $html['whole_main_time'] .= '<option value="'.$addingMinutes.'" '.$disabled_var.'>'.date('H:i',strtotime($checking_time)).' -- '.$addingMinutes."</option>";
        for($i=0; $i < $whole_time; $i++)
        {
            $addingMinutesOld = $addingMinutes;
            $addingMinutes = date('H:i',strtotime("+ ".$hrs_time." hour + ".$mins_time." minute",strtotime($addingMinutes)));
            $disabled_var = '';
            // if($this->choose_time_checking_fx($addingMinutes, $getChoosenDate))
            // {
            //     $disabled_var = 'disabled';
            // }
            // if(strtotime($addingMinutes) > $end)
            // {
            //     break;
            // }
            $html['whole_main_time'] .= '<option value="'.$addingMinutes.'" '.$disabled_var.'>'.$addingMinutesOld.' -- '.$addingMinutes."</option>";
        }

        echo json_encode($html);
    }

    public function choose_time_checking_fx($addingMinutes, $getChoosenDate)
    {
        $checkedDate = date('Y-m-d',strtotime($getChoosenDate));
        $checkedTime = date('H:i:s',strtotime($addingMinutes));
        $checkingQuery = StudentTimeSlotModel::where(['avail_date_booking' => $checkedDate, 'available_time' => $checkedTime])->get();
        if(count($checkingQuery) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function booking_class_previous_time_found_fx(Request $request){
        $avail_time = $_GET['avail_time'];
        $interval_time = $_GET['interval_time'];
        $preDate = date('H:i',strtotime("- ".$interval_time." minute",strtotime($avail_time)));
        echo json_encode($preDate);
    }

    public function available_tenure_fx(Request $request){
        $total_no_of_lessons = $_GET['total_no_of_lessons'];
        $no_of_lessons_in_month = $_GET['no_of_lessons_in_month'];

        if($no_of_lessons_in_month == 4 || $no_of_lessons_in_month == 8)
        {
            $total_number_of_months = ceil($total_no_of_lessons/$no_of_lessons_in_month);
            if($total_number_of_months < 1){
                $html['tenure_time'] = '<option value="full">Full Pay</option>';
            }else if($total_number_of_months < 3){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="full">Full Pay</option>';
            }else if($total_number_of_months == 3){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="3">Pay for three month</option><option value="full">Full Pay</option>';
            }else if($total_number_of_months < 6){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="3">Pay for three month</option><option value="full">Full Pay</option>';
            }else if($total_number_of_months == 6){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="3">Pay for three month</option><option value="6">Pay for six month</option><option value="full">Full Pay</option>';
            }else if($total_number_of_months > 6){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="3">Pay for three month</option><option value="6">Pay for six month</option><option value="full">Full Pay</option>';
            }else{
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="3">Pay for three month</option><option value="6">Pay for six month</option><option value="full">Full Pay</option>';
            }
        }else if($no_of_lessons_in_month == 12){
            $total_number_of_months = ceil($total_no_of_lessons/$no_of_lessons_in_month);
            if($total_number_of_months < 1){
                $html['tenure_time'] = '<option value="full">Full Pay</option>';
            }else if($total_number_of_months < 2){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="full">Full Pay</option>';
            }else if($total_number_of_months == 2){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="2">Pay for two month</option><option value="full">Full Pay</option>';
            }else if($total_number_of_months > 2){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="2">Pay for two month</option><option value="full">Full Pay</option>';
            }else{
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="2">Pay for two month</option><option value="full">Full Pay</option>';
            }
        }else if($no_of_lessons_in_month == 16){
            $total_number_of_months = ceil($total_no_of_lessons/$no_of_lessons_in_month);
            if($total_number_of_months < 1){
                $html['tenure_time'] = '<option value="full">Full Pay</option>';
            }else if($total_number_of_months < 2){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="full">Full Pay</option>';
            }else if($total_number_of_months == 2){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="2">Pay for two month</option><option value="full">Full Pay</option>';
            }else if($total_number_of_months > 2){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="2">Pay for two month</option><option value="full">Full Pay</option>';
            }else{
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="2">Pay for two month</option><option value="full">Full Pay</option>';
            }
        }else{
            $total_number_of_months = ceil($total_no_of_lessons/$no_of_lessons_in_month);
            if($total_number_of_months < 1){
                $html['tenure_time'] = '<option value="full">Full Pay</option>';
            }else if($total_number_of_months < 3){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="full">Full Pay</option>';
            }else if($total_number_of_months == 3){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="3">Pay for three month</option><option value="full">Full Pay</option>';
            }else if($total_number_of_months < 6){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="3">Pay for three month</option><option value="full">Full Pay</option>';
            }else if($total_number_of_months == 6){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="3">Pay for three month</option><option value="6">Pay for six month</option><option value="full">Full Pay</option>';
            }else if($total_number_of_months > 6){
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="3">Pay for three month</option><option value="6">Pay for six month</option><option value="full">Full Pay</option>';
            }else{
                $html['tenure_time'] = '<option value="1">Pay for one month</option><option value="3">Pay for three month</option><option value="6">Pay for six month</option><option value="full">Full Pay</option>';
            }
        }
        $html['no_of_months'] = $total_number_of_months;

        echo json_encode($html);
    }
}
