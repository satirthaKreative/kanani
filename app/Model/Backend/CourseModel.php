<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    protected $table = "course_tbls";

    protected $fillable = [
        'id', 'course_name', 'user_role', 'course_price', 'main_course_id', 'age_id', 'no_of_units', 'no_of_lessons', 'times_in_minutes', 'topic_name', 'course_status', 'course_in_month', 'created_at', 'updated_at'
    ];
}
