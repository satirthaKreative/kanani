<?php

namespace App\Http\Controllers\Admin\Languages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\LanguageModel;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $checkQuery = LanguageModel::orderBy('id','DESC')->get();
        return view('admin.dashboard.pages.language',compact('checkQuery'));
    }  

    public function add_lang_fx(Request $request)
    {
        $checkQuery = LanguageModel::where(["language_name" => strtolower($request->input('modal_lang_name'))])->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This language already added');
            return redirect()->back();
        }
        else
        {
            $insertArr = [
                "language_name" => strtolower($request->input('modal_lang_name')), 
                "language_state" => 'active',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ];
    
            $insertQuery = LanguageModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Successfully added');
                return redirect()->back();
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
                return redirect()->back();
            }
        }
        
    }


    public function edit_lang_fx(Request $request)
    {
        $selectQuery = LanguageModel::where(['id' => $_GET['id'] ])->get();
        foreach($selectQuery as $sQuery)
        {
            $html['lang_edit_language'] = $sQuery->language_name;
        }
        echo json_encode($html);
    }

    public function update_lang_fx(Request $request)
    {
        $checkQuery = LanguageModel::where(["language_name" => strtolower($request->input('edit_modal_lang_name'))])->where('id','!=',$request->input('edit_lang_hidden_id_name'))->get();
        if(count($checkQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This language already added');
            return redirect()->back();
        }
        else
        {
            $insertArr = [
                "language_name" => strtolower($request->input('edit_modal_lang_name')), 
                "language_state" => 'active',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ];
    
            $insertQuery = LanguageModel::where('id',$request->input('edit_lang_hidden_id_name'))->update($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Successfully updated');
                return redirect()->back();
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
                return redirect()->back();
            }
        }
    }

    public function del_lang_fx(Request $request)
    {
        $delQuery = LanguageModel::where(['id' => $_GET['id'] ])->delete();
        $msg = "error";
        if($delQuery){
            $msg = "success";
        }
        echo  json_encode($msg);
    }

    public function change_status_lang_fx(Request $request)
    {
        $updateStateArr = [
            "language_state" => $_GET['new_state'],
        ];
        $updateStateQuery = LanguageModel::where(['id' => $_GET['id'] ])->update($updateStateArr);
        $msg = "error";
        if($updateStateQuery){
            $msg = "success";
        }
        echo  json_encode($msg);
    }
}