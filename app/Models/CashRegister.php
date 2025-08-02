<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    protected $fillable = [
        'user_id', 'fecha', 'inicio_efectivo', 'inicio_oro', 'inicio_plata',
        'cierre_efectivo', 'cierre_oro', 'cierre_plata', 'abierto_en', 'cerrado_en'
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
