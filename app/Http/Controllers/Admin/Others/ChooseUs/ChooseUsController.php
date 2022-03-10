<?php

namespace App\Http\Controllers\Admin\Others\ChooseUs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CMS\CmsChooseUsModel;

class ChooseUsController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $chooseQuery = CmsChooseUsModel::get();
        return view('admin.dashboard.pages.other-pages.choose-us',compact('chooseQuery'));
    }

    public function submit_fx(Request $request){
        $getChooseQuery = CmsChooseUsModel::get();
        if(count($getChooseQuery) > 0)
        {
            foreach ($getChooseQuery as $key_value) {
                $getChooseImg1 = $key_value->paragraph1_img;
                $getChooseImg2 = $key_value->paragraph2_img;
                $getChooseImg3 = $key_value->paragraph3_img;
                $getChooseImg4 = $key_value->section1_img;
                $getChooseImg5 = $key_value->section2_img;
                $getChooseImg6 = $key_value->section3_img;
                $getChooseImg7 = $key_value->section4_img;
                $getChooseImg8 = $key_value->section5_img;
            }
            #img1
            if($request->hasFile('image_name1')){
                $img1 = $request->file('image_name1')->store('public/chooseUs');
            }else{
                $img1 = $getChooseImg1;
            }
            #img2
            if($request->hasFile('image_name2')){
                $img2 = $request->file('image_name2')->store('public/chooseUs');
            }else{
                $img2 = $getChooseImg2;
            }
            #img3
            if($request->hasFile('image_name3')){
                $img3 = $request->file('image_name3')->store('public/chooseUs');
            }else{
                $img3 = $getChooseImg3;
            }
            #img4
            if($request->hasFile('image_name4')){
                $img4 = $request->file('image_name4')->store('public/chooseUs');
            }else{
                $img4 = $getChooseImg4;
            }
            #img5
            if($request->hasFile('image_name5')){
                $img5 = $request->file('image_name5')->store('public/chooseUs');
            }else{
                $img5 = $getChooseImg5;
            }
            #img6
            if($request->hasFile('image_name6')){
                $img6 = $request->file('image_name6')->store('public/chooseUs');
            }else{
                $img6 = $getChooseImg6;
            }
            #img7
            if($request->hasFile('image_name7')){
                $img7 = $request->file('image_name7')->store('public/chooseUs');
            }else{
                $img7 = $getChooseImg7;
            }
            #img8
            if($request->hasFile('image_name8')){
                $img8 = $request->file('image_name8')->store('public/chooseUs');
            }else{
                $img8 = $getChooseImg8;
            }
            $insertArr = [
                "heading1_name" => $request->input('heading_name1'), 
                "paragraph1_name" => $request->input('paragraph_heading1'),
                "author_name" => $request->input('author_name'), 
                "heading2_name" => $request->input('heading_name2'), 
                "paragraph2_name" => $request->input('paragraph_heading2'),  
                "heading3_name" => $request->input('heading_name3'), 
                "paragraph3_name" => $request->input('paragraph_heading3'), 
                "section1_name" => $request->input('section1_heading'), 
                "section1_paragraph" => $request->input('section1_paragraph'), 
                "section2_name" => $request->input('section2_heading'), 
                "section2_paragraph" => $request->input('section2_paragraph'), 
                "section3_name" => $request->input('section3_heading'), 
                "section3_paragraph" => $request->input('section3_paragraph'), 
                "section4_name" => $request->input('section4_heading'), 
                "section4_paragraph" => $request->input('section4_paragraph'), 
                "section5_name" => $request->input('section5_heading'), 
                "section5_paragraph" => $request->input('section5_paragraph'),
                "paragraph1_img" => $img1, 
                "paragraph2_img" => $img2, 
                "paragraph3_img" => $img3, 
                "section1_img" => $img4, 
                "section2_img" => $img5, 
                "section3_img" => $img6,
                "section4_img" => $img7, 
                "section5_img" => $img8,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ];
            $insertQuery = CmsChooseUsModel::where('id',1)->update($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully updated');
            }else{
                $request->session()->flash('error_msg','Something went wrong');
            }
            return redirect()->back();
        }else{
            #img1
            if($request->hasFile('image_name1')){
                $img1 = $request->file('image_name1')->store('public/chooseUs');
            }else{
                $img1 = "";
            }
            #img2
            if($request->hasFile('image_name2')){
                $img2 = $request->file('image_name2')->store('public/chooseUs');
            }else{
                $img2 = "";
            }
            #img3
            if($request->hasFile('image_name3')){
                $img3 = $request->file('image_name3')->store('public/chooseUs');
            }else{
                $img3 = "";
            }
            #img4
            if($request->hasFile('image_name4')){
                $img4 = $request->file('image_name4')->store('public/chooseUs');
            }else{
                $img4 = "";
            }
            #img5
            if($request->hasFile('image_name5')){
                $img5 = $request->file('image_name5')->store('public/chooseUs');
            }else{
                $img5 = "";
            }
            #img6
            if($request->hasFile('image_name6')){
                $img6 = $request->file('image_name6')->store('public/chooseUs');
            }else{
                $img6 = "";
            }
            #img7
            if($request->hasFile('image_name7')){
                $img7 = $request->file('image_name7')->store('public/chooseUs');
            }else{
                $img7 = "";
            }
            #img8
            if($request->hasFile('image_name8')){
                $img8 = $request->file('image_name8')->store('public/chooseUs');
            }else{
                $img8 = "";
            }
            $insertArr = [
                "heading1_name" => $request->input('heading_name1'), 
                "paragraph1_name" => $request->input('paragraph_heading1'),
                "author_name" => $request->input('author_name'), 
                "heading2_name" => $request->input('heading_name2'), 
                "paragraph2_name" => $request->input('paragraph_heading2'),  
                "heading3_name" => $request->input('heading_name3'), 
                "paragraph3_name" => $request->input('paragraph_heading3'), 
                "section1_name" => $request->input('section1_heading'), 
                "section1_paragraph" => $request->input('section1_paragraph'), 
                "section2_name" => $request->input('section2_heading'), 
                "section2_paragraph" => $request->input('section2_paragraph'), 
                "section3_name" => $request->input('section3_heading'), 
                "section3_paragraph" => $request->input('section3_paragraph'),
                "section4_name" => $request->input('section4_heading'), 
                "section4_paragraph" => $request->input('section4_paragraph'), 
                "section5_name" => $request->input('section5_heading'), 
                "section5_paragraph" => $request->input('section5_paragraph'),
                "paragraph1_img" => $img1, 
                "paragraph2_img" => $img2, 
                "paragraph3_img" => $img3, 
                "section1_img" => $img4, 
                "section2_img" => $img5, 
                "section3_img" => $img6,
                "section4_img" => $img7, 
                "section5_img" => $img8, 
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ];
            $insertQuery = CmsChooseUsModel::insert($insertArr);
            if($insertQuery){
                $request->session()->flash('success_msg','Successfully inserted');
            }else{
                $request->session()->flash('error_msg','Something went wrong');
            }
            return redirect()->back();
        }
    }
}
