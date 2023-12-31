<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Location;
use App\Models\Service;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class AddingServiceToCart extends Component
{
    public $service;
    public $timeSlots;

    public $locations;

    public $selectedLocation;
    public $selectedTimeSlot;
    public $selectedDate;

    public function mount(Service $service)
    {
        $this->service = $service;
        $this->timeSlots = TimeSlot::all();
        $this->locations = Location::where('status', true)->get();
        $this->timeSlots->map(function ($timeSlot) {
            $timeSlot->available = true;
        });
    }
    public function render()
    {
        return view('livewire.adding-service-to-cart');
    }

    // when date is selected, get the time slots
    // if there are appointments with that slot in a day, add an attribute called available

    public function updatedSelectedLocation($selectedLocation)
    {
        $this->displayUnvailableTimeSlots();

    }

    public function updatedSelectedDate($selectedDate)
    {
        // get the unavailable time slots
        if ( $this->selectedLocation == null ) {
            $this->selectedLocation = $this->locations->first()->id;
        }

        $this->displayUnvailableTimeSlots();

    }

    private function displayUnvailableTimeSlots() {
        $unavailableTimeSlots = Appointment::get()
            ->where('date', $this->selectedDate)
            ->where('location_id', $this->selectedLocation)
            ->pluck('time_slot_id')->toArray();

        // check the cart of the user
        $cart = auth()->user()?->cart?->where('is_paid', false)->first();

        // if the selectedDate is today's date, then the time slots before the current time should be unavailable
        $now = Carbon::now();
        if ($now->toDateString() == $this->selectedDate) {
            $slotsBeforeCurrentTime = TimeSlot::where('start_time', '<', $now->toTimeString())
                ->pluck('id')->toArray();

//            Log::info("slots before current time", $slotsBeforeCurrentTime);
//            Log::info("unavailable time slots", $unavailableTimeSlots);

            $unavailableTimeSlots = array_merge($unavailableTimeSlots, $slotsBeforeCurrentTime);
//            Log::info("unavailable time slots after merge", $unavailableTimeSlots);
        }
        // if the user has a cart, check the cart items
        if ( $cart ) {
            $inCartSameTimeDate =  $cart->services()
                ->where('date', $this->selectedDate)
                ->pluck('time_slot_id')->toArray();
            $unavailableTimeSlots = array_merge($unavailableTimeSlots, $inCartSameTimeDate);

        }
//        Log::info("Final unavailable time slots :", $unavailableTimeSlots);


//        check the time slots that are not in the

        foreach ( $this->timeSlots as $timeSlot ) {
            if ( !in_array($timeSlot->id, $unavailableTimeSlots) ) {
                $timeSlot->available = true;
            } else {
                $timeSlot->available = false;
            }

            if ($this->selectedTimeSlot != null) {
                if ( in_array($this->selectedTimeSlot, $unavailableTimeSlots) ) {
                    $this->selectedTimeSlot = null;
                }
            }
        }
    }

    // add the service to the cart
    public function addToCart()
    {
        if($this->service->is_hidden) {
            return redirect()->back();
        }
//         check if the user is logged in
        if ( !auth()->check() ) {
            return redirect()->route('login');
        }
       // check if the user has a cart
        $cart = auth()->user()->cart?->where('is_paid', false)->first();

        // if the user does not have a cart, create one
        if ( !$cart ) {
            $cart = auth()->user()->cart()->create();
        }

        // check if the user has a cart item with the same time in the cart
        $cartItem = $cart->services()
            ->where('date', $this->selectedDate)
            ->where('time_slot_id', $this->selectedTimeSlot)
            ->where('location_id', $this->selectedLocation)
            ->first();

        // if the user has a cart item with the same time return an error
        if ( $cartItem ) {
            session()->flash('error', 'You already have a service in your cart with the same time');
            return redirect()->route('cart');
        }

        // if the user does not have a cart item with the same time
        // check if there are any appointments with the same time at the location
        $appointment = Appointment::where('date', $this->selectedDate)
            ->where('time_slot_id', $this->selectedTimeSlot)
            ->where('location_id', $this->selectedLocation)
            ->first();

        // if there is an appointment with the same time return an error
        if ( $appointment ) {
            session()->flash('error', 'There is an appointment with the same time');
            return redirect()->route('cart');
        }

        // if there is no appointment with the same time
        // add the service to the cart
        $timeSlot = TimeSlot::find($this->selectedTimeSlot);
        $cart->services()->attach($this->service->id, [
            'time_slot_id' => $this->selectedTimeSlot,
            'date' => $this->selectedDate,
            'start_time' => $timeSlot->start_time,
            'end_time' => $timeSlot->end_time,
            'location_id' => $this->selectedLocation,
            'price' => $this->service->price,
        ]);

        // total
        $cart->total = $cart->services()->sum(DB::raw('cart_service.price'));
        $cart->save();

        return redirect()->route('cart');

    }

}
