@extends('layouts.dashboard.app')
@section('title')
    {{__('site.clients')}}
@endsection
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{__('site.clients')}}</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.clients')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="box-title p-15">{{__('site.clients')}}<small style="color: red">{{' '.$clients->total()}}</small></h5>
                        <form action="{{route('dashboard.clients.index')}}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="{{__('site.search')}}" value="{{request()->search}}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-search"></i>{{' '.__('site.search')}}</button>
                                    @if(auth()->user()->hasPermission('create_clients'))
                                        <a href="{{route('dashboard.clients.create')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>{{' '.__('site.add')}}</a>
                                    @else
                                        <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-plus"></i>{{' '.__('site.add')}}</a>
                                    @endif

                                </div>
                            </div>
                            <br>
                        </form>
                        @if($clients->count() > 0)
                          <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-success text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('site.name')}}</th>
                                        <th>{{__('site.address')}}</th>
                                        <th>{{__('site.mobile')}}</th>
                                        <th>{{__('site.mobile2')}}</th>
                                        <th>{{__('site.add_order')}}</th>
                                        <th>{{__('site.action')}}</th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 1;
                                    $locale = app()->getLocale();
                                @endphp
                                <tbody class="border border-success">
                                    @foreach($clients as $index => $client)
                                        <tr>
                                    <td>{{$i++ +(4*($clients->currentPage()-1))}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->address}}</td>
                                    <td>{{$client->mobile}}</td>
                                    <td>{{$client->mobile2}}</td>
                                    <td>
                                        @if(auth()->user()->hasPermission('create_orders'))
                                            <a href="{{route('dashboard.clients.orders.create',$client->id)}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>{{' '.__('site.add')}}</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-plus"></i>{{' '.__('site.add')}}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(auth()->user()->hasPermission('edit_clients'))
                                            <a href="{{route('dashboard.clients.edit',$client->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>{{' '.__('site.edit')}}</a>
                                        @else
                                            <a href="#" class="btn btn-warning btn-sm disabled"><i class="fa fa-edit"></i>{{' '.__('site.edit')}}</a>
                                        @endif
                                        @if(auth()->user()->hasPermission('delete_clients'))
                                            <form action="{{route('dashboard.clients.destroy',$client->id)}}" method="post" class="d-inline-block">
                                                @csrf
                                                {{method_field('delete')}}
                                                <button type="submit" class=" btn btn-danger delete btn-sm " id="delete"><i class="fa fa-trash"></i>{{' '.__('site.delete')}}</button>
                                            </form>
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>{{' '.__('site.delete')}}</button>
                                        @endif
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                              <div class=" pagination pagination-md m-0  float-left">{{$clients->appends(request()->query())->links()}}</div>
                        </div>
                        @else
                            <h2>{{__('site.no_data_found')}}</h2>
                        @endif
                    </div>
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