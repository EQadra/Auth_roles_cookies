<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /** Listar todos los usuarios (+ roles y permisos) */
    public function index()
    {
        return response()->json(
            User::with(['roles','permissions'])->get()
        );
    }

    /** Crear usuario + (roles|permisos) opcionales */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6',
            'roles'       => 'array',
            'roles.*'     => 'string|exists:roles,name',
            'permissions' => 'array',
            'permissions.*'=> 'string|exists:permissions,name',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Asignar roles / permisos, si vienen
        if (!empty($validated['roles'])) {
            $user->assignRole($validated['roles']);          // multiple
        }
        if (!empty($validated['permissions'])) {
            $user->givePermissionTo($validated['permissions']);
        }

        return response()->json(
            $user->load(['roles','permissions']),
            201
        );
    }

    /** Mostrar usuario por ID */
    public function show($id)
    {
        $user = User::with(['roles','permissions'])->find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        return response()->json($user);
    }

    /** Actualizar usuario + resync roles|permisos */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'email'       => ['sometimes','required','email', Rule::unique('users')->ignore($user->id)],
            'password'    => 'nullable|string|min:6',
            'roles'       => 'array',
            'roles.*'     => 'string|exists:roles,name',
            'permissions' => 'array',
            'permissions.*'=> 'string|exists:permissions,name',
        ]);

        if (isset($validated['name']))  $user->name  = $validated['name'];
        if (isset($validated['email'])) $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        // Sincronizar roles/permisos recibidos
        if (array_key_exists('roles', $validated)) {
            $user->syncRoles($validated['roles'] ?? []);
        }
        if (array_key_exists('permissions', $validated)) {
            $user->syncPermissions($validated['permissions'] ?? []);
        }

        return response()->json(
            $user->load(['roles','permissions'])
        );
    }

    /** Borrar usuario */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}
