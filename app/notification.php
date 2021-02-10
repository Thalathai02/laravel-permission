<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $fillable = [
        'id',
       'type',
       'notifiable_type',
       'notifiable_id',
       'data',
       'read_at'
    ];
}
