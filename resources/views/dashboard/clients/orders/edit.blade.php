@extends('layouts.dashboard.app')
@section('title')
    {{__('site.edit_order')}}
@endsection
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{__('site.orders')}}</h4>
                <div class="d-flex align-items-center">
                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.clients.index')}}">{{__('site.clients')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.edit_order')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class=" row">
            <div class=" col-lg-12 ">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card border-success">
                            <div class="card-header bg-success font-16">
                                {{__('site.categories')}}
                                <div class="card-actions">
                                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                </div>
                            </div>
                            <div class="card-body collapse show">
                                @foreach($categories as $category)
                                    <div class="card" >
                                        <div class="card-actions bg-light-success" >
                                            <a class="font-18" data-action="collapse" ><i class="ti-plus"></i> {{$category->name}}</a>
                                        </div>
                                        <div class="card-body collapse">
                                            @if($category->products->count()>0)
                                                <div class="table-responsive">
                                                    <table class="table border ">
                                                        <thead class="font-weight-bolder ">
                                                        <tr>
                                                            <th>{{__('site.name')}}</th>
                                                            <th>{{__('site.sale_price')}}</th>
                                                            <th>{{__('site.stock')}}</th>
                                                            <th>{{__('site.add')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="border ">
                                                        @foreach($category->products as $product)
                                                            @if($product->stock >0 )
                                                                <tr>
                                                                    <td>{{$product->name}}</td>
                                                                    <td>{{$product->sale_price}} $</td>
                                                                    <td class="check-stock" data-id ="{{$product->id}}" data-stock="{{$product->stock}}">{{$product->stock}}</td>
                                                                    @if(auth()->user()->hasPermission('create_orders'))
                                                                        <td>
                                                                            <a id="product-{{$product->id}}"
                                                                               data-name ="{{$product->name}}"
                                                                               data-id ="{{$product->id}}"
                                                                               data-price ="{{$product->sale_price}}"
                                                                               class="btn {{in_array($product->id, $order->products->pluck('id')->toArray()) ? 'btn-default disabled' : 'btn-success'}} btn-sm add_product_btn">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            <a  class="btn btn-success btn-sm disabled">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                        </td>
                                                                    @endif

                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <h4>{{__('site.no_data_found')}}</h4>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-6">
                        {{--**edit order**--}}

                        <div class="card border-warning">
                            <div class="card-header bg-warning font-16">
                                {{__('site.edit_order')}}
                                <div class="card-actions">
                                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                </div>
                            </div>
                            <div class="card-body collapse show">
                                <form action="{{route('dashboard.clients.orders.update',[$client->id , $order->id] )}}" method="post">
                                    @csrf
                                    {{method_field('put')}}
                                    <div class="table-responsive">
                                        <table class="table border ">
                                            @include('partial.errors')
                                            {{--                                            <input type="hidden" name="client_id" value="{{$client->id}}">--}}

                                            <thead class="font-bold font-14 ">
                                            <tr>
                                                <th> {{__('site.product')}}</th>
                                                <th> {{__('site.unit_price')}} $</th>
                                                <th> {{__('site.quantity')}}</th>
                                                <th> {{__('site.price')}} $</th>
                                                <th> </th>
                                            </tr>
                                            </thead>
                                            <tbody class="border order-list ">
                                                @foreach($order->products as $product)
                                                    <tr>
                                                        <td>{{$product->name}}</td>
                                                        <td>{{number_format($product->sale_price , 2)}}</td>
                                                        <td><input type="number" name="products[{{$product->id}}][quantity]" data-price="{{number_format($product->sale_price, 2)}}" class="form-control input-group-sm product-quantity" min="1" value="{{$product->pivot->quantity}}"></td>
                                                        <td class="product-price">{{number_format($product->sale_price *$product->pivot->quantity,2)}}</td>
                                                        <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="{{$product->id}}"><span class="fa fa-trash"></span></button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <h4>{{__('site.total')}} : <span class="total-price">{{number_format($order->totalPrice , 2)}} $</span></h4>
                                    <button class=" btn-warning btn-sm btn-block text-center " id="form-btn" ><i class="fa fa-edit"></i>{{__('site.edit_order')}}</button>
                                </form>
                            </div>
                        </div>
                        {{--**previous orders**--}}
                        @if($orders->count() > 0)
                            <div class="card border-success">
                                <div class="card-header bg-success font-16">
                                    {{__('site.previous_orders')}} <small style="color: red"> {{' '.$orders->total()}}</small>
                                    <div class="card-actions">
                                        <a class="" data-action="collapse"><i class="ti-plus"></i></a>
                                        <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                    </div>
                                </div>
                                <div class="card-body collapse">
                                    @foreach($orders as $order)
                                        <div class="card" >
                                            <div class="card-actions bg-light-success" >
                                                <a class="font-18" data-action="collapse" >{{$order->created_at->toFormattedDateString()}}<i class="ti-plus"></i> </a>
                                            </div>
                                            <div class="card-body collapse">
                                                @if($order->products->count()>0)
                                                    <div class="table-responsive">
                                                        <table class="table border ">
                                                            <thead class="font-weight-bolder ">
                                                            <tr>
                                                                <th>{{__('site.name')}}</th>
                                                                <th>{{__('site.unit_price')}}</th>
                                                                <th>{{__('site.quantity')}}</th>
                                                                <th>{{__('site.price')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="border ">
                                                            @foreach($order->products as $product)
                                                                <tr>
                                                                    <td>{{$product->name}}</td>
                                                                    <td>{{number_format($product->sale_price , 2)}} $</td>
                                                                    <td>{{$product->pivot->quantity}} $</td>
                                                                    <td>{{number_format($product->sale_price *$product->pivot->quantity,2)}} $</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                        <div class="card-footer bg-light-success font-16">
                                                            <h4>{{__('site.total_payment')}} : <span class="total-price">{{number_format($order->totalPrice , 2)}} $</span></h4>

                                                        </div>
                                                    </div>
                                                @else
                                                    <h4>{{__('site.no_data_found')}}</h4>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
