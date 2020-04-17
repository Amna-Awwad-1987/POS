@extends('layouts.dashboard.app')
@section('title')
    {{__('site.add_order')}}
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
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.add_order')}}</li>
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
                                        <div class="card-actions bg-light-danger" >
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
                                                                    <tr>
                                                                        <td>{{$product->name}}</td>
                                                                        <td>{{$product->sale_price}}</td>
                                                                        <td>{{$product->stock}}</td>
                                                                        <td>
                                                                            <a id ="product-{{$product->id}}"
                                                                               data-name ="{{$product->name}}"
                                                                               data-id ="{{$product->id}}"
                                                                               data-price ="{{$product->sale_price}}"
                                                                               class="btn btn-success btn-sm add_product_btn">
                                                                               <i class="fa fa-plus"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
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
                        <div class="card border-success">
                            <div class="card-header bg-success font-16">
                                {{__('site.orders')}}
                                <div class="card-actions">
                                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                </div>
                            </div>
                            <div class="card-body collapse show">
                                <form action="{{route('dashboard.clients.orders.store', $client->id)}}" method="post">
                                   @csrf
                                    {{method_field('post')}}
                                    <div class="table-responsive">
                                        <table class="table border ">
                                            @include('partial.errors')
                                            <input type="hidden" name="products[]" value="{{$client->id}}">

                                            <thead class="font-bold font-14 ">
                                            <tr>
                                                <th> {{__('site.product')}}</th>
                                                <th> {{__('site.unit_price')}}</th>
                                                <th> {{__('site.quantity')}}</th>
                                                <th> {{__('site.price')}}</th>
                                                <th> </th>
                                            </tr>
                                            </thead>
                                            <tbody class="border order-list ">

                                            </tbody>
                                        </table>
                                    </div>

                                    <h4>{{__('site.total')}} : <span class="total-price">0</span></h4>
                                    <button class=" btn-info btn-sm btn-block text-center disabled " id="add-order-btn" ><i class="fa fa-plus"></i>{{__('site.add_order')}}</button>
                                </form>
                            </div>
                        </div>

                    </div>
                 </div>
            </div>
        </div>
    </div>
@endsection
