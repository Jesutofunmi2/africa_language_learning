<?php
 
namespace App\Http\Controllers\Admin;

use App\Enums\ActivityType;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

   /**
     * Admin Dashboard Page.
     * 
     * This method return a view for admin dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     * 
     */
    public function index(Request $request): View
    {
        $users = Admin::where('is_admin', true)->get();
        $types = Activity::TYPES;

        return view('pages.dashboard', ['users' => $users, 'types' => $types]);
    }
}