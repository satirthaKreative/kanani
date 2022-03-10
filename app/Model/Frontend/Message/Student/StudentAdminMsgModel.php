<?php

namespace App\Model\Frontend\Message\Student;

use Illuminate\Database\Eloquent\Model;

class StudentAdminMsgModel extends Model
{
    protected $table = "studentadminmsgrelationtbls";
    protected $fillable = [
        "message_tbls", "messages", "user_ids", "created_at", "updated_at"
    ];
}
