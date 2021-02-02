<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_instructor extends Model
{
    protected $fillable = [
        'id',
        'Project_id',
        'id_instructor',
        'Is_president'
      
    ];
}
