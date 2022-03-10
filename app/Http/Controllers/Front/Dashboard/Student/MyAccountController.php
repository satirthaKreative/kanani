<?php

namespace App\Http\Controllers\Front\Dashboard\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CountryModel;
use App\Model\Backend\LanguageModel;
use App\Model\Backend\MyAccountModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Jobs\ChildEmailRegJob;
use App\User;
use Redirect,Response,DB,Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChildEmailReg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class MyAccountController extends Controller
{
    use AuthenticatesUsers;
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function myaccount_page_fx(Request $request){
        $getCountryQuery = User::where('id',Auth::user()->id)->get();
        $countryList = CountryModel::where(['country_state' => 'active'])->orderBy('id','ASC')->get();
        $languageList = LanguageModel::where(['language_state' => 'active'])->orderBy('id','ASC')->get();
        return view('front.pages.dashboard-student.pages.my-account.my-account',compact('countryList','languageList','getCountryQuery'));
    }

    public function update_myaccount_submit_fx(Request $request){
        $user_id = $request->input('update_my_account_hidden_id'); 
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $lang_name = $request->input('native_language_name');
        $country_name = $request->input('country_name');
        $user_email = $request->input('user_email');

        $updateArr = [
            'first_name' => $first_name, 
            'last_name' => $last_name, 
            'native_language' => $request->input('native_language_name'), 
            'country_name' => $country_name,  
            'email' => $user_email
        ];

        $updateQuery = User::where('id',$user_id)->update($updateArr);
        if($updateQuery){
            $request->session()->flash('success_msg', 'Successfully updated');
        }else{
            $request->session()->flash('error_msg', 'Something went wrong! try again  later ');
        }
        return redirect()->back();
    }

    public function update_myaccount_password_submit_fx(Request $request)
    {
        $user_id = $request->input('update_my_account_hidden_id'); 
        $pass = $request->input('create_password_name');
        $cpass = $request->input('confirm_password_name');

        if($pass == ""){
            $request->session()->flash('error_msg', 'password cannot be null');
        }
        else if(strlen($pass) < 8)
        {
            $request->session()->flash('error_msg', 'password cannot less than 8 characters');
        }
        else if($cpass == ""){
            $request->session()->flash('error_msg', 'confirm password cannot be null');
        }
        else if($cpass != $pass)
        {
            $request->session()->flash('error_msg', 'Both the password does not match');
        }
        else
        {
            $updateArr = [
                'password' => Hash::make($pass)
            ]; 
            $updateQuery = User::where('id',$user_id)->update($updateArr);
            if($updateQuery){
                $request->session()->flash('success_msg', 'Successfully updated');
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! try again  later ');
            }
        }
        return redirect()->back();
    }

    public function update_myaccount_email_submit_fx(Request $request)
    {
        $user_id = $request->input('update_my_account_hidden_id'); 
        $email = $request->input('new_email_address_name');
        // $pass = $request->input('password');

        $getCheckingUser = user::where('id','!=',$user_id)->where('email',$email)->get();

        if($email == ""){
            $request->session()->flash('error_msg', 'email cannot be null');
        }
        else if(count($getCheckingUser) > 0)
        {
            $request->session()->flash('error_msg', 'This email address already registered');
        }
        else
        {
            $updateArr = [
                'email' => $email
            ]; 
            $updateQuery = User::where('id',$user_id)->update($updateArr);
            if($updateQuery){
                $request->session()->flash('success_msg', 'Successfully updated');
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! try again  later ');
            }
        }
        return redirect()->back();
    }

    public function delete_myaccount_submit_fx(Request $request)
    {
        $user_id = $request->input('update_my_account_hidden_id');
        $updateArr = [
            'account_status' => 'inactive'
        ]; 
        $updateQuery = User::where('id',$user_id)->update($updateArr);
        if($updateQuery){
            $request->session()->flash('success_msg', 'Successfully deleted');
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect()->route('login');
        }else{
            $request->session()->flash('error_msg', 'Something went wrong! try again  later ');
            return redirect()->back();
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
