<?php

namespace App\Model\Backend\Tutors;

use Illuminate\Database\Eloquent\Model;

class AssignCalendarModel extends Model
{
    protected $table = "tutors_assign_calendar_tbls";
    protected $fillable = [
        'tutor_id', 'student_id', 'teacher_name', 'student_name', 'admin_action', 'assign_teacher_date', 'created_at', 'updated_at'
    ];
}
