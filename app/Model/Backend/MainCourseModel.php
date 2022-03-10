<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class MainCourseModel extends Model
{
    protected $table = "course_main_tbls";

    protected $fillable = [
        'main_course_name', 'created_at', 'updated_at'
    ];
}