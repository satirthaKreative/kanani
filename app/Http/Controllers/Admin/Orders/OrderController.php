<?php

namespace App\Http\Controllers\Admin\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $getQuery = DB::table('monthly_pay_tbls')
                    ->select('monthly_pay_tbls.id','monthly_pay_tbls.booking_state','monthly_pay_tbls.total_payable_amount','monthly_pay_tbls.paid_amount','monthly_pay_tbls.pending_amount','course_tbls.course_name','course_tbls.topic_name','order_details_tbls.tokanId')
                    ->join('order_details_tbls','monthly_pay_tbls.booking_id','=','order_details_tbls.booking_id')
                    ->join('student_booking_tbls','student_booking_tbls.id','=','monthly_pay_tbls.booking_id')
                    ->join('course_tbls','course_tbls.id','=','student_booking_tbls.paypal_package_main_course_name')
                    ->where(['monthly_pay_tbls.booking_state' => 'active'])
                    ->orderBy('order_details_tbls.booking_id','DESC')
                    ->get();
        return view('admin.dashboard.pages.orders.orders',compact('getQuery'));
    }

    public function single_order_details(Request $request){
        $monthly_pay_id = $_GET['id'];
        $getQuery = DB::table('monthly_pay_tbls')
                    ->select('users.first_name','users.last_name','users.email','monthly_pay_tbls.id','monthly_pay_tbls.booking_state','monthly_pay_tbls.total_payable_amount','monthly_pay_tbls.paid_amount','monthly_pay_tbls.pending_amount','course_tbls.course_name','course_tbls.topic_name','order_details_tbls.tokanId')
                    ->join('order_details_tbls','monthly_pay_tbls.booking_id','=','order_details_tbls.booking_id')
                    ->join('student_booking_tbls','student_booking_tbls.id','=','monthly_pay_tbls.booking_id')
                    ->join('course_tbls','course_tbls.id','=','student_booking_tbls.paypal_package_main_course_name')
                    ->join('users','users.id','=','student_booking_tbls.user_id')
                    ->where(['monthly_pay_tbls.booking_state' => 'active', 'monthly_pay_tbls.id' => $monthly_pay_id ])
                    ->orderBy('order_details_tbls.booking_id','DESC')
                    ->get();
        $html = "";
        foreach($getQuery as $gQuery){
            $html .= '
            <table class="table table-bordered">
            <tbody>
                <tr>
                <th>Course Order Id: </th>
                <td>'.$gQuery->tokanId.'</td>
              </tr>
              <tr>
                <th>Name: </th>
                <td>'.ucwords($gQuery->first_name).' '.ucwords($gQuery->last_name).'</td>
              </tr>
              <tr>
                <th>Email: </th>
                <td>'.$gQuery->email.'</td>
              </tr>
              <tr>
                <th>Course Name: </th>
                <td>'.$gQuery->course_name.'</td>
              </tr>
              <tr>
                <th>Course Level: </th>
                <td>'.$gQuery->topic_name.'</td>
              </tr>
              <tr>
                <th>Course Total Payment: </th>
                <td>$ '.$gQuery->total_payable_amount.'</td>
              </tr>
              <tr>
                <th>Course Paid Amount: </th>
                <td>$ '.$gQuery->paid_amount.'</td>
              </tr>
              <tr>
                <th>Course Pending Amount: </th>
                <td>$ '.$gQuery->pending_amount.'</td>
              </tr>
            </tbody>
          </table>';
        }

        echo json_encode($html);
    }
}
