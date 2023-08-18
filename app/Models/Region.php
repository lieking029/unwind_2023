<?php

namespace App\Models;

use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'psgc_code',
        'description',
        'code'
    ]; 

    public function provinces(): HasMany {
        return $this->hasMany(Province::class);
    }
}
