<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectPoints extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'reg_id_collect_points',
        'project_id_collect_points',
        'Internship_score',
        'Test_in_time',
        'presentations',
        'grade'
    ];
}
