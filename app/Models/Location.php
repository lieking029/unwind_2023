<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    protected $fillable = [
        'property_id',
        'loc_details',
        'street_number',
        'postal_code',
        'barangay_district',
        'street_name',
        'loc_description',
    ];

    use HasFactory;

    public function resort() : BelongsTo
    {
        return $this->belongsTo(Resort::class);
    }

}
