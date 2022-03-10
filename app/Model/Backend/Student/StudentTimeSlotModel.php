<?php

namespace App\Model\Backend\Student;

use Illuminate\Database\Eloquent\Model;

class StudentTimeSlotModel extends Model
{
    protected $table = "student_available_slot_tbls";
    protected $fillable = [
        'student_available_time', 'student_id', 'student_date', 'avail_from_time', 'avail_to_time', 'students_avail', 'created_at', 'updated_at'
    ];
}
