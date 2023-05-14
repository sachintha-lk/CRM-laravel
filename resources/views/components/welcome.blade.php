@php
    use App\Enums\UserRolesEnum;
    $role = UserRolesEnum::from(Auth::user()->role_id)->name;
@endphp
<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <x-application-logo class="block h-12 w-auto" />


    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Welcome to the 
        {{ $role}}
        Dashboard
    </h1>
    <p class="mt-6 text-gray-500 leading-relaxed">
        Manage your activity here.
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8"> 

   
</div>
