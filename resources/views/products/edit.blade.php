<x-app-layout>
    <x-slot name="header">
        <h2 class="inline-flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a class="inline-flex text-blue-600 dark:text-blue-500 hover:text-blue-700 dark:hover:text-blue-700" href="{{route('products.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                <span class="ml-2">{{sprintf(__('Back to %s'), __('products')) }} </span>
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h4 class="text-gray-800 dark:text-gray-200 mb-4">{{ __('Edit product') }}</h4>
                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex align-items-start">
                        <img class="fill-current text-gray-500 mr-2 w-20 h-20 rounded-full shadow-xl"
                             src="{{url($product->image)}}">
                        <div class="w-full ml-4">
                            <input type="text" name="name" placeholder="{{ __('Product\'s name') }}"
                                   class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                   value="{{ old('name', $product->name) }}"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                            <br>
                            <input type="file" name="image"
                                   class="text-gray-800 dark:text-gray-200 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                   accept=".jpg,.png"
                            />
                            <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                            <br>
                            <select name="allergies[]" multiple
                                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                @foreach($allergies as $allergy)
                                    <option value="{{$allergy->id}}"
                                            @if (in_array($allergy->id, $product->allergies)) selected @endif>{{ $allergy->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('allergies')" class="mt-2"/>
                            <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('products.partials.delete-product-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
