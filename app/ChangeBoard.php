<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ChangeBoard extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'Project_id_ChangeBoard',
        'old_name_president',
        'old_name_director1',
        'old_name_director2',
        'new_name_president',
        'new_name_director1',
        'new_name_director2',
        'note',
        'status_ChangeBoard'
    ];
}
