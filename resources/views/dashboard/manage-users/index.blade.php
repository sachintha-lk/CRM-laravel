<x-dashboard>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>
    <div class="ml-5">
      <x-button>
        <a href="{{ route('manageusers.create') }}">Add User</a>
      </x-button>
    </div>
   
    <div class="overflow-auto rounded-lg border border-gray-200 shadow-md m-5">
  
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 overflow-x-scroll min-w-screen">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="pl-6 py-4 font-medium text-gray-900">Id</th>
              <th scope="col" class="px-4 py-4 font-medium text-gray-900">User</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Status</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Role</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900">Actions</th>
              <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            
            @foreach ($users as $user)
            <tr class="hover:bg-gray-50">
                <td class="pl-6 py-4">{{ $user->id }}</td>

                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                  <div class="relative h-10 w-10">
                    <img
                      class="h-full w-full rounded-full object-cover object-center"
                      src={{ $user->profile_photo_url }}
                      alt=""
                    />
                    {{-- <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span> --}}
                  </div>
                  <div class="text-sm">
                    <div class="font-medium text-gray-700">{{ $user->name}}</div>
                    <div class="text-gray-400">{{ $user->email}}</div>
                    <div class="text-gray-400 text-xs">{{ $user->phone_number}}</div>
                  </div>
                </th>
                <td class="px-6 py-4">
                     @if($user->status == true) 
                        <span
                        class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-medium  text-green-600"
                      >
                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                        Active
                      </span>
                    
                    @else 
                        <span
                        class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-600"
                      >
                        <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                        Suspended
                      </span>
                    
                        
                    @endif 
                 
  
                  
  
                </td>
                <td class="px-6 py-4">{{ $user->role->name }}</td>
                <td class="px-6 py-4">
                  <div class="flex gap-2">
                     
                    @if($user->role()->first()->name != 'Admin') 
                      @if($user->status == true) 
                        <form action="{{ route('manageusers.suspend', $user->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="bg-red-50 p-1 px-2 rounded-md text-red-600 hover:text-red-900">Suspend</button>
                        </form>
                      @else
                        <form action="{{ route('manageusers.activate', $user->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="bg-green-50 p-1 px-2 rounded-md text-green-600 hover:text-green-900">Activate</button>
                        </form>
                        
                      @endif
                    @endif 
                    
                  </div>
                </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>

        
      </div>
</x-dashboard>
