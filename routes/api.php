<!-- <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\CashRegisterController;
use App\Http\Controllers\API\ProductController;

use App\Http\Controllers\API\UserController;
//
use App\Http\Controllers\API\UserRoleController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\RolePermissionController;

// ---------- Rutas públicas ----------
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login',    [AuthController::class, 'login']);
// Route::post('/verify-account', [AuthController::class, 'verifyAccount']);
// Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail']);
// Route::post('/reset-password',  [AuthController::class, 'resetPassword']);
// Route::get('/csrf-token', function () {
//     return response()->json(['csrf_token' => csrf_token()]);
// });
// // Route::middleware(['web'])->group(function () {
// //     Route::post('/login', [AuthController::class, 'login']);
// //     Route::post('/logout', [AuthController::class, 'logout']);
// //     Route::get('/me', [AuthController::class, 'profile']);
// //     Route::get('/csrf-token', function () {
// //         return response()->json(['csrf_token' => csrf_token()]);
// //     });
// // });
// ---------- Roles ----------
// Route::get('/roles',              [RoleController::class, 'index']);
// Route::post('/roles',             [RoleController::class, 'store']);
// Route::get('/roles/{role}',       [RoleController::class, 'show']);
// Route::put('/roles/{role}',       [RoleController::class, 'update']);
// Route::delete('/roles/{role}',    [RoleController::class, 'destroy']);
// ---------- Permisos ----------
// Route::get('/permisos',              [PermissionController::class, 'index']);
// Route::post('/permisos',             [PermissionController::class, 'store']);
// Route::get('/permisos/{permission}', [PermissionController::class, 'show']);
// Route::put('/permisos/{permission}', [PermissionController::class, 'update']);
// Route::delete('/permisos/{permission}', [PermissionController::class, 'destroy']);
// Productos (público por ahora)
// Route::get('/productos',         [ProductController::class, 'index']);
// Route::post('/productos',        [ProductController::class, 'store']);
// Route::get('/productos/{id}',    [ProductController::class, 'show']);
// Route::put('/productos/{id}',    [ProductController::class, 'update']);
// Route::delete('/productos/{id}', [ProductController::class, 'destroy']);
// Transacciones sin protección (para pruebas)
// Route::post('/transaccion',        [TransactionController::class, 'store']);
// Route::get('/transacciones/dia',   [TransactionController::class, 'day']);
//asignar y revocar permisos
//----------------------------- Asignar y revocar permisos a roles -----------------------//
// Route::post('/roles/{role}/permisos/asignar', [RolePermissionController::class, 'assignPermission'])->middleware('permission:asignar permisos');
// Route::post('/roles/{role}/permisos/revocar', [RolePermissionController::class, 'revokePermission'])->middleware('permission:revocar permisos');
// Route::get('/roles/{role}/permisos',          [RolePermissionController::class, 'permissions'])->middleware('permission:ver permisos');
//---------------------------------------   ------------------------------------------//
// Route::get('/usuarios',        [UserController::class, 'index']);
// Route::post('/usuarios',       [UserController::class, 'store']);
// Route::get('/usuarios/{id}',   [UserController::class, 'show']);
// Route::put('/usuarios/{id}',   [UserController::class, 'update']);
// Route::delete('/usuarios/{id}',[UserController::class, 'destroy']);
//-------------------------------------------------------------------------------------//
// Route::post('/caja/abrir',  [CashRegisterController::class, 'abrir']);
// Route::post('/caja/cerrar', [CashRegisterController::class, 'cerrar']);
// Route::get('/caja/actual',  [CashRegisterController::class, 'actual']);
// -------------------------------- Rutas protegidas ---------------------------------//
// Route::middleware('auth:sanctum')->group(function () {
//     // Usuario autenticado
//     Route::get('/me',      [AuthController::class, 'profile']);
//     Route::get('/verify-token', [AuthController::class, 'verifyToken']);
//     Route::post('/logout', [AuthController::class, 'logout']);
//     // Acceso por rol
//     Route::get('/admin/dashboard', function () {
//         return response()->json(['message' => 'Bienvenido Admin']);
//     })->middleware('role:admin');
//     // Acceso por permiso
//     Route::get('/reportes', function () {
//         return response()->json(['message' => 'Vista de reportes']);
//     })->middleware('permission:ver reportes');
//     // Caja
//     // Route::post('/caja/abrir',  [CashRegisterController::class, 'abrir']);
//     // Route::post('/caja/cerrar', [CashRegisterController::class, 'cerrar']);
//     // Route::get('/caja/actual',  [CashRegisterController::class, 'actual']);
//       // ... (otras rutas protegidas aquí)
//     // ---------- Roles ----------
//     // Route::get('/roles',              [RoleController::class, 'index'])->middleware('permission:ver roles');
//     // Route::post('/roles',             [RoleController::class, 'store'])->middleware('permission:crear roles');
//     // Route::get('/roles/{role}',       [RoleController::class, 'show'])->middleware('permission:ver roles');
//     // Route::put('/roles/{role}',       [RoleController::class, 'update'])->middleware('permission:editar roles');
//     // Route::delete('/roles/{role}',    [RoleController::class, 'destroy'])->middleware('permission:eliminar roles');

//     // // ---------- Permisos ----------
//     // Route::get('/permisos',              [PermissionController::class, 'index'])->middleware('permission:ver permisos');
//     // Route::post('/permisos',             [PermissionController::class, 'store'])->middleware('permission:crear permisos');
//     // Route::get('/permisos/{permission}', [PermissionController::class, 'show'])->middleware('permission:ver permisos');
//     // Route::put('/permisos/{permission}', [PermissionController::class, 'update'])->middleware('permission:editar permisos');
//     // Route::delete('/permisos/{permission}', [PermissionController::class, 'destroy'])->middleware('permission:eliminar permisos');

// }); -->
