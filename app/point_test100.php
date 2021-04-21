<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class point_test100 extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'project_id_point_test100',
        'id_instructor_point_test100',
        'point_test100',
        'status_point_test100',
        'reg_id_point_test100'
       ];
}
