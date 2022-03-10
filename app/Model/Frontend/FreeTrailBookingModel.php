<?php

namespace App\Model\Frontend;

use Illuminate\Database\Eloquent\Model;

class FreeTrailBookingModel extends Model
{
    protected $table = "booking_slot_tbls";

    protected $fillable = [
        'user_id', 'age_id', 'english_level_id', 'avail_date_booking', 'available_time', 'avail_time_interval', 'msg_data', 'created_at', 'updated_at'
    ];
}