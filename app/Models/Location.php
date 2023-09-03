<?php

namespace App\Models;

use App\Models\Resort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id',
        'street_number',
        'postal_code',
        'barangay_district',
        'street_name',
        'description',
        'region_id',
        'province_id',
        'city_id',
        'barangay_id',
        'landmark',
        'latitude',
        'longitude'
    ];


    public function property() : BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
