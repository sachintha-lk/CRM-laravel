<x-app-layout>
    
    

    <div class="py-12">
        <x-slot name="header">
            @isset($header)
                {{ $header }}
            @endisset
            
        </x-slot>
        
    
        {{-- Nav links should be passed from here  --}}
        <x-slot name="navlinks">
            <x-dashboard.navlinks />
        </x-slot>
    
        <div id="dashboard-grid" style="display: grid; grid-template-columns: 1fr 4fr;">
            {{-- Sidebar --}}
            <div class="">
                <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-gray-50 text-gray-800">
                    <div class="fixed flex flex-col top-0 left-0 w-64 bg-white h-full ">
                      <div class="flex items-center justify-center h-14 ">
                       
                      </div>
                      <div class="overflow-y-auto overflow-x-hidden flex-grow">
                        
                        <ul class="flex flex-col py-4 space-y-1">
                          <li class="px-5">
                            <div class="flex flex-row items-center h-8">
                              <div class="text-sm font-light tracking-wide text-gray-500">Menu</div>
                            </div>
                          </li>
                          <li>
                            <a href="/dashboard" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-pink-500 pr-6">
                              <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                              </span>
                              <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
                            </a>
                          </li>
                          <li>
                            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-pink-500 pr-6">
                              <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                              </span>
                              <span class="ml-2 text-sm tracking-wide truncate">Inbox</span>
                              <span class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-pink-500 bg-pink-50 rounded-full">New</span>
                            </a>
                          </li>
                          
                          <li>
                            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-pink-500 pr-6">
                              <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                              </span>
                              <span class="ml-2 text-sm tracking-wide truncate">Messages</span>
                            </a>
                          </li>
                          <li>
                            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-pink-500 pr-6">
                              <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                              </span>
                              <span class="ml-2 text-sm tracking-wide truncate">Notifications</span>
                              <span class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-500 bg-red-50 rounded-full">1.2k</span>
                            </a>
                          </li>
                          <li class="px-5">
                            <div class="flex flex-row items-center h-8">
                              <div class="text-sm font-light tracking-wide text-gray-500">Manage</div>
                            </div>
                          </li>
                          <li>
                            <a href="/dashboard/manageservices" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-pink-500 pr-6">
                              <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                              </span>
                              <span class="ml-2 text-sm tracking-wide truncate">Manage Services</span>
                            </a>
                          </li>
                          <li>
                            <a href="/dashboard/manageusers" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-pink-500 pr-6">
                              <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                              </span>
                              <span class="ml-2 text-sm tracking-wide truncate">Manage Users</span>
                             
                            </a>
                          </li>
                          
                        </ul>
                      </div>
                    </div>
                  </div>
            </div>

        {{-- <div class="max-w-9xl mx-auto sm:px-6 lg:px-8"> --}}
        <div class="">

            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> --}}
            @if (session('errormsg'))
                <div class="mb-4 font-medium text-sm text-red-600">
                    {{ session('errormsg') }}
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('success') }}
                </div>
            @endif

           
                    
                <div>
                    {{ $slot }}
                </div>
            </div>
        </div>
        </div>
    </div>

   <script>
   document.getElementById('sidebar-toggle').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('hidden');
  });

   </script>
    
    
</x-app-layout>
