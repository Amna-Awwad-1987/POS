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
                                <a href="{{route('dashboard.welcome')}}">{{__('site.dashboard')}}</a>
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
        <div class="row">
            <!-- Column -->
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="box-title p-15 btn-warning" >{{__('site.edit_order')}}</h5>
                        @include('partial.errors')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
