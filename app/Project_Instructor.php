<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class project_instructor extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'Project_id',
        'id_instructor',
        'Is_president'
      
    ];
}
