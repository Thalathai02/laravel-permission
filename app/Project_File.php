<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_File extends Model
{
    protected $fillable = [
        'name_file',
        'status_file_path'
    ];
}
