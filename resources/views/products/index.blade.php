<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-notification-success :message="session('success') ?? ''"></x-notification-success>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h4 class="text-lg text-gray-800 dark:text-gray-200 mb-4">{{ __('Create new product') }}</h4>
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="name"
                           class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Name') }}</label>
                    <input type="text" name="name" placeholder="{{ __('Product\'s name') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('name') }}"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    <br>
                    <label for="image"
                           class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Image') }}</label>
                    <input type="file" name="image"
                           class="block w-full text-gray-800 dark:text-gray-200 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           accept="image/*"
                    />
                    <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                    <br>
                    <label for="allergies[]"
                           class="inline-block text-gray-800 dark:text-gray-200 mb-4">{{ __('Allergies/Intolerances') }}</label>
                    <div class="grid grid-cols-7 w-full">
                        <style>
                            .allergy input:checked + div {
                                --tw-bg-opacity: 1;
                                background-color: rgb(37 99 235 / var(--tw-bg-opacity));
                            }
                        </style>
                        @foreach($allergies as $allergy)
                            <label class="allergy flex items-center text-gray-800 dark:text-gray-200 mb-4 cursor-pointer">
                                <input class="absolute ml-6" type="checkbox" name="allergies[]"
                                       value="{{$allergy->id}}">
                                <div class="z-50 flex items-center p-2 rounded-md w-full mr-4 transition-all duration-100 ease-out">
                                    <img class="mr-3 rounded-full w-10 h-10 bg-gray-200 border-gray-300"
                                         src="{{$allergy->image}}"
                                         title="{{ $allergy->name }}"/> {{ $allergy->name }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
                </form>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="text-gray-800 dark:text-gray-200">
                    <x-index-table>
                        @include('products.partials.product-table')
                    </x-index-table>
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
