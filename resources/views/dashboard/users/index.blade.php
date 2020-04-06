@extends('layouts.dashboard.app')
@section('title')
    {{__('site.users')}}
@endsection
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{__('site.users')}}</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.users')}}</li>
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
                        <h5 class="box-title p-15">{{__('site.users')}}<small style="color: red">{{' '.$users->total()}}</small></h5>
                        <form action="{{route('dashboard.users.index')}}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="{{__('site.search')}}" value="{{request()->search}}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-search"></i>{{' '.__('site.search')}}</button>
                                    @if(auth()->user()->hasPermission('create_users'))
                                        <a href="{{route('dashboard.users.create')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>{{' '.__('site.add')}}</a>
                                    @else
                                        <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-plus"></i>{{' '.__('site.add')}}</a>
                                    @endif

                                </div>
                            </div>
                            <br>
                        </form>
                        @if($users->count() > 0)
                          <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-success text-white">
                                    <tr>
                                    <th>#</th>
                                    <th>{{__('site.first_name')}}</th>
                                    <th>{{__('site.last_name')}}</th>
                                    <th>{{__('site.email')}}</th>
                                    <th>{{__('site.image')}}</th>
                                    <th>{{__('site.action')}}</th>
                                </tr>
                                </thead>
                                @php
                                    $i = 1;
                                @endphp
                                <tbody class="border border-success">
                                    @foreach($users as $index => $user)
                                        <tr>
                                    <td>{{$i++ +(4*($users->currentPage()-1))}}</td>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><img src="{{$user->image_path}}" class="img-fluid rounded-circle" style="height: 100px; width: 100px"> </td>
                                    <td>
                                        @if(auth()->user()->hasPermission('edit_users'))
                                            <a href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>{{' '.__('site.edit')}}</a>
                                        @else
                                            <a href="#" class="btn btn-warning btn-sm disabled"><i class="fa fa-edit"></i>{{' '.__('site.edit')}}</a>
                                        @endif
                                        @if(auth()->user()->hasPermission('delete_users'))
                                            <form action="{{route('dashboard.users.destroy',$user->id)}}" method="post" class="d-inline-block">
                                                @csrf
                                                {{method_field('delete')}}
                                                <button type="submit" class=" btn btn-danger delete btn-sm " id="confirm_delete"><i class="fa fa-trash"></i>{{' '.__('site.delete')}}</button>
                                            </form>
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>{{' '.__('site.delete')}}</button>
                                        @endif
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                              <div class=" pagination pagination-md m-0  float-left">{{$users->appends(request()->query())->links()}}</div>
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