<?php

namespace App\Http\Controllers\Admin;

use App\Services\TokenService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class AdminLogoutController extends Controller
{

    public function __construct(protected TokenService $service)
    {
    }

    /**
     * Logout method
     *
     * This method handles logging an admin out
     * of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('admin.login.get');
    }
}
