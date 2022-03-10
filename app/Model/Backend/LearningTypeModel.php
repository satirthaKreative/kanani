<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class LearningTypeModel extends Model
{
    protected $table = "learning_scale_type_tbls";

    protected $fillable = [
        'learning_scale_name', 'learning_status', 'created_at', 'updated_at'
    ];
}
