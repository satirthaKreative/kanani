<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class MyAccountModel extends Model
{
    //
    protected $table = "student_my_account_tbls";

    protected $fillable = [
        'user_id', 'lang_id', 'country_id', 'created_at', 'updated_at'
    ];
}
