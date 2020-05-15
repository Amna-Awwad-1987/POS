@extends('layouts.dashboard.app')
@section('title')
    {{__('site.categories')}}
@endsection
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{__('site.categories')}}</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.categories')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div id="tui-image-editor"></div>

        <div class="row">
            <!-- Column -->
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="box-title p-15">{{__('site.categories')}}<small style="color: red">{{' '.$categories->total()}}</small></h5>
                        <form action="{{route('dashboard.categories.index')}}" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="{{__('site.search')}}" value="{{request()->search}}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-search"></i>{{' '.__('site.search')}}</button>
                                    @if(auth()->user()->hasPermission('create_categories'))
                                        <a href="{{route('dashboard.categories.create')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>{{' '.__('site.add')}}</a>
                                    @else
                                        <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-plus"></i>{{' '.__('site.add')}}</a>
                                    @endif

                                </div>
                            </div>
                            <br>
                        </form>
                        @if($categories->count() > 0)
                          <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-success text-white">
                                    <tr>
                                    <th>#</th>
                                    <th>{{__('site.name')}}</th>
                                    <th>{{__('site.products_count')}}</th>
                                    <th>{{__('site.related_products')}}</th>
                                    <th>{{__('site.action')}}</th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 1;
                                @endphp
                                <tbody class="border border-success">
                                    @foreach($categories as $index => $category)
                                        <tr>
                                            <td>{{$i++ +(4*($categories->currentPage()-1))}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>{{$category->products->count()}}</td>
                                            <td>
                                                <a href="{{route('dashboard.products.index',['category_id'=> $category->id])}}"  class="btn btn-info btn-sm"> {{__('site.related_products')}}</a>
                                            </td>
                                            <td>
                                            @if(auth()->user()->hasPermission('edit_categories'))
                                                <a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>{{' '.__('site.edit')}}</a>
                                            @else
                                                <a href="#" class="btn btn-warning btn-sm disabled"><i class="fa fa-edit"></i>{{' '.__('site.edit')}}</a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_categories'))
                                                <form action="{{route('dashboard.categories.destroy',$category->id)}}" method="post" class="d-inline-block">
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
                              <div class=" pagination pagination-md m-0  float-left">{{$categories->appends(request()->query())->links()}}</div>
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