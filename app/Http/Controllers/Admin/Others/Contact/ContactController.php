<?php

namespace App\Http\Controllers\Admin\Others\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Frontend\Others\ContactModel;

class ContactController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $contactQuery = ContactModel::get();
        return view('admin.dashboard.pages.other-pages.contact',compact('contactQuery'));
    }

    public function add_or_update_fx(Request $request){
        $quotes = $request->input('contact_quote_name');
        $short_des = $request->input('contact_short_description_name');
        $contact_number = $request->input('contact_number_name');
        $contact_email = $request->input('contact_email_name');

        $checkingQuery = ContactModel::get();
        if(count($checkingQuery) > 0){
            $contact_hidden_id = $request->input('contact_hidden_name');
            $insertArr = [
                'quote_name' => $quotes, 
                'short_description' => $short_des, 
                'contact_number' => $contact_number, 
                'contact_email' => strtolower($contact_email), 
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $insertQuery = ContactModel::where('id',$contact_hidden_id)->update($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Successfully updated the contact ');
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again ');
            }
        }else{
            $insertArr = [
                'quote_name' => $quotes, 
                'short_description' => $short_des, 
                'contact_number' => $contact_number, 
                'contact_email' => strtolower($contact_email), 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $insertQuery = ContactModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Successfully added the contact ');
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again ');
            } 
        }
        return redirect()->back();
    }

    public function edit_fx(Request $request)
    {
        $getQuery = ContactModel::where('id',$_GET['id'])->get();
        $html['quote_name'] = "";
        $html['short_description'] = "";
        $html['contact_number'] = "";
        $html['contact_email'] = "";
        if(count($getQuery) > 0)
        {
            foreach($getQuery as $gQuery)
            {
                $html['quote_name'] = $gQuery->quote_name;
                $html['short_description'] = $gQuery->short_description;
                $html['contact_number'] = $gQuery->contact_number;
                $html['contact_email'] = $gQuery->contact_email;
            }
        }
        echo json_encode($html);
    }

    public function del_fx(Request $request)
    {
        $delQuery = ContactModel::where(['id' => $_GET['id'] ])->delete();
        $msg = "error";
        if($delQuery){
            $msg = "success";
        }
        echo  json_encode($msg);
    }
}