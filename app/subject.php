<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class subject extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'test50',
        'test100',
        'presentations',
        'Test_in_time',
        'Internship_score',
        
];
}