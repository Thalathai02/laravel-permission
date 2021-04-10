<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\reg_std;
use App\Teacher;
use App\admin;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasPermissionsTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 'email', 'password','username','type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function reg_std()
    {
        return $this->hasOne(reg_std::class,'user_id');
    }
    public function Teacher()
    {
        return $this->hasOne(Teacher::class,'user_id_Instructor');
    }
    public function admin()
    {
        return $this->hasOne(admin::class,'user_id_admin');
    }
}
