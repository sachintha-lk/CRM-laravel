<x-dashboard>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>
    <div class="ml-5">
      <x-button>
        <a href="{{ route('users.create') }}">Add User</a>
      </x-button>
    </div>
    <div x-data="{showModal:false}">
        <div class="overflow-auto rounded-lg border border-gray-200 shadow-md m-5">

            <form class="w-1/3 float-right m-4" action="{{route('manageusers')}}">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" value="{{$search}}" id="default-search" name="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Users...">
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-pink-600 hover:bg-pink-700 focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                </div>
            </form>


            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 overflow-x-scroll min-w-screen">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="pl-6 py-4 font-medium text-gray-900">Id</th>
                    <th scope="col" class="px-4 py-4 font-medium text-gray-900">User</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Status</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Role</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Actions</th>
{{--                    <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>--}}
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">

                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="pl-6 py-2">{{ $user->id }}</td>

                        <th class="flex gap-3 px-6 py-2 font-normal text-gray-900">
                            <div class="relative h-10 w-10">
                                <img alt="{{ $user->name }}'s avatar}}"
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
                        <td class="px-6 py-2">
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
                        <td class="px-6 py-2">{{ $user->role->name }}</td>
                        <td class="px-6 py-2">
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

                                    @if($user->role()->first()->name == 'Customer')
                                        <a href="{{ route('users.show', $user->id) }}" class="bg-blue-50 p-1 px-2 rounded-md text-blue-600 hover:text-blue-900">View</a>
                                    @endif

                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="p-5">
                {{ $users->links() }}
            </div>



        </div>
        <div x-show="showModal" x-cloak class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!--
              Background backdrop, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div  class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <!--
                      Modal panel, show/hide based on modal state.

                      Entering: "ease-out duration-300"
                        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        To: "opacity-100 translate-y-0 sm:scale-100"
                      Leaving: "ease-in duration-200"
                        From: "opacity-100 translate-y-0 sm:scale-100"
                        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    -->
                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Deactivate account</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Deactivate</button>
                            <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-dashboard>
