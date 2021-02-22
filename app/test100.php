<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class test100 extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'Project_id_test100',
        'date_test100',
        'end_date_test100',
        'room_test100',
        'file_test100',
        'status_test100'
    ];
}
