<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class reg_std extends Model
{
    use SoftDeletes;
    use HasPermissionsTrait;
    protected $fillable = [
        'id',
        'std_code',
        'name',
        'nick_name',
        'phone',
        'lineId',
        'email',
        'facebook',
        'address',
        'parent_name',
        'parent_phone',
        'username',
        'password',
        'note',
        'avatar',
        'gpa',
        'Internship_score'

    ];
    public function user()
    {
        return $this->belongsToMany(User::class, 'reg_stds', 'user_id');
    }
}
