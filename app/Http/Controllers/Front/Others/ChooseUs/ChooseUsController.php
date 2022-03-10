<?php

namespace App\Http\Controllers\Front\Others\ChooseUs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CMS\CmsChooseUsModel;

class ChooseUsController extends Controller
{
    public function index(Request $request){
        $iQuery = CmsChooseUsModel::get();
        return view('front.pages.other-pages.choose-us',compact('iQuery'));
    }
}
