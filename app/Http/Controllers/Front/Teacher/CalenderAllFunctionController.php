<?php

namespace App\Http\Controllers\Front\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CountryModel;
use App\Model\Backend\TutorModel;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Model\Frontend\Teacher\CalenderModel;

class CalenderAllFunctionController extends Controller
{
    # calender 
    public function calender_day_to_date_fx(Request $request){
        $startDate = "17-12-2021";
        $day_number = 1;
        $endDate = strtotime("31-12-2021");
        $days=array('1'=>'Monday','2' => 'Tuesday','3' => 'Wednesday','4'=>'Thursday','5' =>'Friday','6' => 'Saturday','7'=>'Sunday');
        for($i = strtotime($days[$day_number], strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 week', $i))
        $date_array[]=date('Y-m-d',$i);
        print_r( $date_array );
    }
    # calender submit
    public function calender_day_to_date_submit_fx(Request $request){
        foreach($request->input('arrName') as $arr_name){
            # days name
            $days_name = $arr_name;
            # teacher id
            $teacher_id = Auth::guard('teacher')->user()->first_name;
            $insertArr = [
                'teacher_id' => $teacher_id, 
                'booking_days_id' => , 
                'booking_actual_date' => , 
                'booking_old_date' => , 
                'booking_days_name' => , 
                'booking_teacher_start_date_name' => , 
                'booking_teacher_end_date_name' => , 
                'booking_teacher_notifying_date_name' => , 
                'booking_teacher_available_start_time' => , 
                'booking_teacher_available_end_time' => , 
                'updated_booking_on' => date('0000-00-00'), 
                'calender_active_status' => 'active', 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $insertQuery = 
        }
    }
}
