<?php

namespace App\Model\Frontend\Teacher;

use Illuminate\Database\Eloquent\Model;

class z extends Model
{
    protected $table = "teacher_calender_booking_tbls";

    protected $fillable = [
        'id', 'teacher_id', 'booking_days_id', 'booking_actual_date', 'booking_old_date', 'booking_days_name', 'booking_teacher_start_date_name', 'booking_teacher_end_date_name', 'booking_teacher_notifying_date_name', 'booking_teacher_available_start_time', 'booking_teacher_available_end_time', 'updated_booking_on', 'calender_active_status', 'created_at', 'updated_at'
    ];
}
