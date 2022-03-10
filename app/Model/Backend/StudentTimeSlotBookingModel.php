<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class StudentTimeSlotBookingModel extends Model
{
    protected $table = "student_booking_tbls";

    protected $fillable = [
        'user_id', 'paypal_package_name', 'paypal_package_radio_name', 'paypal_package_price_name', 'course_class_start_time_name', 'course_class_end_time_name', 'course_comment_name', 'student_booking_status', 'admin_shown_status', 'created_at', 'updated_at'
    ];
}
