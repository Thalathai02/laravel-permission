<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    protected $fillable = [
        'DatePropose',
        'OutPropose',
        'Datedecide',
        'Outdecide',
        'Datedecide',
        'Outdecide',
        'Datesend',
        'Outdecide',
        'DateComment',
        'OutComment',
        'DateSubmitProject',
        'OutSubmitProject',
        'DateDue50',
        'OutDue50',
        'DateDue100',
        'OutDue100'
        
];
}