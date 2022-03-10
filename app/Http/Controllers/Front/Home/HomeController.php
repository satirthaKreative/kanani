<?php

namespace App\Http\Controllers\Front\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CMS\CmsHomeModel;
use App\Model\Backend\CMS\CmsBlogModel;
use App\Model\Backend\CMS\CmsMainCoursesModel;
use App\Model\CMS\testimonials\CustomersModel;

class HomeController extends Controller
{
    //

    public function index(Request $request)
    {
        $blogQuery = CmsBlogModel::orderBy('updated_at','DESC')->limit(4)->get();
        $singleBlogQuery = CmsBlogModel::orderBy('updated_at','DESC')->limit(1)->get();
        $homeQuery = CmsHomeModel::get();
        $courseQuery = CmsMainCoursesModel::get();
        $getComments = CustomersModel::where('post_state','active')->get();
        return view('front.layouts.home',compact('homeQuery','singleBlogQuery','blogQuery','courseQuery','getComments'));
    }
}