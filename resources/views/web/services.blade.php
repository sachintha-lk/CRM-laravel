<x-app-layout>
    {{--    <x-slot name="header">--}}
    {{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">--}}
    {{--            {{ __('Services') }}--}}
    {{--        </h2>--}}
    {{--    </x-slot>--}}
    {{--    <div class="flex flex-wrap gap-4 mt-10">--}}
    {{--        @foreach ($services as $service)--}}
    {{--        @if($service->is_hidden == false)--}}
    {{--            <div class="mx-auto w-80 pb-20 transform overflow-hidden rounded-lg bg-white shadow-md duration-300 hover:scale-105 hover:shadow-lg">--}}
    {{--                <img class="h-48 w-full object-cover object-center" src="{{ asset('storage/images/'. $service->image)}}" alt="Product Image" />--}}
    {{--                <div class="p-4">--}}
    {{--                <h2 class="mb-2 text-lg font-medium  text-gray-900">{{ $service->name}}</h2>--}}
    {{--                <p class="mb-2 text-base text-gray-700">{{ $service->description}}</p>--}}
    {{--                --}}
    {{--                <div class="fixed pt-9 bottom-2 w-4/5">--}}
    {{--                    <div class="flex items-center mb-1">--}}
    {{--                    <div>--}}
    {{--                        <p class="mr-2 text-lg font-semibold text-gray-900">LKR {{ $service->price}}</p>--}}
    {{--                    --}}{{-- <p class="text-sm  font-medium text-gray-500 line-through">LKR 4,000.00</p> --}}
    {{--                    </div>--}}
    {{--                    <p class="ml-auto text-lg font-medium text-green-500">10% off</p>--}}
    {{--                    </div>                --}}
    {{--                    <x-button >Book Now</x-button>--}}
    {{--                </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        @endif--}}
    {{--        @endforeach--}}

    {{--    </div>--}}
    {{--    --}}
    <livewire:customer-services-view />

</x-app-layout>
