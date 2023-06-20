<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Locations') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-notification-success :message="session('success') ?? ''"></x-notification-success>
            <x-notification-error :message="session('error') ?? ''"></x-notification-error>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h4 class="text-lg text-gray-800 dark:text-gray-200 mb-4">{{ __('Create new location') }}</h4>
                <form method="POST" action="{{ route('locations.store') }}">
                    @csrf
                    <label for="name"
                           class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Name') }}</label>
                    <input type="text" name="name" placeholder="{{ __('Location\'s name') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('name') }}"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    <br>
                    <label for="description"
                           class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Description') }}</label>
                    <input type="text" name="description" placeholder="{{ __('Location\'s description') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('description') }}"/>
                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    <br>
                    <label for="location"
                           class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Location') }}</label>
                    <input name="location" type="text" id="search-location-input" placeholder="{{__('Search location')}}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    />
                    <div id="search-location-container" class="block w-full"></div>
                    <br>
                    <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
                </form>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="text-gray-800 dark:text-gray-200">
                    <x-index-table>
                        @include('locations.partials.index-location-table')
                    </x-index-table>
                    {{ $locations->links() }}
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
    </script>
</x-app-layout>
