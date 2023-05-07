<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{route('machines.index')}}">{{__('Back')}}</a> | {{ __('Edit') }} {{ __('Machine') }}
            - {{$machine->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h4 class="text-gray-800 dark:text-gray-200 mb-4">{{ __('Edit machine') }}</h4>
                <form method="POST" action="{{ route('machines.update', $machine->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" placeholder="{{ __('Machine\'s name') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('name', $machine->name) }}"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    <br>
                    <input type="text" name="description" placeholder="{{ __('Machine\'s description') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('description', $machine->description) }}"/>
                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
