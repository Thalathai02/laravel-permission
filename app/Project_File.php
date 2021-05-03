<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Project_File extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name_file',
        'Project_id_File',
        'status_file_path'
    ];
}
