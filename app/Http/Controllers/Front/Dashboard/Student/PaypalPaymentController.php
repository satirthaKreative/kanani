<?php

namespace App\Http\Controllers\Front\Dashboard\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\StudentTimeSlotBookingModel;
use App\Model\Backend\Order\OrderModel;

class PaypalPaymentController extends Controller
{
    public function payment_process_fx(Request $request,$id,$pay_price){
        return view('front.pages.dashboard-student.pages.paypal.payment',compact('id','pay_price'));
    }

    public function payment_success_process_fx(Request $request,$id){
        $payerId =  $_GET['PayerID'];
        $tokanId = $_GET['token'];
        $mfid = $_GET['mfid'];
        $rcache = $_GET['rcache'];

        # updating order 
        $updatePaymentState = StudentTimeSlotBookingModel::where(['id' => base64_decode($id)])->update(['paypal_payment_status' => 'active']);
        if($updatePaymentState){
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
            $request->session()->flash('success_msg','Successfully booked');
        }
        else{
            $request->session()->flash('error_msg','Payment not accepted ! Try again');
        }
        return redirect()->route('satirtha.show-booking-page');
    }

    public function payment_error_process_fx(Request $request){
        $request->session()->flash('error_msg','Payment canceled ! Try again');
        return redirect()->route('satirtha.show-booking-page');
    }
}
