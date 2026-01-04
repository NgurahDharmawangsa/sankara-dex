<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use LaravelEasyRepository\Traits\GenUid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, GenUid, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = ['role_id'];

    public function getRoleIdAttribute()
    {
        return $this->roles[0]->id;
    }

    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withPivot(['user_id', 'role_id']);
    }

    public function jobs(): belongsToMany
    {
        return $this->belongsToMany(Job::class);
    }

    public function isAdmin()
    {
        return $this->roles[0]->id == Role::ADMIN;
    }

    public function isStaff()
    {
        return $this->roles[0]->id == Role::STAFF;
    }
}
