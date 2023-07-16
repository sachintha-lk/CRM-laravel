<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminDashboardHomeController;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {
            $adminDashboardHomeController = new AdminDashboardHomeController();
            return $adminDashboardHomeController->index();
        } else if (auth()->user()->role_id == 3) {
            return view('dashboard.customer');
        }
    }
}
