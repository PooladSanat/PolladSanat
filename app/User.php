<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'phone', 'personnel_id', 'status', 'exit'
        ,'sign'
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

    public function roles()
    {
        return $this->belongsToMany(Role::class);

    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contain('name', $role);
        }
        return !!$role->intersect($this->roles)->count();
    }

    public function alternatives()
    {
        return $this->hasMany(Alternatives::class);

    }

    public function invoices()
    {
        return $this->belongsTo(Invoice::class);

    }

    public function target()
    {
        return $this->belongsTo(Target::class);

    }

}
