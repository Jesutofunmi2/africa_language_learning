<?php
 
namespace App\Http\Controllers\Admin;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Admin;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRegisterController extends Controller
{


    public function __construct(protected UserService $userService)
    {
        $this->middleware('auth');
    }

   /**
     * Admin Register Page.
     * 
     * This method return a view for admin register.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     * 
     */
    public function index(Request $request): View
    {
        // return view('auth.register');
        return view('pages.admin.create-admin');
    }

     /**
     * Admin Login Method.
     * 
     * This method handles an admin authentication attempt.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function register(CreateAdminRequest $request): RedirectResponse
    {
       
        $user = $this->userService->createAdmin($request->validated());
    
       // auth()->login($user);

        return redirect()->route('admin.users.list')->with('success', 'Admin user created');
    }

    public function list()
    {
        $users = Admin::orderBy('created_at', 'desc')->paginate(15);
        return view('pages.admin.list-admin')->with('users', $users);
    }

    public function show($userId)
    {
        $user = Admin::whereId($userId)->first();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('pages.admin.edit-admin', compact('user', 'roles', 'permissions'));
    }

    public function update()
    {

    }

    public function destroy($id)
    {
         $this->userService->deleteAdmin($id);

         return redirect()->route('admin.users.list')
             ->with('success', 'deleted successfully');
    }

    public function assignRole(Request $request, Admin $user)
    {
        if ($user->hasRole($request->role)) {
            return back()->with('message', 'Role exists.');
        }

        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned.');
    }

    public function removeRole(Admin $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('message', 'Role not exists.');
    }

    public function givePermission(Request $request, Admin $user)
    {
        if ($user->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission exists.');
        }
        $user->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(Admin $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission does not exists.');
    }

}