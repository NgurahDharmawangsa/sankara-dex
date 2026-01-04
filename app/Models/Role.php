<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use LaravelEasyRepository\Traits\GenUid;

class Role extends Model
{
    use HasFactory, GenUid;

    const ADMIN = 'Zq2aQuOaFI';
    const STAFF = '1jyFKsNahG';

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id')->withPivot(['user_id', 'role_id']);
    }
}
