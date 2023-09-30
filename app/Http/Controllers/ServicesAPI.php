<?php

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
use App\Models\Service;
use Illuminate\Cache\RateLimiting\Limit;

class ServicesAPI extends Controller
{
    public function index()
    {
        $rateLimit = Limit::perMinute(10)->by(optional(auth()->user())->id ?: request()->ip());



        $queryHiddenData = false;
        if (auth()->check() &&
            (auth()->user()->role->id == UserRolesEnum::Employee->value
                || auth()->user()->role->id == UserRolesEnum::Admin->value)) {
            // No rate limit for Employee or Admin
            $rateLimit = Limit::none();
            $queryHiddenData = true;
        }

        $services = cache()->remember('services', 100, function () use ($queryHiddenData) {
            if ($queryHiddenData) {
                return Service::orderByPrice('PriceLowToHigh')->paginate(10);
            } else {
                return Service::orderByPrice('PriceLowToHigh')->where('is_hidden', false)->paginate(10);
            }
        });

        return response()->json($services, 200);

    }
}
