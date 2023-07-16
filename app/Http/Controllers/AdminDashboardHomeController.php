<?php

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
use App\Models\Deal;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardHomeController extends Controller
{
    public function index()
    {

        $todayDate = Carbon::now()->toDateTime();

        $totalCustomers = User::where('role_id', UserRolesEnum::Customer)->count();
        $totalEmployees = User::where('role_id', UserRolesEnum::Employee)->count();

        $totalServicesActive = Service::where('is_hidden', 0)->count();
        $totalServices = Service::count();

        $totalUpcommingDeals = Deal::where('start_date', '<', $todayDate)->count();
        $totalOngoingDeals = Deal::where('start_date', '<=', $todayDate)->where('end_date', '>=', $todayDate)->count();

        // dd($totalCustomers, $totalEmployees, $totalServicesActive, $totalServices, $totalUpcommingDeals, $totalOngoingDeals);



        return view('dashboard.admin-employee', [
            'totalCustomers' => $totalCustomers,
            'totalEmployees' => $totalEmployees,
            'totalServicesActive' => $totalServicesActive,
            'totalServices' => $totalServices,
            'totalUpcommingDeals' => $totalUpcommingDeals,
            'totalOngoingDeals' => $totalOngoingDeals,
        ]);
    }
}
