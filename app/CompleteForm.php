<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompleteForm extends Model
{
    protected $fillable = [
        'id',
        'Project_id_CompleteForm',
        'status_CompleteForm',
    ];
}
