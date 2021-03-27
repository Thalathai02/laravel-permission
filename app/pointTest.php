<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pointTest extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'project_id_point_test',
        'id_instructor_point_test',
        'point_test100',
        'point_test50',
        'reg_id_point_test'
       ];
}
