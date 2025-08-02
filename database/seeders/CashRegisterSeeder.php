<?php



namespace Database\Seeders;

use App\Models\CashRegister;
use Illuminate\Database\Seeder;

class CashRegisterSeeder extends Seeder
{
    public function run(): void
    {
        CashRegister::create([
            'date' => now()->startOfDay(),
            'opening_cash' => 1000.00,
            'opening_gold' => 50.00,   // gramos
            'opening_silver' => 200.00 // gramos
        ]);

        // Puedes agregar más registros si deseas simular más días
    }
}
