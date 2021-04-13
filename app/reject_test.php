<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class reject_test extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'project_id_reject_tests',
        'test_id',
        'id_user_reject_tests',
        'comment_reject_tests',
    ];
}
