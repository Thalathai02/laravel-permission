<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProgressReport_test50 extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'Project_id_report_test50',
        'status_progress_report_test50',
    ];
}
