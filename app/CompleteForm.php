<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CompleteForm extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'Project_id_CompleteForm',
        'status_CompleteForm',
    ];
}
