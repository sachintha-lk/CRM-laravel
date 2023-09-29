<div {{ $attributes->class(['m-3']) }}>

    <h2 class="font-medium text-gray-600 text-lg mb-2">{{ $date->toDateString() }}</h2>
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 overflow-x-scroll min-w-screen">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="pl-6 py-4 font-medium text-gray-900 border p-2">Time Slot</th>
            <th scope="col" class="px-4 py-4 font-medium text-gray-900 border p-2">Service</th>
            <th scope="col" class="px-4 py-4 font-medium text-gray-900 border p-2">Customer</th>
            <th scope="col" class="px-4 py-4 font-medium text-gray-900 border p-2">Email</th>
            <th scope="col" class="px-4 py-4 font-medium text-gray-900 border p-2">Phone Number</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
        @foreach ($timeSlots as $timeSlotId => $slot)
            @php
                $appointment = $daySchedule->where('time_slot_id', $timeSlotId)->first();
            @endphp
            <tr

                    @if($appointment)
                        class = "bg-pink-50 hover:bg-pink-100"
                    @else
                        class="hover:bg-gray-50"
                    @endif
            >
                <td class="px-1 py-1 max-w-0 border">
                    {{ date('g:i a', strtotime($slot->start_time)) . ' - ' . date('g:i a', strtotime($slot->end_time)) }}
                </td>
                <td class="max-w-xs font-medium text-gray-700 border p-2">
                    @if ($appointment)
                        <a href="{{ route('manageappointments')}}?search={{ $appointment->appointment_code }}">{{ $appointment->service->name }}</a>
                    @endif
                </td>
                <td class="border p-2">
                    @if ($appointment)
                        {{ $appointment->user->name }}
                    @endif
                </td>
                <td class="border p-2">
                    @if ($appointment)
                        <a href="mailto:{{ $appointment->user->email }}">{{ $appointment->user->email }}</a>
                    @endif
                </td>
                <td class="border p-2">
                    @if ($appointment)
                        <a href="tel:{{ $appointment->user->phone_number }}">{{ $appointment->user->phone_number }}</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
