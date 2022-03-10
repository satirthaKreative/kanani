<?php

namespace App\Model\Frontend\Suscribe;

use Illuminate\Database\Eloquent\Model;

class SubcribeModel extends Model
{
    protected $table = "suscribe_tbls";
    protected $fillable = [
        'suscribe_email', 'admin_action', 'created_at', 'updated_at'
    ];
}
