<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Deals') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap gap-4 mt-10 m-5 ">

    
    @if($deals->count() > 0) 
        @foreach($deals as $deal)
        @if($deal->is_hidden == false)

        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow ">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $deal->name }}</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 ">{{ $deal->description }}</p>
            <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-500 rounded-lg hover:bg-pink-800 focus:ring-4 focus:outline-none focus:ring-pink-300 ">
                View Offer
                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
          </div>



        @endif
        @endforeach
    @else 
        <div class="flex justify-center">
            <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse">
                    <thead>
                        <tr>
                            <th
                                class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                No Deals Found
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    @endif
</div>
</x-app-layout>