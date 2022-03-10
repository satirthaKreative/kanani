<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class CourseAgeModel extends Model
{
    protected $table = "course_age_tbls";

    protected $fillable = [
        'age_from', 'age_to', 'created_at', 'updated_at'
    ];
}
