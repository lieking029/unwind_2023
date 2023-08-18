<?php

namespace App\Models;

use App\Models\Barangay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'psgc_code',
        'description',
        'code',
        'province_id',
    ];

    public function barangays(): HasMany {
        return $this->hasMany(Barangay::class);
    }
}
