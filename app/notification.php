<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $fillable = [
        'id',
        'read_notification',
        'form_notification',
        'user_id_notification',
        'form_id_notification'
    ];
}
