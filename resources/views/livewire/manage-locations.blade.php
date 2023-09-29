<div>
    <div>
        <div class="flex justify-between mx-7">
            <h2 class="text-2xl font-bold">Locations</h2>

            <x-button wire:click="confirmLocationAdd"  class="px-5 py-2 text-white bg-pink-500 rounded-md hover:bg--600">
                Create
            </x-button>
        </div>
        <div class="mt-4">
            @if (session()->has('message'))
                <div class="px-4 py-2 text-white bg-green-500 rounded-md">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="overflow-auto rounded-lg border border-gray-200 shadow-md m-5">

            <div class="w-1/3 float-right m-4">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" wire:model="search" id="default-search" name="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Locations...">
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-pink-600 hover:bg-pink-700 focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                </div>
            </div>

            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 overflow-x-scroll min-w-screen">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="pl-6 py-4 font-medium text-gray-900">Id</th>
                    <th scope="col" class="px-4 py-4 font-medium text-gray-900">Name</th>
                    <th scope="col" class="px-4 py-4 font-medium text-gray-900">Address</th>
                    <th scope="col" class="px-4 py-4 font-medium text-gray-900">Telephone Number</th>
                    <th scope="col" class="px-4 py-4 font-medium text-gray-900">Is Operating</th>
                    <th scope="col" class="px-4 py-4 font-medium text-gray-900">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">

                @foreach ($locations as $location)
                    <tr class="hover:bg-gray-50">
                        <td class="pl-6 py-4  max-w-0">{{ $location->id }}</td>

                        <td class="px-6 py-4 max-w-xs font-medium text-gray-700">{{ $location->name}}</td>

                        <td class="px-6 py-4 max-w-xs font-medium text-gray-700">{{ $location->address}}</td>

                        <td class="px-6 py-4 max-w-xs font-medium text-gray-700">{{ $location->telephone_number}}</td>

                        <td class="px-6 py-4 max-w-xs font-medium text-gray-700">{{ $location->status ? 'Yes' : 'No'}}</td>



                        <td>
                            <div class="flex gap-1 mt-5">
                                <x-button wire:click="confirmLocationEdit({{ $location->id }})" wire:loading.attr="disabled">
                                    {{ __('Edit') }}
                                </x-button>


                                <x-danger-button wire:click="confirmLocationDeletion({{ $location->id }})" wire:loading.attr="disabled">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="p-5">
                {{ $locations->links() }}
            </div>



            <x-dialog-modal wire:model="confirmingLocationDeletion">
                <x-slot name="title">
                    {{ __('Delete Location') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Are you sure you want to delete the location?') }}

                </x-slot>

                <x-slot name="footer">
                    <div class="flex gap-3">
                        <x-secondary-button wire:click="$set('confirmingLocationDeletion', false)" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button wire:click="deleteLocation({{ $confirmingLocationDeletion }})" wire:loading.attr="disabled">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </div>

                </x-slot>
            </x-dialog-modal>
            <x-dialog-modal wire:model="confirmingLocationAdd">
                <x-slot name="title">
                    {{ isset($this->location->id) ? 'Edit Location' : 'Add Location' }}
                </x-slot>

                <x-slot name="content">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" wire:model="location.name" id="name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        @error('location.name') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea type="text" wire:model="location.address" id="address" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm"></textarea>
                        @error('location.address') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label for="telephone_number" class="block text-sm font-medium text-gray-700">Telephone Number</label>
                        <input type="tel" wire:model="location.telephone_number" minlength="10" maxlength="10" id="name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        @error('location.telephone_number') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Is Operating</label>

                        <input type="checkbox" wire:model="location.status" id="status"  class="block mt-1 p-2 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">

                        @error('location.status') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>



                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div class="flex justify-end mt-4 gap-2">
                            <x-secondary-button wire:click="$set('confirmingLocationAdd', false)" wire:loading.attr="disabled">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-button wire:click="saveLocation">Save</x-button>
                        </div>
                    </div>
                </x-slot>
                <x-slot name="footer">
                </x-slot>
            </x-dialog-modal>
        </div>
    </div>
</div>

