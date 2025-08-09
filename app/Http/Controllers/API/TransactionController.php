<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionController extends Controller
{
    // ✅ Listar todas las transacciones
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Lista de todas las transacciones',
            'data'    => $transactions,
        ]);
    }

    // ✅ Crear nueva transacción (solo oro)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cash_register_id'     => 'required|exists:cash_registers,id',
            'type'                 => 'required|in:compra,venta',
            'grams'                => 'required|numeric|min:0',
            'purity'               => 'required|numeric|min:0|max:1',
            'discount_percentage'  => 'nullable|numeric|min:0|max:100',
            'price_per_gram_pen'   => 'required|numeric|min:0',
            'price_per_gram_usd'   => 'required|numeric|min:0',
            'price_per_oz'         => 'required|numeric|min:0',
            'total_pen'            => 'required|numeric|min:0',
            'total_usd'            => 'required|numeric|min:0',
            'exchange_rate'        => 'required|numeric|min:0',
            'hora'                 => 'nullable|string',
            'created_by'           => 'required|exists:users,id',
        ]);

        // Como siempre será oro, lo seteamos manualmente
        $validated['metal_type'] = 'oro';

        $transaction = Transaction::create($validated);

        return response()->json([
            'message' => 'Transacción registrada',
            'data'    => $transaction,
        ], 201);
    }

    // ✅ Obtener las transacciones del día
    public function day()
    {
        $transacciones = Transaction::whereDate('created_at', Carbon::today())->get();

        return response()->json([
            'message' => 'Transacciones del día',
            'data'    => $transacciones,
        ]);
    }
}
