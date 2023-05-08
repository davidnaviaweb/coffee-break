<div>
    <table class="tn abx acc text-gray-800 dark:text-gray-200">
        <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Price</td>
            <td>Image</td>
            <td>Allergies</td>
            <td>Actions</td>
        </tr>
        </thead>
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
                    <div class="flex">
                        @foreach($product->allergies as $allergy)
                            <div class="bg-white dark:bg-gray-50 border-gray-300 rounded-full ml-3">
                                <img width="30" src="{{$allergy->image}}"/>
                            </div>
                        @endforeach
                    </div>
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
