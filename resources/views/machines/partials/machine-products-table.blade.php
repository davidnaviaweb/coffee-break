<h4 class="text-gray-800 dark:text-gray-200 mb-4">{{__('Add product')}}</h4>
<form id="addProduct" class="flex items-start gap-10 mb-10" action="{{ route('machines.addProduct') }}">
    @csrf
    <div class="form-group w-full">
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
        <input type="number" name="price" placeholder="{{ __('Product\'s price') }}"
               class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
               step="0.01"
               min="0"/>
        <p class="mt-2 text-red-500 italic"></p>
    </div>
    <div class="form-group w-full">
        <input type="number" name="stock" placeholder="{{ __('Product\'s stock') }}"
               class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
               step="1"
               min="0"/>
        <p class="mt-2 text-red-500 italic"></p>
    </div>
    <x-action-button class="add-new-product" type="submit" class="disabled:bg-gray-300">
        {{ __('Add product') }}
    </x-action-button>
</form>
<hr class="mb-10">
<h4 class="text-gray-800 dark:text-gray-200 mb-">{{__('Products in this machine')}}</h4>
<x-index-table>
    <x-slot name="header">
        @foreach([''=> 'center','ID' => 'left','Name'=>'left','Price' =>'right','Actions' => 'right'] as $label => $text_align)
            <x-index-table-th>
                <x-slot name="label">{{$label}}</x-slot>
                <x-slot name="text_align">{{$text_align}}</x-slot>
            </x-index-table-th>
        @endforeach
    </x-slot>
    <x-slot name="body">
        @if(!empty($products->items))
            @foreach($products as $product)
                <tr>
                    <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200">
                        <img class="fill-current text-gray-500 mr-2 w-20 h-20 rounded-full shadow-xl"
                             src="{{url($product->image)}}">
                    </td>
                    <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                        {{$product->id}}
                    </td>
                    <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                        {{$product->name}}
                    </td>
                    <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                        {{$product->price}}
                    </td>
                    <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                        {{$product->stock}}
                    </td>
                </tr>
            @endforeach
        @endif
    </x-slot>
</x-index-table>
