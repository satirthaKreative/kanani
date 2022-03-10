<?php
 
namespace App;
  
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
  
class Teacher extends Authenticatable
{
    use Notifiable;
    protected $guard = "teacher";
    protected $table = "tutors_personal_details";
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}