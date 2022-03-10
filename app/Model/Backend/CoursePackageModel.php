<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class CoursePackageModel extends Model
{
    protected $table = "course_package_tbls";

    protected $fillable  = [
        'course_id', 'no_of_lessons_per_month', 'price_per_month', 'package_status', 'created_at', 'updated_at'
    ];
}
