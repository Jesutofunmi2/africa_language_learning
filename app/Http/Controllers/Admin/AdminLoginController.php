<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminLoginController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Admin Login Page.
     * 
     * This method return a view for admin login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        return view('auth.login');
    }

    /**
     * Admin Login Method.
     * 
     * This method handles an admin authentication attempt.
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse;
     * 
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();


        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }


        return redirect()->route('admin.dashboard');
    }
}
