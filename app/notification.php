<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class notification extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
       'type',
       'notifiable_type',
       'notifiable_id',
       'data',
       'read_at'
    ];
}
