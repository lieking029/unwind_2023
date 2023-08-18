<?php

namespace App\Models;

use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'psgc_code',
        'description',
        'region_id',
        'code',
    ];


    public function region(): BelongsTo {
        return $this->belongsTo(Region::class);
    }


    public function cities(): HasMany {
        return $this->hasMany(City::class);
    }
}
