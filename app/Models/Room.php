<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id',
        'max_guest_count',
        'bed_count',
        'bath_count',
        'price',
        'room_image'
    ];

    public function property() : BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

}
