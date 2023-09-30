@php
    use App\Enums\UserRolesEnum;
    $role = UserRolesEnum::from(Auth::user()->role_id)->name;
@endphp
<x-dashboard>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

 <div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 px-4 gap-4">

        <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
            <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div class="text-right">
                <p class="text-2xl">

                    LKR
                    {{ number_format($bookingRevenueThisMonth, 2, '.', ',') }}
                </p>
                <p>Booking Revenue This Month</p>
            </div>
        </div>
        <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
            <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                @if( $percentageRevenueChangeLastMonth >= 0 )
                    <svg fill="#9d174d" width="30" height="30" viewBox="0 0 24 24" id="up-trend-round" data-name="Flat Line" xmlns="http://www.w3.org/2000/svg" class="icon flat-line"><path id="primary" d="M21,7l-6.79,6.79a1,1,0,0,1-1.42,0l-2.58-2.58a1,1,0,0,0-1.42,0L3,17" style="fill: none; stroke:rgb(157, 23, 77); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"/><polyline id="primary-2" data-name="primary" points="21 11 21 7 17 7" style="fill: none; stroke: rgb(157, 23, 77); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"/><script xmlns=""/></svg>
                @else
                    <svg fill="#9d174d" width="30" height="30" viewBox="0 0 24 24" id="down-trend" data-name="Flat Line" xmlns="http://www.w3.org/2000/svg" class="icon flat-line"><polyline id="primary" points="3 6 11 14 14 11 21 18" style="fill: none; stroke: rgb(157, 23, 77); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline><polyline id="primary-2" data-name="primary" points="17 18 21 18 21 14" style="fill: none; stroke: rgb(157, 23, 77); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></polyline></svg>
                @endif
            </div>
            <div class="text-right">
                <p class="text-2xl">

                    {{ $percentageRevenueChangeLastMonth > 0 ? '+' : '' }}

                    {{ $percentageRevenueChangeLastMonth }}%


                </p>
                <p>Monthly Revenue Change</p>
            </div>
        </div>
        <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
            <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
              <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div class="text-right">
              <p class="text-2xl">{{ $totalCustomers }}</p>
              <p>Customers</p>
            </div>
          </div>
        <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
          <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
          </div>
          <div class="text-right">
            <p class="text-2xl">{{ $totalEmployees }}</p>
            <p>Employees</p>
          </div>
        </div>


        {{-- <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
          <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          </div>
          <div class="text-right">
            <p class="text-2xl">$75,257</p>
            <p>Balances</p>
          </div>
        </div> --}}
        <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
          <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
          </div>
          <div class="text-right">
            <p class="text-2xl">{{ $totalServices }}</p>
            <p>Services</p>
          </div>
        </div>
        <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
          <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
          </div>
          <div class="text-right">
            <p class="text-2xl">{{ $totalServicesActive }}</p>
            <p>Active Services</p>
          </div>
        </div>
        <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
          <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 17 17" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/> <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/></svg>
          </div>
          <div class="text-right">
            <p class="text-2xl">{{ $totalUpcomingDeals }}</p>
            <p>Upcoming Deals</p>
          </div>
        </div>
        <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
          <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 17 17" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/> <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/></svg>
          </div>
          <div class="text-right">
            <p class="text-2xl">{{ $totalOngoingDeals }}</p>
            <p>Ongoing Deals</p>
          </div>
        </div>

        <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
            <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <div class="text-right">
                <p class="text-2xl">{{ $totalUpcomingAppointments }}</p>
                <p>Upcoming Appointments</p>
            </div>
        </div>
      </div>

     <div class="mt-4">
         @foreach($locations as $location)
             <h1 class=" m-3 font-medium text-gray-800 text-2xl mb-2">{{ $location->name }}</h1>

             <div class="grid md:grid-cols-2">
                 <div class="m-3">
                     <h2 class="font-medium text-gray-800 text-xl mb-2">Today's Schedule</h2>
                     <x-day-schedule :date="\Carbon\Carbon::today()" :location-id="$location->id" />
                 </div>

                 <div class="m-3">
                     <h2 class="font-medium text-gray-800 text-xl mb-2">Tomorrow's Schedule</h2>
                     <x-day-schedule :date="\Carbon\Carbon::today()->addDay()" :location-id="$location->id"/>
                 </div>

             </div>
         @endforeach
     </div>










 </div>

</x-dashboard>
