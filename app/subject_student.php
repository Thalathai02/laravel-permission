<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subject_student extends Model
{
    protected $fillable = [
     'subject_id', 'student_id',
    ];
}
