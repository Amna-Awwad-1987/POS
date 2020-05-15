@extends('layouts.dashboard.app')
@section('title')
    {{__('site.orders')}}
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
                                <a href="{{route('dashboard.welcome')}}">{{__('site.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.orders')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
        <!-- Column -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-title">
                    <h5 class="p-15 " style="background-color:#9fe69e">{{__('site.orders')}}<small style="color: red">{{' '.$orders->total()}}</small></h5>
                </div>
                <div class="card-body">
                    <form action="{{route('dashboard.orders.index')}}" method="get">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="search" class="form-control" placeholder="{{__('site.search')}}" value="{{request()->search}}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-search"></i>{{' '.__('site.search')}}</button>
                            </div>
                        </div>
                        <br>
                    </form>
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table border-success">
                                <thead class="bg-success text-white">
                                <tr>
                                    <th>#</th>
                                    <th>{{__('site.name')}}  {{__('site.client')}}</th>
                                    <th>{{__('site.total_payment')}} $</th>
                                    <th>{{__('site.created_at')}}</th>
                                    <th>{{__('site.status')}}</th>
                                    <th>{{__('site.action')}}</th>
                                </tr>
                                </thead>
                                <tbody class="border border-success">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($orders as $index => $order)
                                    <tr>
                                        <td>{{$i++ +(5*($orders->currentPage()-1))}}</td>
                                        <td><a href="{{route('dashboard.clients.index',$order->client->name)}}"  > {{$order->client->name}}</a>
                                        </td>
                                        <td>{{number_format($order->totalPrice , 2)}}</td>
                                        <td>{{$order->created_at->toFormattedDateString()}}</td>
                                        <td>{{"جاري التحضير"}}</td>
                                        <td>
                                            @if(auth()->user()->hasPermission('read_orders'))
                                                <button data-url="{{route('dashboard.orders.products',$order->id)}}" data-method="get" class="btn btn-info btn-sm order-products"><i class="fa fa-list"></i>{{' '.__('site.read')}}</button>
                                            @else
                                                <button  class="btn btn-info btn-sm disabled"><i class="fa fa-list"></i>{{' '.__('site.read')}}</button>
                                            @endif

                                            @if(auth()->user()->hasPermission('edit_orders'))
                                                <a href="{{route('dashboard.clients.orders.edit' ,['client'=>$order->client->id ,'order'=>$order->id] )}}" class="btn btn-warning btn-sm" title="{{__('site.edit')}}"><i class="fa fa-edit"></i></a>
                                            @else
                                                <a href="#" disabled class="btn btn-warning btn-sm " ><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_orders'))
                                                <form action="{{route('dashboard.orders.destroy',$order->id)}}" method="post" class="d-inline-block">
                                                    @csrf
                                                    {{method_field('delete')}}
                                                    <button type="submit" class=" btn btn-danger delete btn-sm " title="{{' '.__('site.delete')}}" id="delete"><i class="fa fa-trash"></i></button>
                                                </form>
                                            @else
                                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class=" pagination pagination-md m-0  float-left">{{$orders->appends(request()->query())->links()}}</div>
                        </div>
                    @else
                        <h2>{{__('site.no_data_found')}}</h2>
                    @endif
                </div>

                </div>
            </div>
        <div class="col-md-4 ">
                <div class="card">
                    <div class="card-title">
                        <h5 class="p-15 " style="background-color:#9fe69e">{{__('site.show_products')}}<small style="color: red"></small></h5>
                    </div>
                    <div class="card-body">

                        <div style="display: none; flex-direction: column; align-items: center;" id="loading">
                            <div class="loader"></div>
                            <p style="margin-top: 10px">@lang('site.loading')</p>
                        </div>

                        <div id="order-product-list">

                        </div><!-- end of order product list -->

                    </div><!-- end of box body -->
                </div>
            </div>
        </div>
    </div>


@endsection
@section('jsFooter')
    <script type="text/javascript">
        $(document).ready(function(){
            $( "#confirm_delete" ).submit(function( event ) {
                event.preventDefault();
                swal({
                    title: 'Are you sure?',
                    text: "Please click confirm to delete this item",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true
                }).then(function() {
                    $("#confirm_delete").off("submit").submit();
                }, function(dismiss) {
                    // dismiss can be 'cancel', 'overlay',
                    // 'close', and 'timer'
                    if (dismiss === 'cancel') {
                        swal('Cancelled', 'Delete Cancelled :)', 'error');
                    }
                })
            });
        });
    </script>
@endsection