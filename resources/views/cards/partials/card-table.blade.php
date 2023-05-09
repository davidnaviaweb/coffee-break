<x-slot name="header">
    @foreach(['ID' => 'left','Serial Number'=>'center','Balance' =>'right','Status' => 'center','Actions' => 'right'] as $label => $text_align)
        <x-index-table-th>
            <x-slot name="label">{{$label}}</x-slot>
            <x-slot name="text_align">{{$text_align}}</x-slot>
        </x-index-table-th>
    @endforeach
</x-slot>
<x-slot name="body">
    @foreach($cards as $card)
        <tr>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                {{$card->id}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-center">
                {{$card->serial_number}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
                {{$card->balance}} &euro;
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-center">
                {{$card->status}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
                <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{route('cards.edit',$card)}}">
                    {{__('Edit')}}
                </a>
            </td>
        </tr>
    @endforeach
</x-slot>