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

        // Primera transacción - compra de oro
        Transaction::create([
            'cash_register_id'    => $cashRegister->id,
            'type'                => 'compra',
            'grams'               => 500.00,
            'purity'              => 0.9000,
            'discount_percentage' => 10.00,
            'price_per_gram_pen'  => 330.57172022,
            'price_per_gram_usd'  => 88.15245873,
            'price_per_oz'        => 3385.00,
            'total_pen'           => 165285.86011221,
            'total_usd'           => 44076.22936325,
            'exchange_rate'       => 3.75,
            'time'                => now()->format('H:i:s'),
            'created_by'          => 1, // ID del usuario
        ]);

        // Segunda transacción - venta de oro
        Transaction::create([
            'cash_register_id'    => $cashRegister->id,
            'type'                => 'venta',
            'grams'               => 250.00,
            'purity'              => 0.9999,
            'discount_percentage' => 5.00,
            'price_per_gram_pen'  => 350.00000000,
            'price_per_gram_usd'  => 93.33333333,
            'price_per_oz'        => 3620.00,
            'total_pen'           => 87500.00000000,
            'total_usd'           => 23333.33333333,
            'exchange_rate'       => 3.75,
            'time'                => now()->format('H:i:s'),
            'created_by'          => 1,
        ]);
    }
}
