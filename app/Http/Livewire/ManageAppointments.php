<?php

namespace App\Http\Livewire;

use App\Enums\UserRolesEnum;
use App\Models\Appointment;
use Carbon\Carbon;
use Livewire\Component;

class ManageAppointments extends Component
{

    private $appointments;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public $appointment;

    public $confirmingAppointmentAdd;

    public $confirmAppointmentCancellation  = false;
    public $confirmingAppointmentCancellation = false;

    private $timeNow;

    protected $rules = [
//        "appointment.name" => "required|string|max:255",

    ];

    public function mount()
    {
        $this->timeNow = Carbon::now();
    }

    public function render()
    {
        $this->appointments = Appointment::when($this->search, function ($query) {
            $query
                ->where('date', 'like', '%' . $this->search . '%')
                ->orWhere('appointment_code', 'like', '%' . $this->search . '%')
                ->orWhere('start_time', 'like', '%' . $this->search . '%')
                ->orWhere('end_time', 'like', '%' . $this->search . '%')
                ->orWhere('status', 'like', '%' . $this->search . '%')
                ->orWhere('user_id', 'like', '%' . $this->search . '%')
                ->orWhere('service_id', 'like', '%' . $this->search . '%')
                ->orWhere('time_slot_id', 'like', '%' . $this->search . '%')
                ->orWhere('location_id', 'like', '%' . $this->search . '%')            ;

        })
            ->with('timeSlot', 'user', 'service', 'location')
            ->whereDate('date', '>=', Carbon::today())
            ->orWhereHas('user', function ($userQuery) {
                $userQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('phone_number', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('service', function ($userQuery) {
                $userQuery->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('category_id', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('location', function ($userQuery) {
                $userQuery->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('address', 'like', '%' . $this->search . '%')
                    ->orWhere('telephone_number', 'like', '%' . $this->search . '%');
            })
            ->where('status' , '==', 1)
            ->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10);

        return view('livewire.manage-appointments', [
            'appointments' => $this->appointments,
        ]);
    }



//    public function confirmAppointmentEdit(Appointment $appointment) {
//        $this->appointment = $appointment;
//        $this->confirmingAppointmentAdd= true;
//    }
    public function confirmAppointmentCancellation() {
        $this->confirmingAppointmentCancellation = true;
    }

//    public function saveAppointment() {
//        $this->validate();
//
//        if (isset($this->appointment->id)) {
//            $this->appointment->save();
//        } else {
//            Appointment::create(
//                [
//                    'name' => $this->appointment['name'],
//                ]
//            );
//        }
//
//        $this->confirmingAppointmentAdd = false;
//        $this->appointment = null;
//    }

    public function cancelAppointment(Appointment $appointmentId) {
        if (auth()->user()->id == $this->appointment->user_id ||
            auth()->user()->role()->name ==
            (UserRolesEnum::Employee->value || UserRolesEnum::Admin->value))

        $this->appointment = $appointmentId;
        $this->appointment->status = 0;
//        $this->appointment->cancelled_by = auth()->user()->id;
        // TODO add reason
        $this->appointment->save();
        $this->confirmingAppointmentCancellation = false;
    }

//    public function confirmAppointmentAdd() {
//        $this->confirmingAppointmentAdd = true;
//    }

}
