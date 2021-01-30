<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_user extends Model
{
    protected $fillable = [
        'id',
        'id_reg_Std',
        'isHead',
        'Project_id',
        'name_mentor'
      
    ];
}
