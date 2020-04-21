
<div id="print-area">
    <table class="table border ">
        <thead class="font-bold font-14 ">
        <tr>
            <th> {{__('site.product')}}</th>
            <th> {{__('site.quantity')}}</th>
            <th> {{__('site.price')}} $</th>
        </tr>
        </thead>

        <tbody >
        @foreach($products as $product)
            <tr>
                <td> {{$product->name}}</td>
                <td> {{$product->pivot->quantity}}</td>
                <td> {{number_format(($product->sale_price * $product->pivot->quantity) , 2)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h4>{{__('site.total')}} : <span >{{$order->totalPrice}} $</span></h4>
</div>
    <button class=" btn-info btn-sm btn-block text-center print-btn " ><i class="fa fa-print"></i> {{__('site.print')}}</button>

