<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class project_user extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'id_reg_Std',
        'isHead',
        'Project_id',
        'name_mentor'
      
    ];
}
