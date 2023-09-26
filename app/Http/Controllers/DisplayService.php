<?php

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
use App\Jobs\AnalyticsJob;
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

        $service = Service::where('slug', $slug)->with('category')->firstOrFail();

        $views = null;

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


        }


        return view('web.view-service', compact('service'), compact('views'));
    }
}
