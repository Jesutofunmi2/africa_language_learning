<?php
 
namespace App\Http\Controllers\Admin;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminRegisterController extends Controller
{


    public function __construct(protected UserService $userService)
    {
        $this->middleware('guest');
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
        return view('auth.register');
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
    public function register(RegisterUserRequest $request): RedirectResponse
    {
  
        $user = $this->userService->createAdnin($request->validated());
        auth()->login($user);

        return redirect()->route('admin.dashboard');
    }
}