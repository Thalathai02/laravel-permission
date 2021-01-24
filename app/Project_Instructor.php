<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_Instructor extends Model
{
    protected $fillable = [
        'id',
        'Project_id',
        'id_instructor',
      
    ];
}
