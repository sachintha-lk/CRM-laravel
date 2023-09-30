<div>
    <div class="flex justify-between mx-7">
        <h2 class="text-2xl font-bold">Services</h2>

        <x-button wire:click="confirmServiceAdd"  class="px-5 py-2 text-white bg-pink-500 rounded-md hover:bg--600">
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
                <input type="search" wire:model="search" id="default-search" name="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Services...">
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-pink-600 hover:bg-pink-700 focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
            </div>
        </div>

        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 overflow-x-scroll min-w-screen">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="pl-6 py-4 font-medium text-gray-900">Id</th>
              <th scope="col" class="px-4 py-4 font-medium text-gray-900">Service</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Photo</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Description</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Price</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Category</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Visibility</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Actions</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 border-t border-gray-100">

            @foreach ($services as $service)
            <tr class="hover:bg-gray-50">
                <td class="pl-6 py-4  max-w-0">{{ $service->id }}</td>

                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900  max-w-0">

                    <div class="font-medium text-gray-700">{{ $service->name}}</div>

                </th>
                <td class="px-6 py-4  max-w-0">
                    <div class="font-medium text-gray-700">
                        <img src="{{ asset('storage/' . $service->image) }}" alt="" class="w-20 h-20 object-cover">
                    </div>
                </td>

                <td class="px-6 py-4 max-w-0">{{ $service->description }}</td>

                <td class="px-6 py-4  max-w-0">
                    <div class="font-medium text-gray-700">{{ $service->price}}</div>
                </td>
                <td class="px-6 py-4  max-w-0">
{{--                    @dd($service->category->name)--}}
                    <div class="font-medium text-gray-700">{{ $service->category?->name}}</div>
                </td>
                <td class="px-6 py-4 ">
                    <div>

                    @if($service->is_hidden == true)
                        <span
                        class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-600"
                      >
                        <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                        Hidden
                      </span>
                    @else
                        <span
                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-600"
                        >
                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                        Visible
                        </span>
                    @endif

                    </div>
                </td>
                <td>
                    <div class="mt-5 ">
                        <a href="{{ route('view-service', ['slug' => $service->slug ])  }}">
                            <x-button>
                                {{ __('View') }}
                            </x-button>

                        </a>
                        <x-button wire:click="confirmServiceEdit({{ $service->id }})" wire:loading.attr="disabled">
                            {{ __('Edit') }}
                        </x-button>
                        <x-danger-button wire:click="confirmServiceDeletion({{ $service->id }})" wire:loading.attr="disabled">
                            {{ __('Delete') }}
                        </x-danger-button>



