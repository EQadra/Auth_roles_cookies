<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\CashRegister;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $cashRegister = CashRegister::first();

        if (!$cashRegister) return;

        Transaction::create([
            'cash_register_id' => $cashRegister->id,
            'type' => 'compra',
            'metal_type' => 'oro',
            'grams' => 12.5,
            'price_per_gram' => 250.00,
            'total_pen' => 3125.00,
            'total_usd' => 833.33,
            'exchange_rate' => 3.75,
            'created_by' => 1, // ID del usuario
        ]);

        Transaction::create([
            'cash_register_id' => $cashRegister->id,
            'type' => 'venta',
            'metal_type' => 'plata',
            'grams' => 100,
            'price_per_gram' => 10.00,
            'total_pen' => 1000.00,
            'total_usd' => 266.67,
            'exchange_rate' => 3.75,
            'created_by' => 1,
        ]);
    }
}
