<?php

namespace App\Http\Controllers\Admin\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $studentQuery = DB::table('users')
                        ->select('users.id','users.first_name','users.last_name','users.email','users.last_name', 'users.account_status','countries.country_name','languages.language_name','users.user_role')
                        ->leftJoin('countries','countries.id','=','users.country_name')->leftJoin('languages','languages.id','=','users.native_language')
                        ->orderBy('users.id','DESC')
                        ->get();
        return view('admin.dashboard.pages.student.student',compact('studentQuery'));
    }
}