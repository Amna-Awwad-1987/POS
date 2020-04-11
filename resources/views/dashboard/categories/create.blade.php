@extends('layouts.dashboard.app')
@section('title')
    {{__('site.add_new_category')}}
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
                                <a href="{{route('dashboard.index')}}">{{__('site.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.categories.index')}}">{{__('site.categories')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.add')}}</li>
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
                        <h5 class="box-title p-15 btn-info" >{{__('site.add_new_category')}}</h5>
                        @include('partial.errors')
                        <form class="form-horizontal p-t-20" action="{{route('dashboard.categories.store')}}" method="POST" >
                            @csrf
                            @foreach(config('translatable.locales') as $locale)
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 control-label"><span style="color: red">*</span>@lang('site.'.$locale.'.name')</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="ti-user"></i></span></div>
                                            <input type="text" class="form-control" name="{{$locale}}[name]"  placeholder="{{__('site.'.$locale.'.name')}}"  value="{{old($locale . '.name')}}">
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                            <div class="form-group row m-b-0">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fa fa-plus"></i>{{' '.__('site.submit')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
