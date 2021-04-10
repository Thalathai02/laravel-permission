<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class admin extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'Title_name_admin',
        'name_admin',
        'phone_admin',
        'lineId_admin',
        'email_admin',
        'facebook_admin',
        'user_id_admin',
        'avatar'
    ];

}
