<div>
    <div>
        <div class="flex justify-between mx-7">
            <h2 class="text-2xl font-bold">Deals</h2>
            
            <x-button wire:click="confirmDealAdd"  class="px-5 py-2 text-white bg-pink-500 rounded-md hover:bg--600">
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
                  <th scope="col" class="px-4 py-4 font-medium text-gray-900">Name</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Description</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Discount</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Date Start</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Date End</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Is Hidden</th>
                  <th scope="col" class="px-6 py-4 font-medium text-gray-900">Actions</th>            
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                
                @foreach ($deals as $deal)
                <tr class="hover:bg-gray-50">
                    <td class="pl-6 py-4  max-w-0">{{ $deal->id }}</td>
        
                    <td class="px-6 py-4 max-w-xs font-medium text-gray-700">{{ $deal->name}}</td>
                   
                    <td class="px-6 py-4 max-w-xs">{{ $deal->description }}</td>

                    <td class="px-6 py-4  max-w-0">
                        <div class="font-medium text-gray-700">{{ ($deal->discount) }} %</div>
                    </td>
                    <td class="px-6 py-4  max-w-0">
                        <div class="font-medium text-gray-700">{{ $deal->date_start }}</div>
                    </td>
                    <td class="px-6 py-4  max-w-0">
                        <div class="font-medium text-gray-700">{{ $deal->date_end }}</div>
                    </td>
                    
                    <td class="px-6 py-4 ">
                        <div>
                       
                        @if($deal->is_hidden == true) 
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
                        <div class="flex gap-1 mt-5">
                            <x-button wire:click="confirmDealEdit({{ $deal->id }})" wire:loading.attr="disabled">
                                {{ __('Edit') }}
                            </x-button>
                         

                            
                            <x-danger-button wire:click="confirmDealDeletion({{ $deal->id }})" wire:loading.attr="disabled">
                                {{ __('Delete') }}
                            </x-danger-button>
                        </div>
                    </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
            <div class="p-5">
              {{ $deals->links() }}
            </div>
        
        
            
            <x-dialog-modal wire:model="confirmingDealDeletion">
                <x-slot name="title">
                    {{ __('Delete Deal') }}
                </x-slot>
        
                <x-slot name="content">
                    {{ __('Are you sure you want to delete the deal?') }}
        
                </x-slot>
        
                <x-slot name="footer">
                    <div class="flex gap-3">
                        <x-secondary-button wire:click="$set('confirmingDealDeletion', false)" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-secondary-button>
    
            
                            <x-danger-button wire:click="deleteDeal({{ $confirmingDealDeletion }})" wire:loading.attr="disabled">
                                {{ __('Delete') }}
                            </x-danger-button>
                    </div>
                   
         
                    
                </x-slot>
            </x-dialog-modal>
            
    
            <x-dialog-modal wire:model="confirmingDealAdd">
                <x-slot name="title">
                    {{-- {{ __('Add a new deal') }} --}}
                    {{ isset($this->newDeal->id) ? 'Edit Deal' : 'Add Deal' }}
                </x-slot>
        
                <x-slot name="content">
                    
                      
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" wire:model="newDeal.name" id="name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                                @error('newDeal.name') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <input type="text" wire:model="newDeal.description" id="description" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                                @error('newDeal.description') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                     
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                            
                            <div>
                                <label for="date_start" class="block text-sm font-medium text-gray-700">Date Start</label>
                                <input type="date" wire:model="newDeal.date_start" id="date_start" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                                @error('newDeal.date_start') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label for="date_end" class="block text-sm font-medium text-gray-700">Date End</label>
                                <input type="date" wire:model="newDeal.date_end" id="date_end" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                                @error('newDeal.date_end') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                            
                        <div>
                            <label for="discount" class="block text-sm font-medium text-gray-700">Discount Percentage</label>
                            <input type="number" wire:model="newDeal.discount" id="discount" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                            @error('newDeal.discount') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                            <div>
                                <label for="is_hidden" class="block text-sm font-medium text-gray-700">Is Hidden</label>
                                <input type="checkbox" wire:model="newDeal.is_hidden" id="is_hidden" class="block w-5 h-5 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                                @error('newDeal.is_hidden') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div>
                            </div>
                        </div>        
                        <div class="flex justify-end mt-4 gap-2">
                                      
                            <x-secondary-button wire:click="$set('confirmingDealAdd', false)" wire:loading.attr="disabled">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-button wire:click="saveDeal">Save</x-button>
                        </div>
                    
        
                </x-slot>
        
                <x-slot name="footer">
    
                    
                </x-slot>
            </x-dialog-modal>
    
                  
    
        
            
    </div>
</div>