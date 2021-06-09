<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class project extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'status',
        'name_mentor',
        'subject_id'
       ];
   
}
