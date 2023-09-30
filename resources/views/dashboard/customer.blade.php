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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 p-4 gap-4">


        {{-- <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
          <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
          </div>
          <div class="text-right">
            <p class="text-2xl">557</p>
            <p>Orders</p>
          </div>
        </div> --}}
        {{-- <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
          <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
          </div>
          <div class="text-right">
            <p class="text-2xl">$11,257</p>
            <p>Sales</p>
          </div>
        </div> --}}
        {{-- <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">
          <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
            <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          </div>
          <div class="text-right">
            <p class="text-2xl">$75,257</p>
            <p>Balances</p>
          </div>
        </div> --}}
{{--        <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">--}}
{{--          <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">--}}
{{--            <svg width="30" height="30" fill="none" viewBox="0 0 17 17" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/> <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/></svg>--}}
{{--          </div>--}}
{{--          <div class="text-right">--}}
{{--            --}}{{-- <p class="text-2xl">{{ $totalUpcommingDeals }}</p> --}}
{{--            <p>Upcoming Deals</p>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div class="bg-pink-500  shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-pink-600  text-white font-medium group">--}}
{{--          <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">--}}
{{--            <svg width="30" height="30" fill="none" viewBox="0 0 17 17" stroke="currentColor" class="stroke-current text-pink-800  transform transition-transform duration-500 ease-in-out"><path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/> <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/></svg>--}}
{{--          </div>--}}
{{--          <div class="text-right">--}}
            {{-- <p class="text-2xl">{{ $totalOngoingDeals }}</p> --}}
{{--            <p>Ongoing Deals</p>--}}
          </div>
        </div>


     <livewire:manage-appointments />





</x-dashboard>
