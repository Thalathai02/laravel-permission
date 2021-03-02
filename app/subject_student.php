<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class subject_student extends Model
{
    use SoftDeletes;
    protected $fillable = [
     'subject_id', 'student_id',
    ];
}
