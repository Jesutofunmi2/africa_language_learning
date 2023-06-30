<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view ('pages.permission.create-permission');
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

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
    //
}
