<div>
    <table class="tn abx acc text-gray-800 dark:text-gray-200">
        @foreach($products as $product)
            <tr>
                <td>
                    {{$product->id}}
                </td>
                <td>
                    {{$product->name}}
                </td>
                <td>
                    {{$product->price}}
                </td>
                <td>
                    <img alt="{{$product->name}}" src="{{$product->thumbnail}}" width="50" height="50"/>
                </td>
                <td>
                    <a href="{{route('products.edit',$product)}}">
                        {{__('Edit')}}
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$products->links()}}
</div>
