<x-slot name="header">
    @foreach([''=> 'center', 'Name'=>'left','Price' =>'right','Stock' =>'right','Actions' => 'right'] as $label => $text_align)
        <x-index-table-th>
            <x-slot name="label">{{$label}}</x-slot>
            <x-slot name="text_align">{{$text_align}}</x-slot>
        </x-index-table-th>
    @endforeach
</x-slot>
<x-slot name="body">
    @foreach($products as $product)
        <tr data-product="{{$product->id}}" data-machine="{{$machine->id}}" data-csrf="{{csrf_token()}}">
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200">
                <img class="fill-current text-gray-500 mr-2 w-10 h-10 rounded-full shadow-xl"
                     src="{{url($product->image)}}">
            </td>
            <td class="name border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                {{$product->name}}
            </td>
            <td class="price border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
                {{number_format($product->pivot->price, 2, '.', '')}}
            </td>
            <td class="stock border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
                {{$product->pivot->stock}}
            </td>
            <td class="actions border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
                <a class="edit font-medium text-blue-600 dark:text-blue-500 hover:underline mr-4" href="#"
                   data-product="{{$product->id}}" data-machine="{{$machine->id}}" data-csrf="{{csrf_token()}}"
                   x-on:click.prevent="$dispatch('open-modal', 'edit-machine-product')">
                    {{__('Edit')}}
                </a>
                <a class="delete font-medium text-blue-600 dark:text-blue-500 hover:underline" href="#"
                   data-product="{{$product->id}}" data-machine="{{$machine->id}}" data-csrf="{{csrf_token()}}">
                    {{__('Delete')}}
                </a>
            </td>
        </tr>
    @endforeach
    <template id="product-row">
        <tr data-product="" data-machine="" data-csrf="">
            <td id="product-row-image"
                class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200">
                <img class="fill-current text-gray-500 mr-2 w-10 h-10 rounded-full shadow-xl"
                     src="">
            </td>
            <td id="product-row-name"
                class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
            </td>
            <td id="product-row-price"
                class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
            </td>
            <td id="product-row-stock"
                class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
            </td>
            <td id="product-row-actions"
                class="actions border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
                <a class="edit font-medium text-blue-600 dark:text-blue-500 hover:underline mr-4" href="#"
                   x-on:click.prevent="$dispatch('open-modal', 'edit-machine-product')">
                {{__('Edit')}}
                </a>
                <a class="edit font-medium text-blue-600 dark:text-blue-500 hover:underline" href="#"
                   data-product="" data-machine="{{$machine->id}}" data-csrf="">
                    {{__('Delete')}}
                </a>
            </td>
        </tr>
    </template>
</x-slot>

