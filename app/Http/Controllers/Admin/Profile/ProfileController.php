<?php

namespace App\Http\Controllers\Admin\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $adminQuery = Admin::where('id',1)->get();
        return view('admin.dashboard.pages.profile',compact('adminQuery'));
    }

    public function submitProfile(Request $request)
    {
        $user_name = $request->input('user_name');
        $user_email = $request->input('user_email');
        $user_pass = $request->input('user_pass');
        $user_cpass = $request->input('user_cpass');

        if($user_name == "")
        {
            $request->session()->flash('error_msg', 'Enter your user name');
        }
        else if($user_email == "")
        {
            $request->session()->flash('error_msg', 'Enter your user email');
        }
        else if($user_pass == "")
        {
            $request->session()->flash('error_msg', 'Enter your password');
        }
        else if($user_cpass == "")
        {
            $request->session()->flash('error_msg', 'Enter your confirm password');
        }
        else if($user_pass != $user_cpass)
        {
            $request->session()->flash('error_msg', 'Both passwords does not match ');
        }
        else 
        {
            $insertArr = [
                'remember_token' => $request->input('_token'),
                'name' => $user_name,
                'email' => $user_email,
                'password' => Hash::make($user_pass),
            ];
            $insertQuery = Admin::where('id',1)->update($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg', 'Successfully updated the profile ');
            }else{
                $request->session()->flash('error_msg', 'Something went wrong! Try again ');
            }
        }
        return redirect()->back();
    }
}
