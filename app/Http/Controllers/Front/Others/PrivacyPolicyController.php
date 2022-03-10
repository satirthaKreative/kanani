<?php

namespace App\Http\Controllers\Front\Others;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivacyPolicyController extends Controller
{
    public function index(Request $request){
        return view('front.pages.other-pages.policy');
    }
}
