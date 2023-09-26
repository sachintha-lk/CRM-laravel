@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
    <img src="{{ asset('images/logo-pink.png') }}" class="logo" alt="Salon Bliss Logo">
    <br>
    {{ $slot }}
@endif
</a>
</td>
</tr>
