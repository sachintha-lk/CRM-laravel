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
            @if (session('errormsg'))
                <div class="mb-4 font-medium text-sm text-red-600">
                    {{ session('errormsg') }}
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('success') }}
                </div>
            @endif
    
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
</x-app-layout>
