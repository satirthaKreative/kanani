<?php

namespace App\Model\Backend\Student;

use Illuminate\Database\Eloquent\Model;

class StudentTimeIntervalSlotModel extends Model
{
    protected $table = "student_available_interval_slot_tbls";
    protected $fillable = [
        'config_time_hrs_interval', 'config_time_mins_interval', 'created_at', 'updated_at'
    ];
}
