<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() {
        return Role::all();
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:roles']);
        return Role::create(['name' => $request->name]);
    }

    public function show(Role $role) {
        return $role;
    }

    public function update(Request $request, Role $role) {
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id]);
        $role->update(['name' => $request->name]);
        return $role;
    }

    public function destroy(Role $role) {
        $role->delete();
        return response()->json(['message' => 'Rol eliminado']);
    }
}
