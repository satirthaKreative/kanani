<?php

namespace App\Model\Backend\CMS\Courses;

use Illuminate\Database\Eloquent\Model;

class AllCoursesModel extends Model
{
    protected $table = "cms_adult_teen_child_courses_tbls";
    protected $fillable = [
        'main_img', 'main_course_type', 'total_chapters', 'total_lessons', 'course_heading', 'course_description', 'get_started_img', 'get_started_heading', 'get_started_discount_price', 'get_started_total_price', 'get_started_percentage_price', 'this_course_includes_heading', 'this_course_includes_paragraph', 'lets_see_online_img','lets_see_online_upper_heading', 'lets_see_online_main_heading', 'lets_see_online_main_paragraph', 'course_user_type', 'created_at', 'updated_at'
    ];
}
