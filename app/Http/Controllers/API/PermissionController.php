<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index() {
        return Permission::all();
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:permissions']);
        return Permission::create(['name' => $request->name]);
    }

    public function show(Permission $permission) {
        return $permission;
    }

    public function update(Request $request, Permission $permission) {
        $request->validate(['name' => 'required|unique:permissions,name,' . $permission->id]);
        $permission->update(['name' => $request->name]);
        return $permission;
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        return response()->json(['message' => 'Permiso eliminado']);
    }
}
