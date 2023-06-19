<x-slot name="header">
    @foreach(['Date'=>'left', 'Machine'=>'left','Type' =>'center','Data' => 'center'] as $label => $text_align)
        <x-index-table-th>
            <x-slot name="label">{{$label}}</x-slot>
            <x-slot name="text_align">{{$text_align}}</x-slot>
        </x-index-table-th>
    @endforeach
</x-slot>
<x-slot name="body">
    @foreach($events as $event)
        <?php
        /**
         * @var Event $event
         */
        $machine = App\Models\Machine::find($event->machine_id)
        ?>
        <tr>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                {{$event->created_at}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-left">
                <a class="inline-flex items-center font-medium text-blue-600 dark:text-blue-500 hover:underline"
                   href="{{route('machines.edit',$machine->id)}}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                    </svg>
                    <span class="ml-4">{{$machine->name}}</span>
                </a>
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-center">
                {{ucfirst($event->type)}}
            </td>
            <td class="border-b dark:border-slate-600 font-normal p-4 text-slate-400 dark:text-slate-200 text-center">
                {{\App\Http\Controllers\EventController::format_data($event)}}
            </td>
        </tr>
    @endforeach
</x-slot>