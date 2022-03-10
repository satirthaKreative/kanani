<?php
 
namespace App\Http\Controllers\Front\Teacher\Auth;
 
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/teacher/message';
    public function __construct(){
        $this->middleware('guest:teacher')->except('logout');
    }
    public function showLoginForm(){
        return view('teacher.auth.login');
    }
    public function logout(Request $request){
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('teacher.login');
    }
    protected function guard(){
        return Auth::guard('teacher');
    }
}