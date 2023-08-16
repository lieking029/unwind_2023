<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = [
        'resort_id',
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
