<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function assignPermission(Request $request, Role $role) {
        $request->validate(['permission' => 'required|exists:permissions,name']);
        $role->givePermissionTo($request->permission);
        return response()->json(['message' => 'Permiso asignado']);
    }

    public function revokePermission(Request $request, Role $role) {
        $request->validate(['permission' => 'required|exists:permissions,name']);
        $role->revokePermissionTo($request->permission);
        return response()->json(['message' => 'Permiso revocado']);
    }

    public function permissions(Role $role) {
        return $role->permissions;
    }
}
