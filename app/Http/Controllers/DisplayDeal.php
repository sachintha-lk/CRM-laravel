<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deal;

class DisplayDeal extends Controller
{
    function index() {
        $deals = Deal::all();
        return view('web.deals', compact('deals'));
    }
}
