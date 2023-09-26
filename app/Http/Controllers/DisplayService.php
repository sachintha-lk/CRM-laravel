<?php

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
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



        if( !auth()->check()  || auth()->user()->role->id ==  UserRolesEnum::Customer->value ) {
            if ($service->is_hidden) {
                abort(404);
            }

            // make a new hit using a job
            resolve('AnalyticsSingleton')->makeHit(
                class_basename($service),
                $service->id,
                'view',
                auth()->id()
            );
        }




        // make a new hit using a job

        return view('web.view-service', compact('service'));
    }
}
