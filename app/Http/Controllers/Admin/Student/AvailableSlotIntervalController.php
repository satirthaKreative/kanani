<?php

namespace App\Http\Controllers\Admin\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Student\StudentTimeIntervalSlotModel;

class AvailableSlotIntervalController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $configQuery = StudentTimeIntervalSlotModel::get();
        return view('admin.dashboard.pages.student.available-interval-slot',compact('configQuery'));
    }

    public function add_config_fx(Request $request)
    {
        $insertArr = [
            'config_time_hrs_interval' => $request->input('modal_hrs_time_interval_name'),
            'config_time_mins_interval' => $request->input('modal_mins_time_interval_name'),
        ];
        $intval_time = $request->input('config_hidden_time_interval_name');
        if($intval_time == 1){
            $configQuery = StudentTimeIntervalSlotModel::where('id',1)->update($insertArr);
        }else if($intval_time == 0){
            $configQuery = StudentTimeIntervalSlotModel::insert($insertArr);
        }


        if($configQuery){
            $request->session()->flash('success_msg', 'Config panel action success');
        }else{
            $request->session()->flash('error_msg', 'Something went wrong! Try again');
        }
        return redirect()->back();
    }
}