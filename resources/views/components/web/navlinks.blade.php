{{-- Nav Links for the customer facing web --}}

<x-nav-link href="#">
    {{ __('Services') }}
</x-nav-link>

<x-nav-link href="#">
    {{ __('Deals') }}
</x-nav-link>

@if(Auth::User())

    {{-- Only admin can manage the users at the moment --}}
    @if(Auth::User()->role()->first()->name == 'Admin');
        <x-nav-link href="{{ route('manageusers') }}" :active="request()->routeIs('manageusers')">
            {{ __('Manage Users') }}
        </x-nav-link>
    @endif
@endif

{{-- 
<x-nav-link href="{{ route('manageusers') }}" :active="request()->routeIs('manageusers')">
    {{ __('Manage Users') }}
</x-nav-link> --}}