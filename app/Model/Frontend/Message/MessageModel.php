<?php

namespace App\Model\Frontend\Message;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    protected $table = "message_tbls";
    protected $fillable = [
        "course_tbls_id", "course_name", "topic_name", "user_type", "teacher_id", "sender_id", "receiver_id", "sender_type", "message_tbls_status", "created_at", "updated_at"
    ];
}