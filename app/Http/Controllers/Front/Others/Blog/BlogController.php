<?php

namespace App\Http\Controllers\Front\Others\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CMS\CmsBlogModel;

class BlogController extends Controller
{
    public function index(Request $request){
        $iQuery = CmsBlogModel::orderBy('updated_at','DESC')->get();
        $authorQuery = CmsBlogModel::orderBy('updated_at','DESC')->limit(1)->get();
        return view('front.pages.other-pages.blog',compact('iQuery','authorQuery'));
    }

    public function blog_details_fx(Request $request, $id){
        $iQuery = CmsBlogModel::where('id',$id)->get();
        $authorQuery = CmsBlogModel::where('id',$id)->get();
        $iAllQuery = CmsBlogModel::orderBy('updated_at','DESC')->limit(5)->get();
        return view('front.pages.other-pages.blog-details',compact('iQuery','authorQuery','iAllQuery'));
    }
}
