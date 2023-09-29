<?php

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
use App\Models\Appointment;
use App\Models\Deal;
use App\Models\Location;
use App\Models\Service;
use App\Models\TimeSlot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardHomeController extends Controller
{
    public function index()
    {

        $todayDate = Carbon::today()->toDateString();

        $totalCustomers = User::where('role_id', UserRolesEnum::Customer)->count();
        $totalEmployees = User::where('role_id', UserRolesEnum::Employee)->count();

        $totalServicesActive = Service::where('is_hidden', 0)->count();
        $totalServices = Service::count();

        $totalUpcomingDeals = Deal::where('start_date', '<', $todayDate)->count();
        $totalOngoingDeals = Deal::where('start_date', '<=', $todayDate)->where('end_date', '>=', $todayDate)->count();

        // dd($totalCustomers, $totalEmployees, $totalServicesActive, $totalServices, $totalUpcommingDeals, $totalOngoingDeals);

        $totalUpcomingAppointments = Appointment::where('date', '>', $todayDate)->count();
        $todaysAppointments = Appointment::where('date', $todayDate)->count();
        $tommorowsAppointments = Appointment::where('date', Carbon::today()->addDay()->toDateTime())->count();

        $bookingRevenueThisMonth = Appointment::where('created_at', '>', Carbon::today()->subMonth()->toDateTime())->where('status', '!=', 0)->sum('total');
        $bookingRevenueLastMonth = Appointment::where('created_at', '>', Carbon::today()->subMonths(2)->toDateTime())->where('created_at', '<', Carbon::today()->subMonth()->toDateTime())->where('status', '!=', 0)->sum('total');

        $percentageRevenueChangeLastMonth = 0;
        if ($bookingRevenueLastMonth != 0) {
            $percentageRevenueChangeLastMonth = ($bookingRevenueThisMonth - $bookingRevenueLastMonth) / $bookingRevenueLastMonth * 100;
        } else {
            $percentageRevenueChangeLastMonth = 100;
        }


        $todaysSchedule = Appointment::orderBy('start_time', 'asc')
                ->where('date', $todayDate)
                ->where('status', '!=', 0)
                ->orderBy('time_slot_id', 'asc')
                ->where('status', '!=', 0)
                ->with('service', 'timeSlot', 'user')
                ->get();

        $tommorowsSchedule = Appointment::orderBy('start_time', 'asc')
                ->where('date', Carbon::today()->addDay()->toDateTime())
                ->where('status', '!=', 0)
                ->orderBy('time_slot_id', 'asc')
                ->where('status', '!=', 0)
                ->with('service', 'timeSlot', 'user')
                ->get();

        $timeSlots = TimeSlot::all();

        $locations = Location::all();





        return view('dashboard.admin-employee', [
            'totalCustomers' => $totalCustomers,
            'totalEmployees' => $totalEmployees,
            'totalServicesActive' => $totalServicesActive,
            'totalServices' => $totalServices,
            'totalUpcomingDeals' => $totalUpcomingDeals,
            'totalOngoingDeals' => $totalOngoingDeals,
            'totalUpcomingAppointments' => $totalUpcomingAppointments,
            'todaysAppointments' => $todaysAppointments,
            'tommorowsAppointments' => $tommorowsAppointments,
            'bookingRevenueThisMonth' => $bookingRevenueThisMonth,

//            'bookingRevenueLastMonth' => $bookingRevenueLastMonth,
            'percentageRevenueChangeLastMonth' => $percentageRevenueChangeLastMonth,



            'todaysSchedule' => $todaysSchedule,
            'tomorrowsSchedule' => $tommorowsSchedule,
            'timeSlots' => $timeSlots,
            'locations' => $locations,

        ]);
    }
}
