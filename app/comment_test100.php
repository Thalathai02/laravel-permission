<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class comment_test100 extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'project_id_comemt_test100',
        'id_instructor_comemt_test100',
        'text_comemt_test100',
        'action_comemt_test100'
    ];
}
