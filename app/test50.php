<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class test50 extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'Project_id_test50',
        'date_test50',
        'end_date_test50',
        'room_test50',
        'file_test50',
        'status_test50'
    ];
}
