<x-dashboard>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div>
        <form action="{{ route('manageusers.store')}}" method="post" class="w-1/2 mx-auto bg-white rounded-lg p-5">
            @csrf
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4 my-2">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" name="name" />
                <x-input-error for="name" class="mt-2" />
            </div>
        
            <!-- Email -->
            <div class="col-span-6 sm:col-span-4 my-2">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="email" class="mt-1 block w-full" name="email" />
                <x-input-error for="email" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div class="col-span-6 sm:col-span-4 my-2">
                <x-label for="phone_number" value="{{ __('Phone Number') }}" />
                <span class="text-xs">eg: 0112121211</span>
                <x-input id="phone_number" type="text" class="mt-1 block w-full" name="phone_number" />
                <x-input-error for="phone_number" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="col-span-6 sm:col-span-4 my-2">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" class="mt-1 block w-full" name="password"/>
                <x-input-error for="password" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="col-span-6 sm:col-span-4 my-2">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" type="password" class="mt-1 block w-full" name="password_confirmation" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>

            <!-- Role -->
            <div class="col-span-6 sm:col-span-4 my-2">
                <x-label for="role" value="{{ __('Role') }}" />
                <select name="role" id="role" class="border-gray-300 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm">
                    <option value="employee">Employee</option>
                    <option value="customer">Customer</option>
                </select>
                <x-input-error for="role" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Create User') }}
                </x-button>
            </div>
        </form>
    </div>
    
</x-dashboard>
