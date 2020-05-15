@extends('layouts.dashboard.app')
@section('title')
    {{__('site.add_new_user')}}
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
                                <a href="{{route('dashboard.welcome')}}">{{__('site.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.users.index')}}">{{__('site.users')}}</a>
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
                        <h5 class="box-title p-15 btn-info" >{{__('site.add_new_user')}}</h5>
                        @include('partial.errors')
                        <form class="form-horizontal p-t-20" action="{{route('dashboard.users.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 control-label"><span style="color: red">*</span>{{__('site.first_name')}}</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="ti-user"></i></span></div>
                                        <input type="text" class="form-control" name="first_name"  placeholder="{{__('site.first_name')}}" required value="{{old('first_name')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 control-label"><span style="color: red">*</span>{{__('site.last_name')}}</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="ti-user"></i></span></div>
                                        <input type="text" class="form-control" name="last_name" placeholder="{{__('site.last_name')}}" required value="{{old('last_name')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email4" class="col-sm-3 control-label"><span style="color: red">*</span>{{__('site.email')}}</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="ti-email"></i></span></div>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="{{__('site.email')}}" required value="{{old('email')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email4" class="col-sm-3 control-label"><span style="color: red">*</span>{{__('site.image')}}</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="ti-image"></i></span></div>
                                        <input type="file" class="form-control image" name="image" onchange="readURL(this);" id="ShowImage"   >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3"></div>
                                <div class="col-9">
                                    <img src="{{asset('uploads/users/default.png')}}" width="100" class="img-fluid rounded-circle image_preview" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label"><span style="color: red">*</span>{{__('site.password')}}</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="ti-lock"></i></span></div>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="{{__('site.password')}}" required>
                                        <div class="input-group-prepend " ><span class="input-group-text"><i class="fa fa-eye" onclick="myFunction()"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label"><span style="color: red">*</span>{{__('site.password_confirmation')}}</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="ti-lock"></i></span></div>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{__('site.password_confirmation')}}" required>
                                        <div class="input-group-prepend " ><span class="input-group-text"><i class="fa fa-eye" onclick="myFunction1()"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{__('site.permissions')}}</h4>
                                    @php
                                        $models = ['users','categories','products','clients', 'orders'];
                                        $maps = ['create','read','edit','delete'];
                                    @endphp

                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach($models as $index=>$model)
                                            <li class="nav-item"> <a class="nav-link {{$index == 0? 'active' : ''}}" data-toggle="tab" href="#{{$model}}" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">{{__('site.'. $model)}}</span></a> </li>
                                        @endforeach
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tab-content-border">
                                       @foreach($models as $index=>$model)
                                            <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$model}}" role="tabpanel">
                                            <div class="p-20">
                                                @foreach($maps as $map)
                                                    <label><input type="checkbox" name="permissions[]" value="{{$map}}_{{$model}}" >{{__('site.'.$map)}}</label>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
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
@section('jsFooter')
    <script>

        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        function myFunction1() {
            var x = document.getElementById("password_confirmation");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }



    </script>

@endsection
