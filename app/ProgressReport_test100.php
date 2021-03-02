<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProgressReport_test100 extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id',
        'Project_id_report_test100',
        'status_progress_report_test100',
    ];
}
