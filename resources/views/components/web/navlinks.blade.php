{{-- Nav Links for the customer facing web --}}

<x-nav-link href="{{ route('services') }}" :active="request()->routeIs('services')">
    {{ __('Services') }}
</x-nav-link>

<x-nav-link href="{{ route('deals') }}" :active="request()->routeIs('deals')">
    {{ __('Deals') }}
</x-nav-link>
{{-- 
<x-nav-link href="{{ route('manageusers') }}" :active="request()->routeIs('manageusers')">
    {{ __('Manage Users') }}
</x-nav-link> --}}