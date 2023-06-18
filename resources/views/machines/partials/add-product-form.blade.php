<form id="addProduct" class="flex items-start gap-10 mb-10">
    @csrf
    <input type="hidden" name="machine_id" value="{{$machine->id}}">
    <div class="form-group w-full">
        <label for="product_id"
               class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Select product') }}</label>
        <select name="product_id"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            <option value="">{{__('Select a product')}}</option>
            @foreach($allProducts as $product)
                <option value="{{$product->id}}">{{ $product->name }}</option>
            @endforeach
        </select>
        <p class="mt-2 text-red-500 italic"></p>
    </div>
    <div class="form-group w-full">
        <label for="price" class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Price') }}</label>
        <input type="number" name="price" placeholder="{{ __('Product\'s price') }}"
               class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
               step="0.05"
               min="0.05"
               onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)"/>
        <p class="mt-2 text-red-500 italic"></p>
    </div>
    <div class="form-group w-full">
        <label for="stock" class="inline-block text-gray-800 dark:text-gray-200 mb-2">{{ __('Stock') }}</label>
        <input type="number" name="stock" placeholder="{{ __('Product\'s stock') }}"
               class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
               step="1"
               min="0"/>
        <p class="mt-2 text-red-500 italic"></p>
    </div>
    <x-action-button class="add-new-product" type="submit" class="mt-8 disabled:bg-gray-300">
        {{ __('Add product') }}
    </x-action-button>
</form>