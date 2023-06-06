<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceDisplay extends Controller
{
    // show all services page
    public function index()
    {
        $services = Service::all();
        // dd($services);
        return view('web.services', compact('services'));
        
    }
}
