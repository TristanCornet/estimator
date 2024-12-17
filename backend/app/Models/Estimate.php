<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estimate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_time'
    ];
    public function lines(): HasMany
    {
        return $this->hasMany(EstimateLine::class);
    }
}
