<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'id',
        'Title_name_Instructor',
        'name_Instructor',
        'phone_Instructor',
        'lineId_Instructor',
        'email_Instructor',
        'facebook_Instructor',
        'user_id_Instructor'
    ];
}
