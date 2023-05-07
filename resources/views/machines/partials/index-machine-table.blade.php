<div>
    <table class="tn abx acc text-gray-800 dark:text-gray-200">
        @foreach($machines as $machine)
            <tr>
                <td>
                    {{$machine->id}}
                </td>
                <td>
                    {{$machine->name}}
                </td>
                <td>
                    {{$machine->description}}
                </td>
                <td>
                    <a href="{{route('machines.edit',$machine)}}">
                        {{__('Edit')}}
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$machines->links()}}
</div>
