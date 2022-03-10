<?php

namespace App\Model\Backend;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TutorModel extends Authenticatable
{
    use Notifiable;
    protected $guard = "tutor";
    protected $table = "tutors_personal_details";

    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'password', 'img_file', 'tutor_state', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
}