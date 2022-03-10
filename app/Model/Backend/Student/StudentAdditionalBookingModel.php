<?php

namespace App\Model\Backend\Student;

use Illuminate\Database\Eloquent\Model;

class StudentAdditionalBookingModel extends Model
{
    //
    protected $table = "next3_student_booking_tbls";

    protected $fillable = [
        'id', 'student_booking_timeslot_tbls_id', 'student_booking_id', 'student_id', 'student_booking_date', 'course_class_start_time_name', 'course_class_end_time_name', 'created_at', 'updated_at'
    ];
}
