<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_File extends Model
{
    protected $fillable = [
        'name_file',
        'file_path',
        'status_file_path'
    ];
}
