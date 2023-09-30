<x-app-layout>

    {{--<div class="flex w-full transform text-left text-base transition md:my-8 md:max-w-2xl md:px-4 lg:max-w-4xl">--}}
    <div class="md:w-9/12 w-full mx-auto">
        <div
            class="relative flex w-full items-center overflow-hidden bg-white px-4 pb-8 pt-14 shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8">
            {{--        <button type="button" class="absolute right-4 top-4 text-gray-400 hover:text-gray-500 sm:right-6 sm:top-8 md:right-6 md:top-6 lg:right-8 lg:top-8">--}}
            {{--            <span class="sr-only">Close</span>--}}
            {{--            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">--}}
            {{--                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />--}}
            {{--            </svg>--}}
            {{--        </button>--}}

            <div class="grid w-full grid-cols-1 items-start gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8">
                <div class="aspect-h-3 aspect-w-2 overflow-hidden rounded-lg bg-gray-100 sm:col-span-4 lg:col-span-5">
                    <img src="{{ asset('storage/'. $service->image) }}" alt="{{$service->name . ' image'}}"
                         class="object-cover object-center">
                </div>

                <div class="sm:col-span-8 lg:col-span-7">
                    <h2 class="text-2xl font-bold text-gray-900 sm:pr-12">{{$service->name}}</h2>
                    <span class="text-gray-600"> Category : {{ $service->category->name }}</span>

                    {{--                <span class="ml-4 text-gray-500">--}}
                    {{--                    Duration:--}}
                    {{--                    @if ($service->duration_minutes >= 60)--}}
                    {{--                        {{ floor($service->duration_minutes / 60) }} hr--}}
                    {{--                    @endif--}}
                    {{--                    @if ($service->duration_minutes % 60 > 0)--}}
                    {{--                        {{ $service->duration_minutes % 60 }} mins--}}
                    {{--                    @endif--}}
                    {{--                    </span>--}}

                    <section aria-labelledby="information-heading" class="mt-2">
                        <h3 id="information-heading" class="sr-only">Product information</h3>

                        <p class="text-2xl text-gray-900">LKR {{ number_format($service->price, 2, '.', ',') }}
                        </p>


                            @if (Auth::user()?->role_id == 1 || Auth::user()?->role_id == 2)

                            <a href="{{ route('manageservices') }}?search={{ $service->slug }}">
                                <x-button class="px-5 py-2 text-white bg-pink-500 rounded-md hover:bg--600">
                                    Manage
                                </x-button>
                            </a>

                                <div class="bg-gray-100 px-3 py-2 my-2 ">
                                    <span class="font-semibold"> Analytics insights </span>

{{--                                    'appointmentsTotal' => $appointmentsTotal,--}}
{{--                                    'timeSlotsStats' => $timeSlotsStats,--}}
{{--                                    'timeSlotsStatsLastWeek' => $timeSlotsStatsLastWeek,--}}
{{--                                    'viewsLastWeek' => $viewsLastWeek,--}}
{{--                                    'viewsLastMonth' => $viewsLastMonth,--}}
{{--                                    'percentageViewsChangeLastWeek' => $percentageViewsChangeLastWeek,--}}
{{--                                    'totalRevenue' => $totalRevenue,--}}
{{--                                    'totalRevenueLastWeek' => $totalRevenueLastWeek,--}}
{{--                                    'totalRevenueLastMonth' => $totalRevenueLastMonth,--}}
{{--                                    'percentageRevenueChangeLastWeek' => $percentageRevenueChangeLastWeek,--}}
{{--                                    'appointmentsLastWeek' => $appointmentsLastWeek,--}}
{{--                                    'appointmentsLastMonth' => $appointmentsLastMonth,--}}
{{--                                    'percentageAppointmentsChangeLastWeek' => $percentageAppointmentsChangeLastWeek,--}}


                                    <table class="border-collapse w-full">
                                        <thead>
                                        <tr>
                                            <th class="border p-2">Metric</th>
                                            <th class="border p-2">Last Week</th>
                                            <th class="border p-2">Change <span class="text-sm block">Last Week</span></th>
                                            <th class="border p-2">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="border p-2">Views</td>
                                            <td class="border p-2">{{ $viewsLastWeek }}</td>
                                            <td class="border p-2">
                                                @if($percentageViewsChangeLastWeek === 'N/A')
                                                    {{ $percentageViewsChangeLastWeek }}
                                                @elseif($percentageViewsChangeLastWeek > 0)
                                                    <span class="text-green-800"><span class="text-2xl">↑</span> {{ $percentageViewsChangeLastWeek }} %</span>
                                                @elseif ($percentageViewsChangeLastWeek < 0)
                                                    <span class="text-red-800"><span class="text-2xl">↓</span> {{ $percentageViewsChangeLastWeek }} %</span>
                                                @else
                                                    {{ $percentageViewsChangeLastWeek }} %
                                                @endif
                                            </td>
                                            <td class="border p-2">{{ $views }}</td>
                                        </tr>

                                        <tr>
                                            <td class="border p-2">Appointments</td>
                                            <td class="border p-2">{{ $appointmentsLastWeek }}</td>
                                            <td class="border p-2">
                                                @if($percentageAppointmentsChangeLastWeek === 'N/A')
                                                    {{ $percentageAppointmentsChangeLastWeek }}
                                                @elseif($percentageAppointmentsChangeLastWeek > 0)
                                                    <span class="text-green-800"><span class="text-2xl">↑</span> {{ $percentageAppointmentsChangeLastWeek }} %</span>
                                                @elseif ($percentageAppointmentsChangeLastWeek < 0)
                                                    <span class="text-red-800"><span class="text-2xl">↓</span> {{ $percentageAppointmentsChangeLastWeek }} %</span>
                                                @else
                                                    {{ $percentageAppointmentsChangeLastWeek }} %
                                                @endif
                                            </td>
                                            <td class="border p-2">{{ $appointmentsTotal }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border p-2">Appointments (Last Month)</td>
                                            <td class="border p-2">{{ $appointmentsLastMonth }}</td>
                                            <td class="border p-2">
                                                @if($percentageAppointmentsChangeLastMonth === 'N/A')
                                                    {{ $percentageAppointmentsChangeLastMonth }}
                                                @elseif($percentageAppointmentsChangeLastMonth > 0)
                                                    <span class="text-green-800"><span class="text-2xl">↑</span> <span class="text-2xl">{{ $percentageAppointmentsChangeLastMonth }} %</span></span>
                                                @elseif ($percentageAppointmentsChangeLastMonth < 0)
                                                    <span class="text-red-800"><span class="text-2xl">↓</span> <span class="text-2xl">{{ $percentageAppointmentsChangeLastMonth }} %</span></span>
                                                @endif
                                                <span class="text-[12px] block">Monthly</span>
                                            </td>
                                            <td class="border p-2"></td>
                                        </tr>
                                        <tr>
                                            <td class="border p-2">Revenue</td>
                                            <td class="border p-2"> LKR {{ number_format($totalRevenueLastWeek, 2, '.', ',') }}</td>
                                            <td class="border p-2">
                                                @if($percentageRevenueChangeLastWeek === 'N/A')
                                                    {{ $percentageRevenueChangeLastWeek }}
                                                @elseif($percentageRevenueChangeLastWeek > 0)
                                                    <span class="text-green-800"><span class="text-2xl">↑</span> {{ $percentageRevenueChangeLastWeek }} %</span>
                                                @elseif ($percentageRevenueChangeLastWeek < 0)
                                                    <span class="text-red-800"><span class="text-2xl">↓</span> {{ $percentageRevenueChangeLastWeek }} %</span>
                                                @endif
                                            </td>
                                            <td class="border p-2">LKR {{ number_format($totalRevenue, 2, '.', ',') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border p-2">Revenue (Last Month)</td>
                                            <td class="border p-2">LKR {{ number_format($totalRevenueLastMonth, 2, '.', ',') }}</td>
                                            <td class="border p-2">
                                                @if($percentageRevenueChangeLastMonth === 'N/A')
                                                    {{ $percentageRevenueChangeLastMonth }}
                                                @elseif($percentageRevenueChangeLastMonth > 0)
                                                    <span class="text-green-800"><span class="text-2xl">↑</span> <span class="text-2xl">{{ $percentageRevenueChangeLastMonth }} %</span></span>
                                                @elseif ($percentageRevenueChangeLastMonth < 0)
                                                    <span class="text-red-800"><span class="text-2xl">↓</span> <span class="text-2xl">{{ $percentageRevenueChangeLastMonth }} %</span></span>
                                                @endif
                                                <span class="text-[12px] block">Monthly</span>
                                            </td>
                                            <td class="border p-2"></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div>
                                        <h2 class="font-medium text-md my-2">Most Popular Time Slots Last Week</h2>
                                        <table class="border-collapse w-full">
                                            <thead>
                                            <tr>
                                                <th class="border p-2">Time Slot</th>
                                                <th class="border p-2">Count</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($timeSlotsStatsLastWeek as $timeSlotStat)
                                                <tr>

                                                    <td class="border p-2">{{ date('g:i a', strtotime($timeSlotStat['time_slot']->start_time))  . ' - ' .  date('g:i a', strtotime($timeSlotStat['time_slot']->end_time)) }}</td>
                                                    <td class="border p-2">{{ $timeSlotStat['count'] }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>


                                    </div>

                                    <div>
                                        <h2 class="font-medium text-md my-2">Most Popular Time Slots</h2>
                                        <table class="border-collapse w-full">
                                            <thead>
                                            <tr>
                                                <th class="border p-2">Time Slot</th>
                                                <th class="border p-2">Count</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($timeSlotsStats as $timeSlotStat)
                                                <tr>
                                                    <td class="border p-2">{{ date('g:i a', strtotime($timeSlotStat['time_slot']->start_time))  . ' - ' .  date('g:i a', strtotime($timeSlotStat['time_slot']->end_time)) }}</td>
                                                    <td class="border p-2">{{ $timeSlotStat['count'] }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>



                                </div>

                                    @endif

                        <!-- Reviews -->
                        {{--                    <div class="mt-6">--}}
                        {{--                        <h4 class="sr-only">Reviews</h4>--}}
                        {{--                        <div class="flex items-center">--}}
                        {{--                            <div class="flex items-center">--}}
                        {{--                                <!-- Active: "text-gray-900", Default: "text-gray-200" -->--}}
                        {{--                                <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
                        {{--                                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />--}}
                        {{--                                </svg>--}}
                        {{--                                <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
                        {{--                                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />--}}
                        {{--                                </svg>--}}
                        {{--                                <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
                        {{--                                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />--}}
                        {{--                                </svg>--}}
                        {{--                                <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
                        {{--                                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />--}}
                        {{--                                </svg>--}}
                        {{--                                <svg class="text-gray-200 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
                        {{--                                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />--}}
                        {{--                                </svg>--}}
                        {{--                            </div>--}}
                        {{--                            <p class="sr-only">3.9 out of 5 stars</p>--}}
                        {{--                            <a href="#" class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">117 reviews</a>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                    </section>
                    <section>
                        <div class="mt-6">
                            <h4 class="sr-only">Description</h4>
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    {{ $service->description }}
                                </div>
                            </div>
                        </div>
                    </section>
                    @if($service->benefits)
                        <section>
                            <div class="mt-6">
                                <h4 class="text-lg  font-medium">Benefits</h4>
                                <div class="flex items-center">
                                    <div class="flex items-center">
                                        {{ $service->benefits}}
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                    @if($service->cautions)
                        <section>
                            <div class="mt-6">
                                <h4 class="text-lg font-medium">Cautions</h4>
                                <div class="flex items-center">
                                    <div class="flex items-center">
                                        {{ $service->cautions }}
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                    @if($service->allegens)
                        <section>
                            <div class="mt-6">
                                <h4 class="text-lg font-medium">Allergens</h4>
                                <div class="flex items-center">
                                    <div class="flex items-center">
                                        {{ $service->allergens }}
                                    </div>
                                </div>
                            </div>
                        </section
                    @endif
                    @if($service->aftercare_tips)
                        <section>
                            <div class="mt-6">
                                <h4 class="text-lg font-medium">After Care Tips</h4>
                                <div class="flex items-center">
                                    <div class="flex items-center">
                                        {{ $service->aftercare_tips }}
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif

                    <livewire:adding-service-to-cart :service="$service"/>
{{--                    <section class="mt-10">--}}
{{--                        <h3 class="text-xl font-medium my-2">Book Your Appointment</h3>--}}

{{--                        <form>--}}
{{--                            <!-- Colors -->--}}
{{--                            <div>--}}
{{--                                <h4 class="text-lg font-medium text-gray-900">Select a date</h4>--}}
{{--                                <fieldset>--}}
{{--                                    <input type="date" class="rounded py-2 px-4 borde   r">--}}
{{--                                </fieldset>--}}
{{--                            </div>--}}

{{--                            <!-- Sizes -->--}}
{{--                            <div class="mt-5">--}}
{{--                                <h4 class="text-sm font-medium text-gray-900">Time Slots</h4>--}}
{{--                                <fieldset class="mt-4">--}}
{{--                                    <legend class="sr-only">Select a time</legend>--}}
{{--                                    <div class="grid grid-cols-3 gap-4" x-data="{ selectedTimeSlot: null }">--}}
{{--                                        @foreach($timeSlots as $timeSlot)--}}
{{--                                            @if($timeSlot->id != 5)--}}

{{--                                                <label--}}
{{--                                                    class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase  focus:outline-none sm:flex-1 cursor-pointer shadow-sm"--}}
{{--                                                    x-bind:class="{--}}
{{--                                                            'bg-pink-500 text-white ': selectedTimeSlot === '{{ $timeSlot->id }}',--}}
{{--                                                            'bg-gray-50 text-gray-800 hover:bg-pink-100': selectedTimeSlot !== '{{ $timeSlot->id }}',--}}
{{--                                                        }"--}}
{{--                                                >--}}
{{--                                                    <input type="radio" name="time-slot-choice"--}}
{{--                                                           value="{{ $timeSlot->id }}" class="sr-only"--}}
{{--                                                           aria-labelledby="size-choice-{{ $timeSlot->id }}-label"--}}
{{--                                                           x-model="selectedTimeSlot">--}}
{{--                                                        <span id="time-slot-choice-{{ $timeSlot->id }}-label">--}}
{{--                                                            {{ date('g:i a', strtotime($timeSlot->start_time)) }}--}}
{{--                                                            ---}}
{{--                                                            {{ date('g:i a', strtotime($timeSlot->end_time)) }}--}}
{{--                                                        </span>--}}
{{--                                                    <span class="pointer-events-none absolute -inset-px rounded-md"--}}
{{--                                                          aria-hidden="true"></span>--}}
{{--                                                </label>--}}
{{--                                            @else--}}
{{--                                                <label--}}
{{--                                                    class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 cursor-not-allowed bg-gray-50 text-gray-200">--}}
{{--                                                    <input type="radio" name="time-slot-choice"--}}
{{--                                                           value="{{ $timeSlot->id }}" disabled class="sr-only"--}}
{{--                                                           aria-labelledby="size-choice-7-label">--}}
{{--                                                    <span id="size-choice-7-label">--}}
{{--                                                        {{ date('g:i a', strtotime($timeSlot->start_time)) }}--}}
{{--                                                        ---}}
{{--                                                        {{ date('g:i a', strtotime($timeSlot->end_time)) }}--}}
{{--                                                    </span>--}}
{{--                                                    <span aria-hidden="true"--}}
{{--                                                          class="pointer-events-none absolute -inset-px rounded-md border-2 border-gray-200">--}}
{{--                                                        <svg class="absolute inset-0 h-full w-full stroke-2 text-gray-200" viewBox="0 0 100 100"--}}
{{--                                                             preserveAspectRatio="none" stroke="currentColor">--}}
{{--                                                            <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke"/>--}}
{{--                                                        </svg>--}}
{{--                                                    </span>--}}
{{--                                                </label>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}

{{--                            </fieldset>--}}
{{--                </div>--}}

{{--                <button type="submit"--}}
{{--                        class="mt-6 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">--}}
{{--                    Add to bag--}}
{{--                </button>--}}
{{--                </form>--}}
{{--                </section>--}}
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
