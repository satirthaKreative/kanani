<?php

namespace App\Http\Controllers\Front\Others\Courses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\CMS\CmsMainCoursesModel;
use App\Model\Backend\CMS\Courses\AllCoursesModel;
use App\Model\Backend\CMS\Courses\CourseStructureModel;

class CourseController extends Controller
{
    public function index(Request $request){
        $getQuery = CmsMainCoursesModel::get();
        return view('front.pages.other-pages.courses.course',compact('getQuery'));
    }

    public function adult_courses_fx(Request $request){
        $getQuery = AllCoursesModel::where('course_user_type','adult')->get();
        $getQuery1 = CourseStructureModel::where('course_user_type','adult')->get();
        return view('front.pages.other-pages.courses.adult-course',compact('getQuery','getQuery1'));
    }

    public function teen_courses_fx(Request $request){
        $getQuery = AllCoursesModel::where('course_user_type','teen')->get();
        $getQuery1 = CourseStructureModel::where('course_user_type','teen')->get();
        return view('front.pages.other-pages.courses.teen-course',compact('getQuery','getQuery1'));
    }

    public function child_courses_fx(Request $request){
        $getQuery = AllCoursesModel::where('course_user_type','child')->get();
        $getQuery1 = CourseStructureModel::where('course_user_type','child')->get();
        return view('front.pages.other-pages.courses.child-course',compact('getQuery','getQuery1'));
    }
}
