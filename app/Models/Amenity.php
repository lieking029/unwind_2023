<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id',
        'name',
        'user_id',
        'icon                                                  '
    ];


    public function property() : BelongsToMany
    {
        return $this->belongsToMany(Property::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function scopeOwned(Builder $query) {
        $query->where('user_id', auth()->id())
            ->orWhere('user_id', null);
    }
}
