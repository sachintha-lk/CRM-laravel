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

    public function show($id)
    {
        $service = Service::where('id', $id)->firstOrFail();
        return response()->json($service, 200);
    }

    public function store()
    {
        // valildaion
        request()->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
//            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'notes' => 'nullable|string|max:255',
            'allergens' => 'nullable|string|max:255',
            'benefits' => 'nullable|string|max:255',
            'aftercare_tips' => 'nullable|string|max:255',
            'cautions' => 'nullable|string|max:255',
            'category_id' => 'required|numeric|exists:categories,id',
            'is_hidden' => 'nullable|boolean',
        ]);

        // json to send to create this
        // {
        //     "name": "Service 1",
        //     "description": "Service 1 description",
        //     "price": 100,
        //     "notes": "Service 1 notes",
        //     "allergens": "Service 1 allergens",
        //     "benefits": "Service 1 benefits",
        //     "aftercare_tips": "Service 1 aftercare tips",
        //     "cautions": "Service 1 cautions",
        //     "category_id": 1,
        //     "is_hidden": false
        // }


        // slug
        $slug = \Str::slug( request('name'));
        $slugCount = Service::where('slug', 'like', $slug.'%')->count();
        if ($slugCount > 0) {
            $slug = $slug.'-'.($slugCount + 1);
        }


        $service = Service::create([
            'name' => request('name'),
            'slug' => $slug,
            'description' => request('description'),
//            'image' => request('image'),  // image null
            'price' => request('price'),
            'notes' => request('notes'),
            'allergens' => request('allergens'),
            'benefits' => request('benefits'),
            'aftercare_tips' => request('aftercare_tips'),
            'cautions' => request('cautions'),
            'category_id' => request('category_id'),
            'is_hidden' => request('is_hidden'),
        ]);

        return response()->json($service, 201);
    }

    public function update($id)
    {

        $service = Service::where('id', $id)->firstOrFail();

        // validate

        $service->update([
            'name' => request('name'),
            'description' => request('description'),
            'image' => request('image'),
            'price' => request('price'),
            'notes' => request('notes'),
            'allergens' => request('allergens'),
            'benefits' => request('benefits'),
            'aftercare_tips' => request('aftercare_tips'),
            'cautions' => request('cautions'),
            'category_id' => request('category_id'),
            'is_hidden' => request('is_hidden'),
        ]);

        return response()->json($service, 200);
    }

    public function destroy($id)
    {
        $service = Service::where('id', $id)->first();
        if (!$service) {
            return response()->json("'message': 'Service not found'", 404);
        }
        $service->delete();
        return response()->json("message': 'Service deleted successfully'", 200);
    }

}
