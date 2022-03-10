<?php

namespace App\Model\Backend\Config;

use Illuminate\Database\Eloquent\Model;

class FreeTrailConfigModel extends Model
{
    protected $table = "config_admin_free_trail_tbl";
    
    protected $fillable = [
        'config_time_hrs_interval', 'config_time_mins_interval', 'created_at', 'updated_at'
    ];
}