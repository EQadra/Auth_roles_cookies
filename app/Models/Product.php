<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'metal_type',
        'grams',
        'purity',
        'price_per_gram',
        'image_path',
    ];
}
