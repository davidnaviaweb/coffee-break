<x-slot name="header">
    @foreach([''=> 'center','Name'=>'left','Price' =>'right','Stock' =>'right','Actions' => 'right'] as $label => $text_align)
        <x-index-table-th>
            <x-slot name="label">{{$label}}</x-slot>
            <x-slot name="text_align">{{$text_align}}</x-slot>
        </x-index-table-th>
    @endforeach
</x-slot>
<x-slot name="body">
    @foreach($products as $product)
        <tr>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200">
                <img class="fill-current text-gray-500 mr-2 w-10 h-10 rounded-full shadow-xl"
                     src="{{url($product->image)}}">
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                {{$product->name}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
                {{$product->pivot->price}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
                {{$product->pivot->stock}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
                Pene
            </td>
        </tr>
    @endforeach
</x-slot>
