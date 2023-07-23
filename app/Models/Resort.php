<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Amenity;
use App\Enums\ResortVisibilityEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resort extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'resort_type_id',
        'visibility',
        'description',
        'has_12_hours_cancellation_policy'
    ];

    protected $casts = [
        'visibility' => ResortVisibilityEnum::class,
    ];

    public function propertyType() : BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function location() : HasOne
    {
        return $this->hasOne(Location::class);
    }

    public function rooms() : HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function amenities() : HasMany
    {
        return $this->hasMany(Amenity::class);
    }

    public function addons() : HasMany
    {
        return $this->hasMany(Addon::class);
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

}
