<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a class="inline-flex text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-700"
               href="{{route('locations.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                </svg>
                <span class="ml-2">{{sprintf(__('Back to %s'), __('locations')) }} </span>
            </a>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h4 class="text-lg text-gray-800 dark:text-gray-200 mb-4">{{ __('Edit location') }}</h4>
                <form method="POST" action="{{ route('locations.update', $location->id) }}">
                    @csrf
                    @method('PUT')
                    <label for="name"
                           class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Name') }}</label>
                    <input type="text" name="name" placeholder="{{ __('Location\'s name') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('name', $location->name) }}"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    <br>
                    <label for="description"
                           class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Description') }}</label>
                    <input type="text" name="description" placeholder="{{ __('Location\'s description') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('description', $location->description) }}"/>
                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    <br>
                    <div class="flex gap-2">
                        <div class="flex-col w-full">
                            <label for="address"
                                   class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Address') }}</label>
                            <input type="text" name="address" placeholder="{{ __('Location\'s address') }}"
                                   class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                   value="{{ $location->address }}"/>
                        </div>
                        <div class="flex-col w-auto">
                            <label for="city"
                                   class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('City') }}</label>
                            <input type="text" name="city"
                                   class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                   value="{{ $location->city }}"/>
                        </div>
                        <div class="flex-col w-auto">
                            <label for="zip"
                                   class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('ZIP') }}</label>
                            <input type="text" name="zip"
                                   class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                   value="{{ $location->zip }}"/>
                        </div>
                        <div class="flex-col w-auto">
                            <label for="country"
                                   class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Country') }}</label>
                            <input type="text" name="country"
                                   class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                   value="{{ $location->country }}"/>
                        </div>
                    </div>
                    <br>
                    <label for="location"
                           class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __(' Update location') }}</label>
                    <input name="location" type="text" id="search-location-input"
                           placeholder="{{__('Search location')}}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    />
                    <div id="search-location-container" class="block w-full"></div>
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function () {
            $('#search-location-input').autocomplete({
                appendTo: '#search-location-container',
                classes: {
                    "ui-autocomplete": 'w-auto bg-gray-100 border-gray-300 rounded-md shadow-sm',
                    "ui-menu-item": 'hover:bg-blue-500 hover:text-gray-200'
                },
                source: function (request, response) {
                    $.ajax({
                        url: "{{route('locations.search')}}",
                        dataType: 'json',
                        data: {
                            query: request.term
                        },
                        success: function (data) {
                            response(data)
                            console.log(data)
                        }
                    });
                },
                minLength: 3,
                delay: 250,
                select: function (event, ui) {
                    const label = ui.item.label;
                    const value = ui.item.value;
                    //store in session
                    document.valueSelectedForAutocomplete = value
                }
            }).data("ui-autocomplete")._renderItem = function (ul, item) {
                ul.addClass('customClass'); //Ul custom class here

                return $("<li></li>")
                    .addClass('p-2 hover:bg-blue-500 hover:text-gray-200 rounded-md') //item based custom class to li here
                    .append("<a href='#'>" + item.label + "</a>")
                    .data("ui-autocomplete-item", item)
                    .appendTo(ul);
            };
        });
        </x-app-layout>
