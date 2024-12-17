<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstimateField extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type'
    ];

    public function values(): HasMany
    {
        return $this->hasMany(EstimateFieldValue::class);
    }
}
