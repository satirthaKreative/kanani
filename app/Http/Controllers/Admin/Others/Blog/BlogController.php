<?php

namespace App\Http\Controllers\Admin\Others\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CMS\CmsBlogModel;

class BlogController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $iQuery = CmsBlogModel::get();
        return view('admin.dashboard.pages.other-pages.blog.blogs',compact('iQuery'));
    }

    public function blog_details_fx(Request $request){
        return view('front.pages.other-pages.blog-details');
    }

    public function submit_fx(Request $request){
        if($request->hasFile('blog_image')){
            $img1 = $request->file('blog_image')->store('public/blog');
        }else{
            $img1 = "";
        }

        if($request->hasFile('author_img')){
            $author_img = $request->file('author_img')->store('public/blog/author');
        }else{
            $author_img = "";
        }

        $insertArr = [
            "blog_name" => $request->input('blog_name'), 
            "blog_details" => $request->input('blog_description'), 
            "author_name" => $request->input('author_name'), 
            "author_quote" => $request->input('author_quote'),
            "blog_imgs" => $img1, 
            "author_img" => $author_img,
            "fb_link" => $request->input('fb_link'),
            "insta_link" => $request->input('insta_link'), 
            "tw_link" => $request->input('tw_link'), 
            "yt_link" => $request->input('yt_link'),
            "created_at" => date('Y-m-d H:i:s'), 
            "updated_at" => date('Y-m-d H:i:s')
        ];
        $insertQuery = CmsBlogModel::insert($insertArr);
        if($insertQuery){
            $request->session()->flash('success_msg','Successfully Sent Blog');
        }else{
            $request->session()->flash('error_msg','Something Went Wrong!');
        }
        return redirect()->back();
    }

    public function delete_fx(Request $request){
        $delQ = CmsBlogModel::where('id',$_GET['id'])->delete();
        if($delQ){
            $msg = "success";
        }else{
            $msg = "error";
        }
        echo json_encode($msg);
    }
}
