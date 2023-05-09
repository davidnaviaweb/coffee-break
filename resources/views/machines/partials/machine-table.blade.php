<x-slot name="header">
    @foreach(['ID' => 'left','Name'=>'left','Description' =>'left','Location' =>'center','Actions' => 'right'] as $label => $text_align)
        <x-index-table-th>
            <x-slot name="label">{{$label}}</x-slot>
            <x-slot name="text_align">{{$text_align}}</x-slot>
        </x-index-table-th>
    @endforeach
</x-slot>
<x-slot name="body">
    @foreach($machines as $machine)
        <tr>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                {{$machine->id}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                {{$machine->name}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                {{$machine->description}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-center">
                {{$machine->description}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-right">
                <a href="{{route('machines.edit',$machine)}}">
                    {{__('Edit')}}
                </a>
            </td>
        </tr>
    @endforeach
</x-slot>