{{--                        <x-button href="">--}}
{{--                            <svg width="20" height="20" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">                                <path d="M9.00977 21.39H19.0098C20.0706 21.39 21.0881 20.9685 21.8382 20.2184C22.5883 19.4682 23.0098 18.4509 23.0098 17.39V7.39001C23.0098 6.32915 22.5883 5.31167 21.8382 4.56152C21.0881 3.81138 20.0706 3.39001 19.0098 3.39001H7.00977C5.9489 3.39001 4.93148 3.81138 4.18134 4.56152C3.43119 5.31167 3.00977 6.32915 3.00977 7.39001V12.39" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M1.00977 18.39H11.0098" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M1.00977 15.39H5.00977" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M22.209 5.41992C16.599 16.0599 9.39906 16.0499 3.78906 5.41992" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <script xmlns=""/></svg>--}}
{{--                        </x-button>--}}
                    </div>
                </td>
            </tr>
            @endforeach

          </tbody>
        </table>
        <div class="p-5">
          {{ $services->links() }}
        </div>



        <x-dialog-modal wire:model="confirmingServiceDeletion">
            <x-slot name="title">
                {{ __('Delete Service') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete the service?') }}

            </x-slot>

            <x-slot name="footer">
                <div class="flex gap-3">
                <x-secondary-button wire:click="$set('confirmingServiceDeletion', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                    <x-danger-button wire:click="deleteService({{ $confirmingServiceDeletion }})" wire:loading.attr="disabled">
                        {{ __('Delete') }}
                    </x-danger-button>
                </div>

            </x-slot>
        </x-dialog-modal>


        <x-dialog-modal wire:model="confirmingServiceAdd">
            <x-slot name="title">
                {{-- {{ __('Add a new service') }} --}}
                {{ isset($this->newService->id) ? 'Edit Service' : 'Add Service' }}
            </x-slot>

            <x-slot name="content">


                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" wire:model="newService.name" id="name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('newService.name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" wire:model="newService.description"  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            @error('newService.description') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="text" wire:model="newService.price" id="price" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                            @error('newService.price') <span class="text-red-500">{{ $message }}</span>@enderror

                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>

                            <select wire:model="newService.category_id" id="category_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option disabled selected value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name}}</option>
                                @endforeach
                                @error('newService.category_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </select>
                        </div>

{{--                        <div>--}}
{{--                            <label for="duration_minutes" class="block text-sm font-medium text-gray-700">Duration</label>--}}

{{--                            <select wire:model="newService.duration_minutes" id="duration_minutes" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}

{{--                                    <option disabled selected value="">Select Duration</option>--}}
{{--                                    @for ($hours = 0; $hours <= 3; $hours++)--}}
{{--                                        @for ($minutes = 15; $minutes <= 45; $minutes += 15)--}}
{{--                                            <option value="{{ ($hours * 60) + $minutes }}">{{ $hours > 0 ? $hours . 'h ' : '' }}{{ $minutes }} min</option>--}}
{{--                                        @endfor--}}
{{--                                    @endfor--}}
{{--                                @error('newService.duration_minutes') <span class="text-red-500">{{ $message }}</span>@enderror--}}
{{--                            </select>--}}
{{--                        </div>--}}
                    </div>
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <label for="allergens" class="block text-sm font-medium text-gray-700">Allergens</label>
                        <textarea id="allergens" wire:model="newService.allergens"  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        @error('newService.allergens') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label for="cautions" class="block text-sm font-medium text-gray-700">Cautions</label>
                        <textarea id="cautions" wire:model="newService.benefits"  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        @error('newService.cautions') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>

                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div>
                            <label for="benefits" class="block text-sm font-medium text-gray-700">Benefits</label>
                            <textarea id="benefits" wire:model="newService.benefits"  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            @error('newService.benefits') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label for="aftercare_tips" class="block text-sm font-medium text-gray-700">Aftercare Tips</label>
                            <textarea id="aftercare_tips" wire:model="newService.aftercare_tips"  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                            @error('newService.aftercare_tips') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                    </div>
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea id="notes" wire:model="newService.notes"  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        @error('newService.notes') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="is_hidden" class="block text-sm font-medium text-gray-700">Is Hidden</label>

                        <input type="checkbox" wire:model="newService.is_hidden" id="is_hidden">
                        @error('newService.is_hidden') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>


                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div class="col-span-2">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="file" wire:model.defer="image" id="image" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('image') <span class="text-red-500">{{ $message }}</span>@enderror

                            {{-- If the image is already saved is system show img --}}
                             @if (isset($image) && is_string($image))
                                <img alt="image" src="{{ '/storage/' . $image }}" class="mt-4" width="200">
                            {{-- When the image is uploaded show img --}}
                             @elseif (isset($image) && is_object($image))
                                <img alt="image" src="{{ $image->temporaryUrl() }}" class="mt-4" width="200">
                             @else

                            @endif

                        </div>
                    </div>
                    <div class="flex justify-end mt-4 gap-2">

                        <x-secondary-button wire:click="$set('confirmingServiceAdd', false)" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-button wire:click="saveService">Save</x-button>
                    </div>


            </x-slot>

            <x-slot name="footer">


            </x-slot>
        </x-dialog-modal>





</div>
</div>
