@if(Auth::User())

    {{-- Only admin can manage the users at the moment --}}
    {{-- @if(Auth::User()->role()->first()->name == 'Admin')
        <x-nav-link href="{{ route('manageusers') }}" :active="request()->routeIs('manageusers')">
            {{ __('Manage Users') }}
        </x-nav-link>
    @endif --}}
@endif
