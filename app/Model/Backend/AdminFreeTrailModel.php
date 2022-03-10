<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class AdminFreeTrailModel extends Model
{
    protected $table = "admin_free_trail_tbls";

    protected $fillable = [
        'teachers_available_time', 'teacher_id', 'teachers_date', 'avail_from_time', 'avail_to_time', 'teachers_avail', 'created_at', 'updated_at'
    ];
}