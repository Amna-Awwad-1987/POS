@extends('layouts.dashboard.app')
@section('title')
    {{__('site.dashboard')}}
@endsection
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">{{__('site.dashboard')}}</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Info box -->
        <!-- ============================================================== -->
        <div class="card-group">
            <!-- Card -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg bg-danger">
                                        <i class="ti-clipboard text-white"></i>
                                    </span>
                        </div>
                        <div>
                            New projects
                        </div>
                        <div class="ml-auto">
                            <h2 class="m-b-0 font-light">23</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card -->
            <!-- Card -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg btn-info">
                                        <i class="ti-wallet text-white"></i>
                                    </span>
                        </div>
                        <div>
                            Total Earnings

                        </div>
                        <div class="ml-auto">
                            <h2 class="m-b-0 font-light">113</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card -->
            <!-- Card -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg bg-success">
                                        <i class="ti-shopping-cart text-white"></i>
                                    </span>
                        </div>
                        <div>
                            Total Sales

                        </div>
                        <div class="ml-auto">
                            <h2 class="m-b-0 font-light">43</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card -->
            <!-- Card -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg bg-warning">
                                        <i class="mdi mdi-currency-usd text-white"></i>
                                    </span>
                        </div>
                        <div>
                            Profit

                        </div>
                        <div class="ml-auto">
                            <h2 class="m-b-0 font-light">63</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card -->
            <!-- Column -->


        </div>
        <!-- ============================================================== -->
        <!-- Info box -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Email campaign chart -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h4 class="card-title">Product Sales</h4>
                                <h5 class="card-subtitle">Overview of Latest Month</h5>
                            </div>
                            <div class="ml-auto">
                                <ul class="list-inline font-12 dl m-r-10">
                                    <li class="list-inline-item">
                                        <i class="fas fa-dot-circle text-info"></i> Ipad
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-dot-circle text-danger"></i> Iphone</li>
                                </ul>
                            </div>
                        </div>
                        <div id="product-sales" style="height:305px"></div>
                    </div>
                </div>

            </div>
            <!-- Column -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body bg-light-info">
                        <div class="d-flex align-items-center m-t-10 m-b-20">
                            <div class="m-r-10">
                                <i class="icon-Cloud-Sun display-5"></i>
                            </div>
                            <div>
                                <h1 class="m-b-0 font-light">35
                                    <sup>o</sup>
                                </h1>
                                <h5 class="font-light">Clear and sunny</h5>
                            </div>
                        </div>
                        <div id="ct-weather" style="height: 170px"></div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">

                            <div>
                                <span class="btn-circle btn-lg btn btn-outline-secondary">
                                    <i class="wi wi-day-sunny"></i>
                                </span>
                            </div>
                            <div class="m-l-10">
                                <h4 class="m-b-0">Monday</h4>
                                <h6 class="font-light m-b-0">March 2019</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body bg-light-warning text-white">
                        <div id="weeksales-bar" class="position-relative" style="height: 270px"></div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">

                            <div>
                                        <span class="btn-circle btn-lg btn btn-outline-secondary">
                                            <i class="ti-shopping-cart"></i>
                                        </span>
                            </div>
                            <div class="m-l-10">
                                <h4 class="m-b-0">Sales</h4>
                                <h6 class="font-light m-b-0">March 2019</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Email campaign chart -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Top Selliing Products -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Top Selliing Products -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Recent comment and chats -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Recent comment and chats -->
        <!-- ============================================================== -->
    </div>


@endsection
