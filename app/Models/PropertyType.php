<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PropertyType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function property() : HasOne
    {
        return $this->hasOne(Property::class);
    }
}


// Property Type
// $resort = [
//     'resort_name',
//     'base_price',
//     'resort_type',
//     'visivility',
//     '12_hours_cancelation_policy',
//     'resort_description',
//     'location',
//     'amenities',
//     'addons',
//     'subhost',
//     'rooms',
//     'pools',
//     'water_sports',
// ];

// $hotelRooms = [
//     'room_no',
//     'floor_no',
//     '12_hours_cancelation_policy',
//     'room_description',
//     'base_price',
//     'bed_count',
//     'bed_type',
//     'bath_count',
//     'addons',
//     'amenities',
//     'necessities',
//     'max_occupancy',
//     'smoking_or_not'
// ];

// $motelRooms = [
//     'room_no',
//     'floor_no',
//     'room_description',
//     'base_price',
//     'bed_count',
//     'bed_type',
//     'bath_count',
//     'addons',
//     'amenities',
//     'necessities',
//     'location',
//     '12_hours_cancelation_policy',
//     'max_occupancy',
// ];

// $condoProperties = [
//     'property_name',
//     'property_type',
//     'location',
//     'description',
//     'price',
//     'size',
//     'bedrooms',
//     'bathrooms',
//     'amenities',
//     'features',
//     'security_features',
//     'hoa_fees',
//     'pet_friendly',
//     'nearby_attractions',
// ]










