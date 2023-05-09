<x-slot name="header">
    <tr>
        @foreach(['ID' => 'left','Name'=>'left','Price' =>'center','Image' =>'center', 'Allergies' => 'center', 'Actions' => 'right'] as $label => $text_align)
            <x-index-table-th>
                <x-slot name="label">{{$label}}</x-slot>
                <x-slot name="text_align">{{$text_align}}</x-slot>
            </x-index-table-th>
        @endforeach
    </tr>
</x-slot>
<x-slot name="body">
    @foreach($products as $product)
        <tr>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                {{$product->id}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                {{$product->name}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-center">
                {{$product->price}} &euro;
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 place-content-center">
                <div>
                    <img class="mx-auto" alt="{{$product->name}}" src="{{$product->image}}" width="50" height="50"/>
                </div>
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-center">
                <div class="flex justify-center items-center">
                    @foreach($product->allergies as $allergy)
                        <div class="bg-white dark:bg-gray-50 border-gray-300 rounded-full ml-3">
                            <img width="30" src="{{$allergy->image}}"/>
                        </div>
                    @endforeach
                </div>
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
                <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{route('products.edit',$product)}}">
                    {{__('Edit')}}
                </a>
            </td>
        </tr>
    @endforeach
</x-slot>