<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class StudentTimeSlotSubBookingModel extends Model
{
    protected $table = "student_booking_timeslot_tbls";
    protected $fillable = [
        'student_booking_id', 'student_booking_date', 'course_class_start_time_name', 'course_class_end_time_name', 'created_at', 'updated_at'
    ];
}