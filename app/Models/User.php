<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const ROLE_ADMIN = 'admin';
    const ROLE_HAMKAR = 'hamkar';
    const ROLE_USER = 'user';


    protected $fillable = [
        'name',
        'role',
        'phone',
        'avatar',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $appends = [
        'profile_photo_url',
    ];

    public function getPermission()
    {
        return Permission::with('roles')->get();
    }

    public function isAdmin()
    {
        if ($this->role !== self::ROLE_ADMIN) {
            return false;
        }
        return true;
    }

    public function isAdminHamkar()
    {
        if ($this->role == 'user') {
            return false;
        } else {
            return true;
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRoles($role)
    {

        if (is_string($role)) {

            return $this->roles->contains('name', $role);
        }
        return !!$role->intersect($this->roles)->count();

    }

    public function Addresses()
    {
        return $this->hasOne(Address::class);
    }

    public function AdminPanel()
    {
        return $this->role === self::ROLE_ADMIN || $this->role === self::ROLE_HAMKAR ? true : false;
    }
}
