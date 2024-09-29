<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role_id',
    ];
    

    // app/Models/User.php

// app/Models/User.php

public function role()
{
    return $this->belongsTo(Role::class); // Assuming you have a Role model
}

public function permissions()
{
    return $this->role->permissions(); // This assumes the Role model has a permissions relationship
}

public function hasPermission($permissionName)
{
    return $this->permissions()->where('name', $permissionName)->exists();
}

    /**
     * The attributes that should be hidden for 
     * serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
