<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Amenity;
use App\Models\Address;
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
        'property_type_id',
        'visibility',
        'description',
        'has_12_hours_cancellation_policy',
        'featured_media',
        'user_id'
    ];

    protected $casts = [
        'visibility' => ResortVisibilityEnum::class,
    ];

    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function addons(): BelongsToMany
    {
        return $this->belongsToMany(Addon::class);
    }

    public function associatedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_resort'); // using the pivot table resort_user
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
