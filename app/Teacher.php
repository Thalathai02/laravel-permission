<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Teacher extends Model
{
    use SoftDeletes;
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
