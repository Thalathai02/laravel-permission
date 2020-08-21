<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permissions\HasPermissionsTrait;
class reg_std extends Model
{
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
        'type',
        
];
public function user()
{
    return $this->belongsToMany(User::class,'user_regStd','user_id','reg_std_id');
}

}
