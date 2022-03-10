<?php

namespace App\Http\Controllers\Admin\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Student\StudentTimeSlotModel;
use App\Model\Backend\CountryTimezone\TimezoneModel;

class AvailableSlotController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $trailQuery = StudentTimeSlotModel::get();
        $countryTimezoneQuery = TimezoneModel::get();
        return view('admin.dashboard.pages.student.available-slot',compact('trailQuery','countryTimezoneQuery'));
    }

    public function check_fx($get_date)
    {
        $checkQuery = StudentTimeSlotModel::get();
        $x = false;
        foreach($checkQuery as $cQuery)
        {
            $fetch_date = date('Y-m-d',strtotime($cQuery->student_date));
            $get_date1 = $get_date;
            $input_date = date('Y-m-d',strtotime($get_date1));
            if(strtotime($fetch_date) == strtotime($input_date))
            {
                $x = true;
            }
        }
        return $x;
    }

    public function add_fx(Request $request){
        $get_date = $request->input('avail_date_name');
        if($this->check_fx($get_date) == true)
        {
            $request->session()->flash('error_msg', 'This timeframe already added before');
            return redirect()->back();
        }
        else
        {
            $insertArr = [
                'student_date' => $request->input('avail_date_name'),
                'avail_from_time' => $request->input('avail_from_time_name'),
                'avail_to_time' => $request->input('avail_to_time_name'),
                'timezone_tbl_id' => $request->input('timezone_name'),
                'created_at' => date('Y-m-d'), 
                'updated_at' => date('Y-m-d')
            ];
        
            $insertQuery = StudentTimeSlotModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Available date-time added successfully');
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
            }
            return redirect()->back();
        }
    }

    public function edit_fx(Request $request){
        $selectQuery = StudentTimeSlotModel::where(['id' => $_GET['id'] ])->get();
        foreach($selectQuery as $sQuery)
        {
            $html['avail_date'] = $sQuery->student_date;
            $html['avail_from'] = $sQuery->avail_from_time;
            $html['avail_to'] = $sQuery->avail_to_time;
            $html['avail_timezone'] = '<option value="">Choose Timezone</option>';
            $countryTimezoneQuery = TimezoneModel::get();
            foreach($countryTimezoneQuery as $timezoneQ){
                $selected = "";
                if($timezoneQ->id == $sQuery->timezone_tbl_id){
                    $selected = "selected";
                }
                $html['avail_timezone'] .= '<option value="'.$timezoneQ->id.'" '.$selected.'>'.ucwords($timezoneQ->TimeZone).' ( '.$timezoneQ->UTCoffset.' ) </option>';
            }
        }
        echo json_encode($html);
    }

    public function update_fx(Request $request){
        $checkQuery = StudentTimeSlotModel::where(["student_date" => $request->input('avail_date_name')])->where('id','!=',$request->input('free_trail_hidden_name'))->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This timeframe already added');
            return redirect()->back();
        }
        else
        {
            $insertArr = [
                'student_date' => $request->input('avail_date_name'),
                'avail_from_time' => $request->input('avail_from_time_name'),
                'avail_to_time' => $request->input('avail_to_time_name'),
                'timezone_tbl_id' => $request->input('timezone_name'),
                "updated_at" => date('Y-m-d H:i:s')
            ];
    
            $insertQuery = StudentTimeSlotModel::where('id',$request->input('free_trail_hidden_name'))->update($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Successfully updated');
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
            }
            return redirect()->back();
        }
    }

    public function delete_fx(Request $request){
        $delQuery = StudentTimeSlotModel::where(['id' => $_GET['id'] ])->delete();
        $msg = "error";
        if($delQuery){
            $msg = "success";
        }
        echo  json_encode($msg);
    }

    public function change_status_fx(Request $request){
        $updateStateArr = [
            "students_avail" => $_GET['new_state'],
        ];
        $updateStateQuery = StudentTimeSlotModel::where(['id' => $_GET['id'] ])->update($updateStateArr);
        $msg = "error";
        if($updateStateQuery){
            $msg = "success";
        }
        echo  json_encode($msg);
    }
}
