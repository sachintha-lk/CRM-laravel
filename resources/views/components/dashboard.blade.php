<x-app-layout>
    
    <x-slot name="header">
        @isset($header)
            {{ $header }}
        @endisset
    </x-slot>

    {{-- Nav links should be passed from here  --}}
    <x-slot name="navlinks">
        <x-dashboard.navlinks />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</x-app-layout>
