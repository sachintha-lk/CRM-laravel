<?php

namespace App\Http\Controllers;

use App\Jobs\SendAppointmentConfirmationMailJob;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Ramsey\Collection\Collection;

class CartController extends Controller
{
    public function index()
    {
        // get the cart of the user that is not paid
        $cart = auth()->user()->cart()
            ->where('is_paid', false)

            ->first();
        return view('web.cart', compact('cart'));

    }

    public function removeItem($cart_service_id) {
        // Get the cart of the user that is not paid
        $cart = auth()->user()->cart()->where('is_paid', false)->first();

        // If the cart is not found, redirect back
        if (!$cart) {
            return redirect()->back();
        }

        // get the cart_service with id = cart service id Raw query
        $cart_service = DB::table('cart_service')->where('id', $cart_service_id)->where('cart_id', $cart->id)->get();

        // If the cart service is not found, redirect back
        if (!$cart_service) {
            return redirect()->back();
        }


        // Delete the cart service
        DB::table('cart_service')->where('id', $cart_service_id)->where('cart_id', $cart->id)->delete();

        // Update the total
        $cart->total = $cart->services()->sum('cart_service.price');
        $cart->save();

        return redirect()->back();
    }

    public function checkout() {
        // Get the cart of the user that is not paid
        $cart = auth()->user()->cart()->where('is_paid', false)->first();

        // If the cart is not found, redirect back
        if (!$cart) {
            return redirect()->back();
        }

        $is_time_slots_available = true;

        // a data structure to hold the date and the unavailable time slots
        $unavailable_time_slots = new Collection(
           'array'
        );

        // check if the time slot is available
        $cart->services->map(function ($service) use ($unavailable_time_slots, $cart, &$is_time_slots_available) {

            $is_available = DB::table('appointments')
                ->where('date', $service->pivot->date)
                ->where('time_slot_id', $service->pivot->time_slot_id)
                ->where('location_id', $service->pivot->location_id)
                ->doesntExist();

            // if the time slot is not available, redirect back
            if (!$is_available) {
                $is_time_slots_available = false;
//                dd($service->pivot->date, $service->pivot->time_slot_id);
                // get the start and end time of the time slot into variables
                $start_time = DB::table('time_slots')->where('id', $service->pivot->time_slot_id)->value('start_time');
                $end_time = DB::table('time_slots')->where('id', $service->pivot->time_slot_id)->value('end_time');

                // service name
                $service_name = $service->name;

                $unavailable_time_slots->add(
                  [
                        'service_name' => $service_name,
                        'date' => $service->pivot->date,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'location' => $service->pivot->location->name,
                  ]
                );
            }
        });

        // if the time slot is not available, redirect back
        if (!$is_time_slots_available) {
            // return with a session message

            return redirect()->back()->with('unavailable_time_slots', $unavailable_time_slots);
        }


        $cart->services->map(function ($service) use ($cart) {

            $is_available = DB::table('appointments')
                ->where('date', $service->pivot->date)
                ->where('time_slot_id', $service->pivot->time_slot_id)
                ->where('location_id', $service->pivot->location_id)
                ->doesntExist();

            // if the time slot is not available, redirect back
            if (!$is_available) {
                return redirect()->back();
            }

           Appointment::create([
                'cart_id' => $cart->id,
                'user_id' => $cart->user_id,
                'service_id' => $service->id,
                'time_slot_id' => $service->pivot->time_slot_id,
                'date' => $service->pivot->date,
                'start_time' => $service->pivot->start_time,
                'end_time' => $service->pivot->end_time,
                'location_id' => $service->pivot->location_id,
                'total' => $service->pivot->price,
           ]);
        });

        $cart->is_paid = true;
        $cart->save();

        // get the appointments of the cart
        $appointments = Appointment::where('cart_id', $cart->id)->get();
        $customer = auth()->user();
        foreach ($appointments as $appointment) {
            SendAppointmentConfirmationMailJob::dispatch( $customer , $appointment);
        }

        return redirect()->route('dashboard')->with('success', 'Your appointment has been booked successfully');

    }


}
