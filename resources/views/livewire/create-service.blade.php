<div>
    
   
    <form wire:submit.prevent="submit">
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" wire:model="name" id="name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <input type="text" wire:model="description" id="description" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
        </div>
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="text" wire:model="price" id="price" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('price') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div>
                <label for="is_hidden" class="block text-sm font-medium text-gray-700">Is Hidden</label>
               
                <input type="checkbox" wire:model="is_hidden" id="is_hidden">
                
            </div>
            
        </div>
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <div class="col-span-2">
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" wire:model="image" id="image" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('image') <span class="text-red-500">{{ $message }}</span>@enderror

                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="mt-4" width="200">
                @endif
            </div>
         
            

        </div>
       
        
        
        <div class="flex justify-end mt-4">
            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">Create</button>
        </div>
    </form>


</div>
