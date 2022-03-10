<?php

namespace App\Model\Frontend\Message\Tutor;

use Illuminate\Database\Eloquent\Model;

class TutorMessageModel extends Model
{
    protected $table = "tutor_message_tbls";
    protected $fillable = [
        'course_tbls_id', 'course_name', 'topic_name', 'user_type', 'teacher_id', 'sender_id', 'receiver_id', 'sender_type', 'message_details', 'message_tbls_status', 'created_at', 'updated_at'
    ];
}