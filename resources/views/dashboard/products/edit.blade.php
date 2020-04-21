@extends('layouts.dashboard.app')
@section('title')
    {{__('site.edit_product')}}
@endsection
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{__('site.products')}}</h4>
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
                                <a href="{{route('dashboard.products.index')}}">{{__('site.products')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('site.edit')}}</li>
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
                        <h5 class="box-title p-15 btn-warning" >{{__('site.edit_product')}}</h5>
                        @include('partial.errors')
                        <form class="form-horizontal p-t-20" action="{{route('dashboard.products.update',$product->id)}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            {{method_field('put')}}

                            @php
                            $locale = app()->getLocale();
                            @endphp

                            <div class="form-group row">
                                <label for="email4" class="col-sm-3 control-label"><span style="color: red">*</span>{{__('site.categories')}}</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="ti-category"></i></span></div>
                                        <select name="category_id" class="form-control select2 search-box"  required>
                                            <option value="">{{$product->category->translate($locale)->name}}</option>
                                            @foreach($categories as $category)
                                                <option value="{{$product->category_id}}" {{$product->category_id == $category->id ? 'selected' : ''}}> {{$category->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @foreach(config('translatable.locales') as $locale)
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 control-label"><span style="color: red">*</span>@lang('site.'.$locale.'.name')</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="ti-user"></i></span></div>
                                            <input type="text" class="form-control" name="{{$locale}}[name]" required  placeholder="{{__('site.'.$locale.'.name')}}"   value="{{$product->translate($locale)->name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 control-label"><span style="color: red">*</span>@lang('site.'.$locale.'.description')</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="ti-paragraph"></i></span></div>
                                            <textarea  class="form-control ckeditor" name="{{$locale}}[description]"  required  > {{$product->translate($locale)->name}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-group row">
                                <label for="email4" class="col-sm-3 control-label">{{__('site.image')}}</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="ti-image"></i></span></div>
                                        <input type="file" class="form-control image" name="image"  onchange="readURL(this);" id="ShowImage"  value="{{$product->image_path}}"  >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3"></div>
                                <div class="col-9">
                                    <img src="{{$product->image_path}}" width="100" class="img-fluid rounded-circle image_preview" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label"><span style="color: red">*</span>{{__('site.purchase_price')}}</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="ti-money"></i></span></div>
                                        <input type="number" class="form-control" step="0.01" name="purchase_price" id="" required placeholder="{{__('site.purchase_price')}}" value="{{$product->purchase_price}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label"><span style="color: red">*</span>{{__('site.sale_price')}}</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="ti-money"></i></span></div>
                                        <input type="number" class="form-control" step="0.01" name="sale_price" required id="" placeholder="{{__('site.sale_price')}}" value="{{$product->sale_price}}"  >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 control-label"><span style="color: red">*</span>{{__('site.stock')}}</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="ti-stack-overflow"></i></span></div>
                                        <input type="number" class="form-control" name="stock" id="" required  placeholder="{{__('site.stock')}}" value="{{$product->stock}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-b-0">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-warning waves-effect waves-light"><i class="fa fa-edit"></i>{{' '.__('site.update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
