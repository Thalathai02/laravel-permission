<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class changetopic extends Model
{use SoftDeletes;
    protected $fillable = [
        'id',
        'Project_id_changetopics',
        'old_name_th',
        'old_name_en',
        'new_name_th',
        'new_name_en',
        'note',
        'status_changetopics'
    ];
}
