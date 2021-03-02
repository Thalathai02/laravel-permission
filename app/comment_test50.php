<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class comment_test50 extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'project_id_comemt_test50',
        'id_instructor_comemt_test50',
        'text_comemt_test50',
        'action_comemt_test50'
    ];
}
