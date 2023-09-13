<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('pages.role.create-role');
    }


    public function create(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Role::create($validated);

        return redirect()->route('admin.role.list')->with('message', 'Role Created successfully.');
    }

    public function list()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();

        return view('pages.role.list-role', ['roles' => $roles]);
    }

    public function show($roleId)
    {
        $role = Role::whereId($roleId)->first();
        $permissions = Permission::all();

        return view('pages.role.edit-role', ['role' => $role, 'permissions' => $permissions]);
    }

    public function update(Request $request, $roleId)
    {

        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $role = Role::where('id', $roleId)->first();
        $role->update($validated);
        return redirect()->route('admin.role.list')
            ->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('success', 'Role deleted.');
    }

    public function givePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission exists.');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission not exists.');
    }
}
