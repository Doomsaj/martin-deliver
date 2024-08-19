<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Courier extends Model
{
    use HasFactory, HasApiTokens;

    public function consignments(): HasMany
    {
        return $this->hasMany(Consignment::class);
    }
}
