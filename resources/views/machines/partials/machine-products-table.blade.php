<h4 class="text-gray-800 dark:text-gray-200 mb-4">{{__('Products in this machine')}}</h4>

<x-slot name="header">
    @foreach(['ID' => 'left','Name'=>'left','Description' =>'left','Location' =>'center','Actions' => 'right'] as $label => $text_align)
        <x-index-table-th>
            <x-slot name="label">{{$label}}</x-slot>
            <x-slot name="text_align">{{$text_align}}</x-slot>
        </x-index-table-th>
    @endforeach
</x-slot>
<x-slot name="body">
    <template id="machine-product-template">
        <tr>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                <select name="product_id"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="">{{__('Select a product')}}</option>
                    @foreach($allProducts as $product)
                        <option value="{{$product->id}}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                <input type="number" name="price" placeholder="{{ __('Product\'s price') }}"
                       class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                       step="0.01"
                       min="0"/>
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                <input type="number" name="stock" placeholder="{{ __('Product\'s stock') }}"
                       class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                       step="1"
                       min="0"/>
            </td>
        </tr>
    </template>
    @if(!empty($products))
        @foreach($products as $product)
            <tr>
                <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                    {{$product->id}}
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
<x-action-button>
    {{ __('Add product') }}
</x-action-button>