<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use LaravelEasyRepository\Traits\GenUid;

class Subcategory extends Model
{
    use HasApiTokens, HasFactory, Notifiable, GenUid, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category_id',
        'is_active',
    ];

    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function jobs(): belongsToMany
    {
        return $this->belongsToMany(Job::class);
    }
}
