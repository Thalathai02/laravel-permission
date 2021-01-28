<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class changetopic extends Model
{
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
