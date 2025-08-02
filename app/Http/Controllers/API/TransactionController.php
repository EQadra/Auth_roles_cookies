<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cash_register_id' => 'required|exists:cash_registers,id',
            'type'             => 'required|in:compra,venta',
            'metal_type'       => 'required|in:oro,plata',
            'grams'            => 'required|numeric|min:0',
            'price_per_gram'   => 'required|numeric|min:0',
            'total_pen'        => 'required|numeric|min:0',
            'total_usd'        => 'required|numeric|min:0',
            'exchange_rate'    => 'required|numeric|min:0',
            'created_by'       => 'required|exists:users,id', // Idealmente se asigna desde Auth
        ]);

        $transaction = Transaction::create($validated);

        return response()->json([
            'message' => 'Transacción registrada',
            'data'    => $transaction,
        ], 201);
    }

    public function day()
    {
        $transacciones = Transaction::whereDate('created_at', Carbon::today())->get();

        return response()->json([
            'message' => 'Transacciones del día',
            'data'    => $transacciones,
        ]);
    }
}
