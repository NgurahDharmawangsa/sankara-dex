<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelEasyRepository\Traits\GenUid;

class Otp extends Model
{
    use HasFactory, GenUid;

    protected $fillable = ['user_id','code','verify_source','expired_at'];
}
