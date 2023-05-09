<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{route('products.index')}}">{{__('Back')}}</a> | {{ __('Edit') }} {{ __('Product') }}
            - {{$product->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h4 class="text-gray-800 dark:text-gray-200 mb-4">{{ __('Edit product') }}</h4>
                <form method="POST" action="{{ route('products.update', $product->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" placeholder="{{ __('Product\'s name') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('name', $product->name) }}"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    <br>
                    <input type="number" name="price" placeholder="{{ __('Product\'s price') }}"
                           class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                           value="{{ old('price',  $product->price) }}"
                           step="0.01"/>
                    <x-input-error :messages="$errors->get('price')" class="mt-2"/>
                    <select name="allergies[]" multiple
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        @foreach($allergies as $allergy)
                            <option value="{{$allergy->id}}"
                                    @if (in_array($allergy->id, $product->allergies)) selected @endif>{{ $allergy->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('allergies')" class="mt-2"/>
                    <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
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
