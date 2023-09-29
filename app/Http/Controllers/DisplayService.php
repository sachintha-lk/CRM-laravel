<?php

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
use App\Jobs\AnalyticsJob;
use App\Models\Appointment;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use App\Models\Service;

class DisplayService extends Controller
{
    // show all services page
    public function index()
    {
        $services = Service::orderByPrice('PriceLowToHigh')->where('is_hidden', false)->paginate(10);

        return view('web.services', compact('services'));
    }

    // show single service page
    public function show($slug)
    {

        $serviceQuery = Service::where('slug', $slug);

        if (!auth()->check() || auth()->user()->role->id == UserRolesEnum::Customer->value)  {
            // If the user is not logged in or is a customer
            $serviceQuery->where('is_hidden', false);
        }

        $service = $serviceQuery->with('category')->firstOrFail();

        $views = null;
        $appointmentsTotal = null;
        $timeSlotsStats = null;
        $timeSlotsStatsLastWeek = null;
        $viewsLastWeek = null;
        $viewsLastMonth = null;
        $percentageViewsChangeLastWeek = null;
        $totalRevenue = null;
        $totalRevenueLastWeek = null;
        $totalRevenueLastMonth = null;
        $percentageRevenueChangeLastWeek = null;
        $appointmentsLastWeek = null;
        $appointmentsLastMonth = null;
        $percentageAppointmentsChangeLastWeek = null;
        $percentageAppointmentsChangeLastMonth = null;
        $percentageRevenueChangeLastMonth = null;




        if( !auth()->check()  || auth()->user()->role->id ==  UserRolesEnum::Customer->value ) {
            if ($service->is_hidden) {
                abort(404);
            }

            // make a new hit using a job
            AnalyticsJob::dispatch(
                class_basename($service),
                $service->id,
                'view',
            );

        } else {
            // get the views for this service
            $views = $service->hits()->where('analytic_data_type', 'view')->count();

            // views last week for this service
            $viewsLastWeek = $service->hits()->where('analytic_data_type', 'view')->whereBetween('created_at', [now()->subWeek(), now()])->count();

            // views the week before last week for this service
            $viewsTheWeekBeforeLastWeek = $service->hits()->where('analytic_data_type', 'view')->whereBetween('created_at', [now()->subWeeks(2), now()->subWeeks(1)])->count();


            if ($viewsTheWeekBeforeLastWeek != 0) {
                $percentageViewsChangeLastWeek = (($viewsLastWeek - $viewsTheWeekBeforeLastWeek) / $viewsTheWeekBeforeLastWeek) * 100;
            } else {
                $percentageViewsChangeLastWeek = "N/A"; // Set to "N/A" if division by zero
            }

            $totalRevenue = $service->appointments()->sum('total');
            // total revenue last week for this service
            $totalRevenueLastWeek = $service->appointments()->whereBetween('created_at', [now()->subWeek(), now()])->sum('total');

            // total revenue in the week before last week for this service
            $totalRevenueTheWeekBeforeLastWeek = $service->appointments()->whereBetween('created_at', [now()->subWeeks(2), now()->subWeeks(1)])->sum('total');

            if ($totalRevenueTheWeekBeforeLastWeek != 0) {
                $percentageRevenueChangeLastWeek = (($totalRevenueLastWeek - $totalRevenueTheWeekBeforeLastWeek) / $totalRevenueTheWeekBeforeLastWeek) * 100;
            } else {
                $percentageRevenueChangeLastWeek = "N/A"; // Set to "N/A" if division by zero
            }

            // total revenue last month for this service
            $totalRevenueLastMonth = $service->appointments()->whereBetween('created_at', [now()->subMonth(), now()])->sum('total');

            // total revenue in the month before last month for this service
            $totalRevenueTheMonthBeforeLastMonth = $service->appointments()->whereBetween('created_at', [now()->subMonths(2), now()->subMonths(1)])->sum('total');

            // percentage change in revenue from last month
            if ($totalRevenueTheMonthBeforeLastMonth != 0) {
                $percentageRevenueChangeLastMonth = (($totalRevenueLastMonth - $totalRevenueTheMonthBeforeLastMonth) / $totalRevenueTheMonthBeforeLastMonth) * 100;
            } else {
                $percentageRevenueChangeLastMonth = "N/A"; // Set to "N/A" if division by zero
            }

            // get the appointments for this service
            $appointmentsTotal = $service->appointments()->count();

            // appointments last week for this service
            $appointmentsLastWeek = $service->appointments()->whereBetween('created_at', [now()->subWeek(), now()])->count();

            // appointments the week before last week for this service
            $appointmentsTheWeekBeforeLastWeek = $service->appointments()->whereBetween('created_at', [now()->subWeeks(2), now()->subWeeks(1)])->count();

            // percentage change in appointments from last week
            if ($appointmentsTheWeekBeforeLastWeek != 0) {
                $percentageAppointmentsChangeLastWeek = (($appointmentsLastWeek - $appointmentsTheWeekBeforeLastWeek) / $appointmentsTheWeekBeforeLastWeek) * 100;
            } else {
                $percentageAppointmentsChangeLastWeek = "N/A"; // Set to "N/A" if division by zero
            }

            // appointments last month for this service
            $appointmentsLastMonth = $service->appointments()->whereBetween('created_at', [now()->subMonth(), now()])->count();

            // appointments the month before last month for this service
            $appointmentsTheMonthBeforeLastMonth = $service->appointments()->whereBetween('created_at', [now()->subMonths(2), now()->subMonths(1)])->count();

            // percentage change in appointments from last month
            if ($appointmentsTheMonthBeforeLastMonth != 0) {
                $percentageAppointmentsChangeLastMonth = (($appointmentsLastMonth - $appointmentsTheMonthBeforeLastMonth) / $appointmentsTheMonthBeforeLastMonth) * 100;
            } else {
                $percentageAppointmentsChangeLastMonth = "N/A"; // Set to "N/A" if division by zero
            }

            // get the most popular time slots for this service
            $timeSlotsStats = $service->appointments()->get()->groupBy('time_slot_id')->map(function ($item, $key) {
                return [
                    'time_slot_id' => $key,
                    'count' => $item->count(),
                ];
            })->sortByDesc('count')->take(5)->map(function ($item, $key) {
                return [
                    'time_slot' => TimeSlot::find($item['time_slot_id']),
                    'count' => $item['count'],
                ];
            });

            // get the most popular time slots for this service last week
            $timeSlotsStatsLastWeek = $service->appointments()->whereBetween('created_at', [now()->subWeek(), now()])->get()->groupBy('time_slot_id')->map(function ($item, $key) {
                return [
                    'time_slot_id' => $key,
                    'count' => $item->count(),
                ];
            })->sortByDesc('count')->take(5)->map(function ($item, $key) {
                return [
                    'time_slot' => TimeSlot::find($item['time_slot_id']),
                    'count' => $item['count'],
                ];
            });



        }

        return view('web.view-service', [
            'service' => $service,
            'views' => $views,
            'appointmentsTotal' => $appointmentsTotal,
            'timeSlotsStats' => $timeSlotsStats,
            'timeSlotsStatsLastWeek' => $timeSlotsStatsLastWeek,
            'viewsLastWeek' => $viewsLastWeek,
            'viewsLastMonth' => $viewsLastMonth,
            'percentageViewsChangeLastWeek' => $percentageViewsChangeLastWeek,
            'totalRevenue' => $totalRevenue,
            'totalRevenueLastWeek' => $totalRevenueLastWeek,
            'totalRevenueLastMonth' => $totalRevenueLastMonth,
            'percentageRevenueChangeLastWeek' => $percentageRevenueChangeLastWeek,
            'appointmentsLastWeek' => $appointmentsLastWeek,
            'appointmentsLastMonth' => $appointmentsLastMonth,
            'percentageAppointmentsChangeLastWeek' => $percentageAppointmentsChangeLastWeek,
            'percentageAppointmentsChangeLastMonth'=> $percentageAppointmentsChangeLastMonth,
            'percentageRevenueChangeLastMonth' => $percentageRevenueChangeLastMonth,
        ]);
    }
}
