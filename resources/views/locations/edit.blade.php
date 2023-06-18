<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a class="inline-flex text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-700" href="{{route('locations.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                <span class="ml-2">{{sprintf(__('Back to %s'), __('locations')) }} </span>
            </a>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h4 class="text-gray-800 dark:text-gray-200 mb-4">{{ __('Edit location') }}</h4>
                <form method="POST" action="{{ route('locations.update', $location->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" placeholder="{{ __('Location\'s name') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('name', $location->name) }}"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    <br>
                    <input type="text" name="description" placeholder="{{ __('Location\'s description') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('description', $location->description) }}"/>
                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    <br>
                    <input type="text" name="address" placeholder="{{ __('Location\'s address') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('address', $location->address) }}"/>
                    <x-input-error :messages="$errors->get('address')" class="mt-2"/>
                    <br>
                    <input type="text" name="city" placeholder="{{ __('Location\'s city') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('city', $location->city) }}"/>
                    <x-input-error :messages="$errors->get('city')" class="mt-2"/>
                    <br>
                    <input type="text" name="country" placeholder="{{ __('Location\'s country') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('country', $location->country) }}"/>
                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
                </form>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('locations.partials.delete-location-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
