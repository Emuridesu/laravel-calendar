<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                @foreach($users as $user)
                <a href="{{ route('user-calendar', 'id'=>Auth::)}}" class="text-blue-500">{{ $user->id }} {{ $user->name }}</a>
                <br>

                @endforeach
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
