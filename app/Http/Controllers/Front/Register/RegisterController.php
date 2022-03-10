<?php

namespace App\Http\Controllers\Front\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CountryModel;
use App\Model\Backend\LanguageModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Jobs\ChildEmailRegJob;
use App\User;
use Redirect,Response,DB,Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChildEmailReg;

class RegisterController extends Controller
{
    //
    public function pre_reg_page_fx(Request $request)
    {
        return view('front.layouts.pre-register');
    }

    public function child_reg_page_fx(Request $request)
    {
        $filename = explode('/',$_SERVER["REQUEST_URI"]);
        $getEncodeData = end($filename);
        $decodeUserType = base64_decode($getEncodeData);
        if($decodeUserType == "child")
        {
            $decodeNewUserArr = [
                'role_type_data' => $decodeUserType,
                'role_type_id' => 1
            ];
        }
        else if($decodeUserType == "teen")
        {
            $decodeNewUserArr = [
                'role_type_data' => $decodeUserType,
                'role_type_id' => 2
            ];
        }
        else if($decodeUserType == "adult")
        {
            $decodeNewUserArr = [
                'role_type_data' => $decodeUserType,
                'role_type_id' => 3
            ];
        }

        $countryList = CountryModel::where(['country_state' => 'active'])->orderBy('id','ASC')->get();
        $languageList = LanguageModel::where(['language_state' => 'active'])->orderBy('id','ASC')->get();
        
        return view('front.layouts.child-register',compact('countryList','languageList','decodeNewUserArr'));
    }

    public function child_reg_submit_fx(Request $request)
    {
        $first_name = $request->input('child_first_name');
        $last_name = $request->input('child_last_name');
        $native_language = $request->input('native_lang_name');
        $country_name = $request->input('country_name');
        $name = $request->input('child_username');
        $email = $request->input('child_useremail');
        $password = $request->input('child_user_pass');
        $confirm_password = $request->input('child_user_cpass');
        // child : user role = 1
        $countSelectUser = User::where(['email' => $email])->count();

        if($first_name == "" || $first_name == null){
            $request->session()->flash('error_msg', 'Enter your first name ');
        }else if($last_name == "" || $last_name == null){
            $request->session()->flash('error_msg', 'Enter your last name ');
        }else if($native_language == "" || $native_language == null){
            $request->session()->flash('error_msg', 'Enter your native language ');
        }else if($country_name == "" || $country_name == null){
            $request->session()->flash('error_msg', 'Enter your country name ');
        }else if($name == "" || $name == null){
            $request->session()->flash('error_msg', 'Enter your user name ');
        }else if($email == "" || $email == null){
            $request->session()->flash('error_msg', 'Enter your user email ');
        }else if($password == "" || $password == null){
            $request->session()->flash('error_msg', 'Enter your password ');
        }else if($confirm_password == "" || $confirm_password == null){
            $request->session()->flash('error_msg', 'Enter your confirm name ');
        }else if($password != $confirm_password){
            $request->session()->flash('error_msg', 'Password do not match ');
        }else if($countSelectUser > 0){ 
            $request->session()->flash('error_msg', 'This email user already registered ');
        }else{
            $insertArr = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'native_language' => $native_language,
                'country_name' => $country_name,
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'user_role' => $request->input('type_hidden_role_name')
            ];
            $insertQuery = User::insert($insertArr);
            if($insertQuery){

                $getChildQuery = User::where('email',$email)->get();
                foreach($getChildQuery as $gChild){
                    $getChildId = $gChild->id;
                    $getChildEmail = $gChild->email;
                    $getChildUser = $first_name." ".$last_name;
                }
                $details=[
                    "email"=>$getChildEmail,
                    "title"=>"Activation Link",
                    "body"=>route('satirtha.child-active-link',base64_encode($getChildId)),
                ];
                Mail::to($getChildEmail)->send(new ChildEmailReg($details));
                
                $request->session()->flash('success_msg', 'Your activation link send to your email address ');
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again ');
            }
        }
        return redirect()->back();
    }

    public function child_activation_fx(Request $request)
    {
        $filename = explode('/',$_SERVER["REQUEST_URI"]);
        $getEncodeData = end($filename);
        $decodeId = base64_decode($getEncodeData);
        $mainGenerateId = number_format($decodeId);
        $updateQuery = User::where('id',$mainGenerateId)->update(['account_status' => 'active']);
        if($updateQuery){
            $request->session()->flash('success_msg', 'Your account is successfully activated ');
        }else{
            $request->session()->flash('error_msg', 'Your account is not activated ');
        }
        return redirect()->route('login');
    }
}
