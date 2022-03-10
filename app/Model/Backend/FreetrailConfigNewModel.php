<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class FreetrailConfigNewModel extends Model
{
    protected $table = "free_trail_config_tbls";

    protected $fillable = [
        'user_id', 'user_action', 'created_at', 'updated_at'
    ];
}
