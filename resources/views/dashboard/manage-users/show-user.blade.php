<x-dashboard>
    <div class="container mx-auto p-1">
        <div class="pb-2 mb-3">

                <div class="bg-white p-3 shadow-sm rounded-sm" x-data="{ showFullInfo : false}">
                    <div class="text-center my-2">
                        <img class="h-16 w-16 rounded-full mx-auto"
                             src="{{ $user->profile_photo_url }}"
                             alt="">

                        <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $user->name }}</h1>
                        <h3 class="text-gray-600 font-lg text-semibold leading-6">{{ $user->role->name }}</h3>

                    </div>
                    <div class="text-gray-700" >
                        <div class="grid md:grid-cols-2 text-sm">
{{--                            <div class="grid grid-cols-2">--}}
{{--                                <div class="px-4 py-2 font-semibold">First Name</div>--}}
{{--                                <div class="px-4 py-2">Jane</div>--}}
{{--                            </div>--}}
{{--                            <div class="grid grid-cols-2">--}}
{{--                                <div class="px-4 py-2 font-semibold">Last Name</div>--}}
{{--                                <div class="px-4 py-2">Doe</div>--}}
{{--                            </div>--}}
{{--                            <div class="grid grid-cols-2">--}}
{{--                                <div class="px-4 py-2 font-semibold">Gender</div>--}}
{{--                                <div class="px-4 py-2">Female</div>--}}
{{--                            </div>--}}
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Phone No.</div>
                                <div class="px-4 py-2">{{ $user->phone_number }}</div>
                            </div>
{{--                            <div class="grid grid-cols-2">--}}
{{--                                <div class="px-4 py-2 font-semibold">Current Address</div>--}}
{{--                                <div class="px-4 py-2">Beech Creek, PA, Pennsylvania</div>--}}
{{--                            </div>--}}
{{--                            <div class="grid grid-cols-2">--}}
{{--                                <div class="px-4 py-2 font-semibold">Permanant Address</div>--}}
{{--                                <div class="px-4 py-2">Arlington Heights, IL, Illinois</div>--}}
{{--                            </div>--}}
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Email.</div>
                                <div class="px-4 py-2">
                                    <a class="text-blue-800" href="mailto:jane@example.com">{{ $user->email }}</a>
                                </div>
                            </div>

{{--                            <div class="grid grid-cols-2">--}}
{{--                                <div class="px-4 py-2 font-semibold">Birthday</div>--}}
{{--                                <div class="px-4 py-2">Feb 06, 1998</div>--}}
{{--                            </div>--}}

                        </div>
                        <ul
                            class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                            <li class="flex items-center py-3">
                                <span>Status</span>
                                @if ($user->status == 1)
                                    <span class="ml-auto"><span
                                            class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
                                @else
                                    <span class="ml-auto"><span
                                            class="bg-red-500 py-1 px-2 rounded text-white text-sm">Inactive</span></span>
                                @endif
                            </li>
                            <li class="flex items-center py-3">
                                <span>Joined Date</span>
                                <span class="ml-auto">{{ $user->created_at->toDateString() }}</span>
                            </li>

                            <li class="flex items-center py-3">
                                <span>Last Appointment</span>
                                <span class="ml-auto">{{ $appointments->where('status', true)->sortByDesc('date')->where('date', '<=' , \Carbon\Carbon::today()->toDateString() )->first()?->service->name }}</span>
                            </li>
                            <li class="flex items-center py-3">
                                <span>Last Appointment Date</span>
                                <span class="ml-auto">{{ $appointments->where('status', true)->sortByDesc('date')->first()?->date }}</span>
                            </li>
                            <div x-cloak x-show="showFullInfo">
                                <li class="flex items-center py-3">
                                    <span>Last Purchase</span>
                                    <span class="ml-auto"> {{ $appointments->where('status', true)->sortByDesc('created_at')->first()?->service->name }} </span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Last Purchase Date</span>
                                    <span class="ml-auto"> {{ $appointments->where('status', true)->sortByDesc('created_at')->first()?->created_at->toDateString() }}</span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Last Purchase Amount</span>
                                    <span class="ml-auto"> LKR {{ $appointments->where('status', true)->sortByDesc('created_at')->first()?->total }}</span>
                                </li>

                                <li class="flex items-center py-3">
                                    <span>Total Purchases</span>
                                    <span class="ml-auto"> LKR {{ $appointments->where('status', true)?->sum('total') }}</span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Last Cancellation</span>
                                    <span class="ml-auto">  {{ $appointments->where('status', false)->sortByDesc('created_at')->first()?->service->name}}</span>
                                </li>
                            </div>
                        </ul>
                    </div>
                    <button
                        x-on:click="showFullInfo = !showFullInfo"
                        class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Show
                        Full Information</button>
            </div>

        </div>
        <div class="w-full">

            <livewire:manage-appointments :user-id="$user->id" :select-filter="'upcoming'" />


        </div>
    </div>
</x-dashboard>
