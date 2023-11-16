<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        return view('pages.permission.create-permission');
    }


    public function create(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Permission::create($validated);

        return redirect()->route('admin.permission.list')->with('message', 'Permission Created successfully.');
    }

    public function list()
    {
        $permissions = Permission::all();

        return view('pages.permission.list-permission', ['permissions' => $permissions]);
    }

    public function show($permissionId)
    {
        $permissions = Permission::whereId($permissionId)->first();
        $roles = Role::all();

        return view('pages.permission.edit-permission', ['roles' => $roles, 'permissions' => $permissions]);
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate(['name' => 'required']);
        $permission->update($validated);

        return redirect()->route('admin.permissions.index')->with('message', 'Permission updated.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('message', 'Permission deleted.');
    }

    public function assignRole(Request $request, Permission $permission)
    {
        if ($permission->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }

        $permission->assignRole($request->role);
        return back()->with('message', 'Role assigned.');
    }

    public function removeRole(Permission $permission, Role $role)
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('message', 'Role not exists.');
    }
    //
}
