<x-slot name="header">
    <tr>
        <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-left">
            ID
        </th>
        <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-left">
            Name
        </th>
        <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-center">
            Price
        </th>
        <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-center">
            Image
        </th>
        <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-center">
            Allergies
        </th>
        <th class="border-b dark:border-slate-600 font-medium p-4 text-slate-400 dark:text-slate-200 text-right">
            Actions
        </th>
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
                {{$product->price}}
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
                <a href="{{route('products.edit',$product)}}">
                    {{__('Edit')}}
                </a>
            </td>
        </tr>
    @endforeach
</x-slot>