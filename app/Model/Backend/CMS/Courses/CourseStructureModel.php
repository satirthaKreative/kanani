<?php

namespace App\Model\Backend\CMS\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseStructureModel extends Model
{
    protected $table = "cms_course_structure_tbls";
    protected $fillable = [
        'course_type', 'course_details', 'course_lessons', 'course_units', 'course_duration', 'age_type', 'course_user_type', 'cms_course_main_tbl_id', 'created_at', 'updated_at'
    ];
}