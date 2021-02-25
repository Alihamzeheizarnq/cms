<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type_factor',
        'phone_number',
        'is_superuser',
        'is_staff'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function activeCode()
    {
        return $this->hasMany(ActiveCode::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isStaffUser()
    {
        return $this->is_staff;
    }

    public function isSuperUser()
    {
        return $this->is_superuser;
    }


    public function hasPermissions($permissions)
    {


        return !!$this->permissions->contains('name', $permissions->name) || !!$this->roles->intersect($permissions->roles)->count();

    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
