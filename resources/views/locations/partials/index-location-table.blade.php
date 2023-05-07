<div>
    <table class="tn abx acc text-gray-800 dark:text-gray-200">
        @foreach($locations as $location)
            <tr>
                <td>
                    {{$location->id}}
                </td>
                <td>
                    {{$location->name}}
                </td>
                <td>
                    {{$location->description}}
                </td>
                <td>
                    {{$location->address}}
                </td>
                <td>
                    {{$location->city}}
                </td>
                <td>
                    {{$location->state}}
                </td>
                <td>
                    {{$location->country}}
                </td>
                <td>
                    <a href="{{route('locations.edit',$location)}}">
                        {{__('Edit')}}
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$locations->links()}}
</div>
