<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'cash_register_id',
        'type',
        'metal_type',
        'grams',
        'purity',
        'discount_percentage',
        'price_per_gram',
        'total_pen',
        'total_usd',
        'exchange_rate', // ← ¡AGREGA ESTO!
        'hora',
        'created_by',    // ← Si usas esto, inclúyelo también
    ];

    public function cashRegister()
    {
        return $this->belongsTo(CashRegister::class);
    }
}
