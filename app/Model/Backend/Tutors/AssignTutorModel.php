<?php

namespace App\Model\Backend\Tutors;

use Illuminate\Database\Eloquent\Model;

class AssignTutorModel extends Model
{
    protected $table = "assign_tutors_tbls";
    protected $fillable = [
        "teacher_id", "student_id", "course_id", "assign_tutor", "created_at", "updated_at"
    ];
}
