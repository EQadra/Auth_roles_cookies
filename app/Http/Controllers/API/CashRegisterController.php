<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashRegister;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CashRegisterController extends Controller
{
    /**
     * Abrir la caja del día actual.
     */
    public function abrir(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'opening_cash' => ['required', 'numeric', 'min:0'],
            'opening_gold' => ['required', 'numeric', 'min:0'],
        ]);

        $today = Carbon::today()->toDateString();

        if (CashRegister::where('date', $today)->exists()) {
            return response()->json(['message' => 'La caja ya fue abierta hoy.'], 409);
        }

        $cashRegister = CashRegister::create([
            'date'          => $today,
            'opening_cash'  => $validated['opening_cash'],
            'opening_gold'  => $validated['opening_gold'],
            'opened_by'     => $user->id,
        ]);

        return response()->json([
            'message' => 'Caja abierta correctamente.',
            'data'    => $cashRegister,
        ], 201);
    }

    /**
     * Cerrar la caja del día actual.
     */
    public function cerrar(Request $request)
    {
        $validated = $request->validate([
            'closing_cash' => ['required', 'numeric', 'min:0'],
            'closing_gold' => ['required', 'numeric', 'min:0'],
        ]);

        $cashRegister = CashRegister::where('date', Carbon::today()->toDateString())->first();

        if (!$cashRegister) {
            return response()->json(['message' => 'No hay caja abierta para hoy.'], 404);
        }

        if (!is_null($cashRegister->closing_cash)) {
            return response()->json(['message' => 'La caja ya fue cerrada.'], 409);
        }

        $cashRegister->update([
            'closing_cash' => $validated['closing_cash'],
            'closing_gold' => $validated['closing_gold'],
            'closed_by'    => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'Caja cerrada correctamente.',
            'data'    => $cashRegister,
        ]);
    }

    /**
     * Obtener la caja del día actual.
     */
    public function actual()
    {
        $cashRegister = CashRegister::where('date', Carbon::today()->toDateString())->first();

        if (!$cashRegister) {
            return response()->json(['message' => 'No hay caja abierta para hoy.'], 404);
        }

        return response()->json([
            'message' => 'Caja actual encontrada.',
            'data'    => $cashRegister,
        ]);
    }
}
