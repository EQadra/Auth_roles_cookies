<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\CashRegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UserRoleController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\RolePermissionController;


    // 🌐 Página de bienvenida
    Route::get('/', function () {
        return view('welcome');
    });

    // ✅ CSRF cookie (requerido para Sanctum + cookies)
    Route::middleware([EnsureFrontendRequestsAreStateful::class])
        ->get('/sanctum/csrf-cookie', function (Request $request) {
            return response()->noContent();
    });

    // 🔐 Autenticación pública
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // ✅ Perfil del usuario autenticado
    Route::middleware('auth:sanctum')->get('/profile', fn (Request $req) => response()->json([
        'user' => $req->user(),
      ]));

// // 🔒 Rutas protegidas por sesión y permisos
// Route::middleware(['auth'])->group(function () {
// // ✅ Caja
    Route::post('/caja/abrir',  [CashRegisterController::class, 'abrir']);
    Route::post('/caja/cerrar', [CashRegisterController::class, 'cerrar']);
    Route::get('/caja/actual',  [CashRegisterController::class, 'actual']);


    // ✅ Transacciones
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::get('/transactions/day', [TransactionController::class, 'day']);
    Route::post('/transactions', [TransactionController::class, 'store']);

    // ✅ Productos
    Route::get('/productos',         [ProductController::class, 'index']);
    Route::post('/productos',        [ProductController::class, 'store']);
    Route::get('/productos/{id}',    [ProductController::class, 'show']);
    Route::put('/productos/{id}',    [ProductController::class, 'update']);
    Route::delete('/productos/{id}', [ProductController::class, 'destroy']);

    // ✅ Usuarios
    Route::get('/usuarios',         [UserController::class, 'index']);
    Route::post('/usuarios',        [UserController::class, 'store']);
    Route::get('/usuarios/{id}',    [UserController::class, 'show']);
    Route::put('/usuarios/{id}',    [UserController::class, 'update']);
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy']);

    // ✅ Roles y permisos con middleware Spatie
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::get('/roles/{role}', [RoleController::class, 'show']);
    Route::put('/roles/{role}', [RoleController::class, 'update']);
    Route::delete('/roles/{role}', [RoleController::class, 'destroy']);

    Route::get('/permisos', [PermissionController::class, 'index']);
    Route::post('/permisos', [PermissionController::class, 'store']);
    Route::get('/permisos/{permission}', [PermissionController::class, 'show']);
    Route::put('/permisos/{permission}', [PermissionController::class, 'update']);
    Route::delete('/permisos/{permission}', [PermissionController::class, 'destroy']);

    // ✅ Asignar/revocar permisos a roles
    Route::post('/roles/{role}/permisos/asignar', [RolePermissionController::class, 'assignPermission']);
    Route::post('/roles/{role}/permisos/revocar', [RolePermissionController::class, 'revokePermission']);
    Route::get('/roles/{role}/permisos', [RolePermissionController::class, 'permissions']);

    // ✅ Dashboard admin (solo rol admin)
    // Route::middleware('role:admin')->get('/admin/dashboard', function () {
    //     return response()->json(['message' => 'Bienvenido Admin']);
    // });

    // ✅ Acceso por permiso
//     Route::middleware('permission:ver reportes')->get('/reportes', function () {
//         return response()->json(['message' => 'Vista de reportes']);
//     });
// });


