<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class DisplayService extends Controller
{
    // show all services page
    public function index()
    {
        $services = Service::orderByPrice('PriceLowToHigh')->paginate(10);

        return view('web.services', compact('services'));

    }
}
