<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addon extends Model
{
    use HasFactory, SoftDeletes;

    public static array $BASIC_ADDONS = [
        'Towel',
        'Shampoo',
        'Sean Shit'
    ];


    /**
     * admin vinerify ko na yung documents ni merchant
     * user table - column is_verified = true mark as true
     * $user->addons()->insert(collect(Addon::$BASIC_ADDONS)->map(fn ($addons) => $addon['created_at] = $now))
     *
     *
     */

    protected $fillable = [
        'name',
        'user_id'
    ];


    public function resort() : BelongsToMany
    {
        return $this->belongsToMany(Resort::class);
    }

    public function scopeOwned(Builder $query) {
        $query->where('user_id', auth()->id());
    }
}
