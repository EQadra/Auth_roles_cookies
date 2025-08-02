<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function assignRole(Request $request, User $user) {
        $request->validate(['role' => 'required|exists:roles,name']);
        $user->assignRole($request->role);
        return response()->json(['message' => 'Rol asignado']);
    }

    public function removeRole(Request $request, User $user) {
        $request->validate(['role' => 'required|exists:roles,name']);
        $user->removeRole($request->role);
        return response()->json(['message' => 'Rol removido']);
    }

    public function roles(User $user) {
        return $user->getRoleNames();
    }
}
