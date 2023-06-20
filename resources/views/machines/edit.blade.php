<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a class="inline-flex text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-700"
               href="{{route('machines.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                </svg>
                <span class="ml-2">{{sprintf(__('Back to %s'), __('machines')) }} </span>
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h4 class="text-lg text-gray-800 dark:text-gray-200 mb-4">{{ __('Edit machine') }}</h4>
                <form method="POST" action="{{ route('machines.update', $machine->id) }}">
                    @method('PUT')
                    <label for="name"
                           class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Name') }}</label>
                    <input type="text" name="name" placeholder="{{ __('Machine\'s name') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('name', $machine->name) }}"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    <br>
                    <label for="description"
                           class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Description') }}</label>
                    <input type="text" name="description" placeholder="{{ __('Machine\'s description') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('description', $machine->description) }}"/>
                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    <br>
                    <label for="location_id"
                           class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Location') }}</label>
                    <select name="location_id"
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="">{{__('Select a location')}}</option>
                        @foreach($locations as $location)
                            <option value="{{$location->id}}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('location_id')" class="mt-2"/>
                    <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
                </form>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    <h4 class="text-lg text-gray-800 dark:text-gray-200 mb-4">{{__('Add product')}}</h4>
                    @include('machines.partials.add-product-form')
                    <hr class="mb-10">
                    <h4 class="text-lg text-gray-800 dark:text-gray-200 mb-">{{__('Products in this machine')}}</h4>
                    <x-index-table id="machine-products-table">
                        @include('machines.partials.machine-products-table')
                    </x-index-table>
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    @include('machines.partials.delete-machine-form')
                </div>
            </div>
        </div>
    </div>
    <x-modal id="edit-machine-product" name="edit-machine-product" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                {{ __('Edit product') }} <span class="name"></span>
            </h2>
            <div id="form-container" class="flex-col">
                <form class="flex items-start gap-10 mb-10">
                    @csrf
                    <input type="hidden" name="machine_id" value="">
                    <input type="hidden" name="product_id" value="">
                    <div class="form-group w-full">
                        <label for="price"
                               class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Price') }}</label>
                        <input type="number" name="price" placeholder="{{ __('Product\'s price') }}"
                               class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                               step="0.05"
                               min="0.05"
                               onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)"/>
                        <p class="mt-2 text-red-500 italic"></p>
                    </div>
                    <div class="form-group w-full">
                        <label for="stock"
                               class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Stock') }}</label>
                        <input type="number" name="stock" placeholder="{{ __('Product\'s stock') }}"
                               class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                               step="1"
                               min="0"/>
                        <p class="mt-2 text-red-500 italic"></p>
                    </div>
                </form>
                <div class="mt-4 flex justify-end">
                    <x-secondary-button class="cancel" x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <x-confirm-button class="update-product ml-3">
                        {{ __('Save') }}
                    </x-confirm-button>
                </div>
            </div>
        </div>
    </x-modal>
    @vite(['resources/js/machines-edit.js'])
</x-app-layout>
