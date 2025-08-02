<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    protected $fillable = [
        'date', 'opening_cash', 'opening_gold', 'opening_silver',
        'closing_cash', 'closing_gold', 'closing_silver',
        'opened_by', 'closed_by'
    ];

    protected $dates = ['abierto_en', 'cerrado_en'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
