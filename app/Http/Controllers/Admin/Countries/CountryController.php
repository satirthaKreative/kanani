<?php

namespace App\Http\Controllers\Admin\Countries;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CountryModel;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $checkQuery = CountryModel::orderBy('id','DESC')->get();
        return view('admin.dashboard.pages.country',compact('checkQuery'));
    }  

    public function add_country_fx(Request $request)
    {
        $checkQuery = CountryModel::where(["country_name" => strtolower($request->input('modal_country_name'))])->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This country already added');
            return redirect()->back();
        }
        else
        {
            $insertArr = [
                "country_name" => strtolower($request->input('modal_country_name')), 
                "country_state" => 'active',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ];
    
            $insertQuery = CountryModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Successfully added');
                return redirect()->back();
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
                return redirect()->back();
            }
        }
        
    }


    public function edit_country_fx(Request $request)
    {
        $selectQuery = CountryModel::where(['id' => $_GET['id'] ])->get();
        foreach($selectQuery as $sQuery)
        {
            $html['edit_country'] = $sQuery->country_name;
        }
        echo json_encode($html);
    }

    public function update_country_fx(Request $request)
    {
        $checkQuery = CountryModel::where(["country_name" => strtolower($request->input('edit_modal_country_name'))])->where('id','!=',$request->input('edit_country_hidden_id_name'))->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This country already added');
            return redirect()->back();
        }
        else
        {
            $insertArr = [
                "country_name" => strtolower($request->input('edit_modal_country_name')), 
                "country_state" => 'active',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ];
    
            $insertQuery = CountryModel::where('id',$request->input('edit_country_hidden_id_name'))->update($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Successfully updated');
                return redirect()->back();
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
                return redirect()->back();
            }
        }
    }

    public function del_country_fx(Request $request)
    {
        $delQuery = CountryModel::where(['id' => $_GET['id'] ])->delete();
        $msg = "error";
        if($delQuery){
            $msg = "success";
        }
        echo  json_encode($msg);
    }

    public function change_status_country_fx(Request $request)
    {
        $updateStateArr = [
            "country_state" => $_GET['new_state'],
        ];
        $updateStateQuery = CountryModel::where(['id' => $_GET['id'] ])->update($updateStateArr);
        $msg = "error";
        if($updateStateQuery){
            $msg = "success";
        }
        echo  json_encode($msg);
    }
}
