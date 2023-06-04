<div>
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold">Services</h2>
        
        <x-button wire:click="confirmServiceAdd"  class="px-4 py-2 text-white bg-pink-500 rounded-md hover:bg--600">
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

        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 overflow-x-scroll min-w-screen">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="pl-6 py-4 font-medium text-gray-900">Id</th>
              <th scope="col" class="px-4 py-4 font-medium text-gray-900">Service</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Photo</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Description</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Price</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Visibility</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Actions</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            
            @foreach ($services as $service)
            <tr class="hover:bg-gray-50">
                <td class="pl-6 py-4">{{ $service->id }}</td>
    
                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                 
                    <div class="font-medium text-gray-700">{{ $service->name}}</div>
               
                </th>
                <td class="px-6 py-4">
                    <div class="font-medium text-gray-700">
                        <img src="{{ asset('storage/images/' . $service->image) }}" alt="" class="w-20 h-20 object-cover">
                    </div>
                </td>
               
                <td class="px-6 py-4">{{ $service->description }}</td>
                <td class="px-6 py-4">
                    <div class="font-medium text-gray-700">{{ $service->price}}</div>
                </td>
                <td class="px-6 py-4">
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
                    <div class="mt-5">
                        <x-button wire:click="confirmServiceEdit({{ $service->id }})" wire:loading.attr="disabled">
                            {{ __('Edit') }}
                        </x-button>
                        <x-danger-button wire:click="confirmServiceDeletion({{ $service->id }})" wire:loading.attr="disabled">
                            {{ __('Delete') }}
                        </x-danger-button>
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
                <x-secondary-button wire:click="$set('confirmingServiceDeletion', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>
    
                <div class="mt-5">
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
                            <input type="text" wire:model="newService.description" id="description" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('newService.description') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="text" wire:model="newService.price" id="price" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                         
                            @error('newService.price') <span class="text-red-500">{{ $message }}</span>@enderror 

                        </div>
                        <div>
                            <label for="is_hidden" class="block text-sm font-medium text-gray-700">Is Hidden</label>
                           
                            <input type="checkbox" wire:model="newService.is_hidden" id="is_hidden">
                            @error('newService.is_hidden') <span class="text-red-500">{{ $message }}</span>@enderror 

                            
                        </div>
                        
                    </div>
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div class="col-span-2">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="file" wire:model="newService.image" id="image" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('newService.image') <span class="text-red-500">{{ $message }}</span>@enderror

                            {{-- If the image is already saved is system show img --}}
                            {{-- @if (isset($newService['image']) && is_string($newService['image'])) 

                                <img src="{{ '/storage/images/' . $newService['image'] }}" class="mt-4" width="200">  --}}
                            
                            {{-- When the image is uploaded show img --}}
                            {{-- @elseif (isset($newService['image']) && is_object($newService['image']))
                           

                                <img src="{{ $newService['image']->temporaryUrl() }}" class="mt-4" width="200">
                            @else 

                            @endif --}}

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
