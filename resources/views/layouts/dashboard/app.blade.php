<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('dashboard_files/img/favicon.png')}}">
    <title>@yield('title')</title>
    <!-- Custom CSS -->
{{--    <link href="{{asset('dashboard_files/css/bootstrap.min.css')}}" rel="stylesheet">--}}
    <link href="{{asset('dashboard_files/css/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard_files/css/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboard_files/css/morris.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('dashboard_files/css/style.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('dashboard_files/css/noty.css')}}">
    <script src="{{asset('dashboard_files/js/noty.min.js')}}"></script>;

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    @if(app()->getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        <style>
            body, h1, h2, h3, h4, h5, h6{
                font-family: 'Cairo', sans-serif !important;
            }
            .loader {
                border: 8px solid #f3f3f3;
                border-radius: 50%;
                border-top: 6px solid #3498db;
                width: 60px;
                height: 60px;
                -webkit-animation: spin 2s linear infinite; /* Safari */
                animation: spin 2s linear infinite;
            }

            /* Safari */
            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    @endif

    <link rel="stylesheet" href="https://uicdn.toast.com/tui-image-editor/latest/tui-image-editor.css">
    <script src="https://uicdn.toast.com/tui-image-editor/latest/tui-image-editor.js"></script>
    <script src="{{asset('css/tui-image-editor.css')}}"></script>

    @yield('cssHeader')

</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar p-0">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark " style="padding-top: 0px">
            <div class="navbar-header">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                    <i class="ti-menu ti-close"></i>
                </a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand" href="#">
                    <!-- Logo icon -->
                    <b class="logo-icon">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="{{url('dashboard_files/img/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                        <!-- Light Logo icon -->
                        <img src="{{url('dashboard_files/img/logo-light-icon.png')}}" alt="homepage" class="light-logo" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{url('dashboard_files/img/logo-text.png')}}" alt="homepage" class="dark-logo" />
                        <!-- Light Logo text -->
                            <img src="{{url('dashboard_files/img/logo-light-text.png')}}" class="light-logo" alt="homepage" />
                        </span>
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
                   aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti-more"></i>
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-left mr-auto">
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                            <i class="sl-icon-menu font-20"></i>
                        </a>
                    </li>
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Comment -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-bell font-20"></i>
                        </a>
                        <div class="dropdown-menu mailbox animated bounceInDown">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                            <ul class="list-style-none">
                                <li>
                                    <div class="drop-title bg-primary text-white">
                                        <h4 class="m-b-0 m-t-5">4 New</h4>
                                        <span class="font-light">Notifications</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="message-center notifications">
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-danger btn-circle">
                                                    <i class="fa fa-link"></i>
                                                </span>
                                            <div class="mail-contnet">
                                                <h5 class="message-title">Luanch Admin</h5>
                                                <span class="mail-desc">Just see the my new admin!</span>
                                                <span class="time">9:30 AM</span>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-success btn-circle">
                                                    <i class="ti-calendar"></i>
                                                </span>
                                            <div class="mail-contnet">
                                                <h5 class="message-title">Event today</h5>
                                                <span class="mail-desc">Just a reminder that you have event</span>
                                                <span class="time">9:10 AM</span>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-info btn-circle">
                                                    <i class="ti-settings"></i>
                                                </span>
                                            <div class="mail-contnet">
                                                <h5 class="message-title">Settings</h5>
                                                <span class="mail-desc">You can customize this template as you want</span>
                                                <span class="time">9:08 AM</span>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-primary btn-circle">
                                                    <i class="ti-user"></i>
                                                </span>
                                            <div class="mail-contnet">
                                                <h5 class="message-title">Pavan kumar</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:02 AM</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link text-center m-b-5" href="javascript:void(0);">
                                        <strong>Check all notifications</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End Comment -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Messages -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="font-20 ti-email"></i>
                        </a>
                        <div class="dropdown-menu mailbox animated bounceInDown" aria-labelledby="2">
                                <span class="with-arrow">
                                    <span class="bg-danger"></span>
                                </span>
                            <ul class="list-style-none">
                                <li>
                                    <div class="drop-title bg-danger text-white">
                                        <h4 class="m-b-0 m-t-5">5 New</h4>
                                        <span class="font-light">Messages</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="message-center message-body">
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img">
                                                    <img src="{{url('dashboard_files/img/1.jpg')}}" alt="user" class="rounded-circle">
                                                    <span class="profile-status online pull-right"></span>
                                                </span>
                                            <div class="mail-contnet">
                                                <h5 class="message-title">Pavan kumar</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:30 AM</span>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img">
                                                    <img src="{{url('dashboard_files/img/2.jpg')}}" alt="user" class="rounded-circle">
                                                    <span class="profile-status busy pull-right"></span>
                                                </span>
                                            <div class="mail-contnet">
                                                <h5 class="message-title">Sonu Nigam</h5>
                                                <span class="mail-desc">I've sung a song! See you at</span>
                                                <span class="time">9:10 AM</span>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img">
                                                    <img src="{{url('dashboard_files/img/3.jpg')}}" alt="user" class="rounded-circle">
                                                    <span class="profile-status away pull-right"></span>
                                                </span>
                                            <div class="mail-contnet">
                                                <h5 class="message-title">Arijit Sinh</h5>
                                                <span class="mail-desc">I am a singer!</span>
                                                <span class="time">9:08 AM</span>
                                            </div>
                                        </a>
                                        <!-- Message -->
                                        <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img">
                                                    <img src="{{url('dashboard_files/img/4.jpg')}}" alt="user" class="rounded-circle">
                                                    <span class="profile-status offline pull-right"></span>
                                                </span>
                                            <div class="mail-contnet">
                                                <h5 class="message-title">Pavan kumar</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:02 AM</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link text-center link" href="javascript:void(0);">
                                        <b>See all e-Mails</b>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- End Messages -->
                    <!-- ============================================================== -->


                </ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-right">
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    <li class="nav-item search-box">
                        <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                            <i class="ti-search font-16"></i>
                        </a>
                        <form class="app-search position-absolute">
                            <input type="text" class="form-control" placeholder="Search &amp; enter">
                            <a class="srh-btn">
                                <i class="ti-close"></i>
                            </a>
                        </form>
                    </li>
                    <!-- ============================================================== -->
                    <!-- create new -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            @if(app()->getLocale() == 'ar')
                                <i class="flag-icon flag-icon-us font-18"></i>
                            @else
                                <i class="flag-icon flag-icon-sa font-18"></i>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right  animated bounceInDown" aria-labelledby="navbarDropdown2">
                            <ul>
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                   @if($localeCode != app()->getLocale() )
                                    <li>
                                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <img src="{{url('dashboard_files/img/1.jpg')}}" alt="user" class="rounded-circle" width="31">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                            <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                <div class="">
                                    <img src="{{url('dashboard_files/img/1.jpg')}}" alt="user" class="img-circle" width="60">
                                </div>
                                <div class="m-l-10">
                                    <h4 class="m-b-0">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h4>
                                    <p class=" m-b-0">{{auth()->user()->email}}</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off m-r-5 m-l-5"></i>{{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <div class="dropdown-divider"></div>
                            <div class="p-l-30 p-10">
                                <a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a>
                            </div>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    @include('layouts.dashboard.aside')
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
    <!-- ============================================================== -->
        @yield('content')
        @include('partial.session')
    <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
            All Rights Reserved by AdminBite admin. Designed and Developed by
            <a href="https://wrappixel.com">WrapPixel</a>.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- customizer Panel -->
<!-- ============================================================== -->
<aside class="customizer">
    <a href="javascript:void(0)" class="service-panel-toggle">
        <i class="fa fa-spin fa-cog"></i>
    </a>
    <div class="customizer-body">
        <ul class="nav customizer-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab
                                   " aria-controls="pills-home" aria-selected="true">
                    <i class="mdi mdi-wrench font-20"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#chat" role="tab
                                   " aria-controls="chat" aria-selected="false">
                    <i class="mdi mdi-message-reply font-20"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab
                                   " aria-controls="pills-contact" aria-selected="false">
                    <i class="mdi mdi-star-circle font-20"></i>
                </a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <!-- Tab 1 -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="p-15 border-bottom">
                    <!-- Sidebar -->
                    <h5 class="font-medium m-b-10 m-t-10">Layout Settings</h5>
                    <div class="custom-control custom-checkbox m-t-10">
                        <input type="checkbox" class="custom-control-input" name="theme-view" id="theme-view">
                        <label class="custom-control-label" for="theme-view">Dark Theme</label>
                    </div>
                    <div class="custom-control custom-checkbox m-t-10">
                        <input type="checkbox" class="custom-control-input sidebartoggler" name="collapssidebar
                                   " id="collapssidebar">
                        <label class="custom-control-label" for="collapssidebar">Collapse Sidebar</label>
                    </div>
                    <div class="custom-control custom-checkbox m-t-10">
                        <input type="checkbox" class="custom-control-input" name="sidebar-position" id="sidebar-position">
                        <label class="custom-control-label" for="sidebar-position">Fixed Sidebar</label>
                    </div>
                    <div class="custom-control custom-checkbox m-t-10">
                        <input type="checkbox" class="custom-control-input" name="header-position" id="header-position">
                        <label class="custom-control-label" for="header-position">Fixed Header</label>
                    </div>
                    <div class="custom-control custom-checkbox m-t-10">
                        <input type="checkbox" class="custom-control-input" name="boxed-layout" id="boxed-layout">
                        <label class="custom-control-label" for="boxed-layout">Boxed Layout</label>
                    </div>
                </div>
                <div class="p-15 border-bottom">
                    <!-- Logo BG -->
                    <h5 class="font-medium m-b-10 m-t-10">Logo Backgrounds</h5>
                    <ul class="theme-color">
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-logobg="skin1"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-logobg="skin2"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-logobg="skin3"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-logobg="skin4"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-logobg="skin5"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-logobg="skin6"></a>
                        </li>
                    </ul>
                    <!-- Logo BG -->
                </div>
                <div class="p-15 border-bottom">
                    <!-- Navbar BG -->
                    <h5 class="font-medium m-b-10 m-t-10">Navbar Backgrounds</h5>
                    <ul class="theme-color">
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-navbarbg="skin1"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-navbarbg="skin2"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-navbarbg="skin3"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-navbarbg="skin4"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-navbarbg="skin5"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-navbarbg="skin6"></a>
                        </li>
                    </ul>
                    <!-- Navbar BG -->
                </div>
                <div class="p-15 border-bottom">
                    <!-- Logo BG -->
                    <h5 class="font-medium m-b-10 m-t-10">Sidebar Backgrounds</h5>
                    <ul class="theme-color">
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin1"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin2"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin3"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin4"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin5"></a>
                        </li>
                        <li class="theme-item">
                            <a href="javascript:void(0)" class="theme-link" data-sidebarbg="skin6"></a>
                        </li>
                    </ul>
                    <!-- Logo BG -->
                </div>
            </div>
            <!-- End Tab 1 -->
            <!-- Tab 2 -->
            <div class="tab-pane fade" id="chat" role="tabpanel" aria-labelledby="pills-profile-tab">
                <ul class="mailbox list-style-none m-t-20">
                    <li>
                        <div class="message-center chat-scroll">
                            <a href="javascript:void(0)" class="message-item" id='chat_user_1' data-user-id='1'>
                                    <span class="user-img">
                                        <img src="{{url('dashboard_files/img/1.jpg')}}" alt="user" class="rounded-circle">
                                        <span class="profile-status online pull-right"></span>
                                    </span>
                                <div class="mail-contnet">
                                    <h5 class="message-title">Pavan kumar</h5>
                                    <span class="mail-desc">Just see the my admin!</span>
                                    <span class="time">9:30 AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item" id='chat_user_2' data-user-id='2'>
                                    <span class="user-img">
                                        <img src="{{url('dashboard_files/img/2.jpg')}}" alt="user" class="rounded-circle">
                                        <span class="profile-status busy pull-right"></span>
                                    </span>
                                <div class="mail-contnet">
                                    <h5 class="message-title">Sonu Nigam</h5>
                                    <span class="mail-desc">I've sung a song! See you at</span>
                                    <span class="time">9:10 AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item" id='chat_user_3' data-user-id='3'>
                                    <span class="user-img">
                                        <img src="{{url('/dashboard_files/img/3.jpg')}}" alt="user" class="rounded-circle">
                                        <span class="profile-status away pull-right"></span>
                                    </span>
                                <div class="mail-contnet">
                                    <h5 class="message-title">Arijit Sinh</h5>
                                    <span class="mail-desc">I am a singer!</span>
                                    <span class="time">9:08 AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item" id='chat_user_4' data-user-id='4'>
                                    <span class="user-img">
                                        <img src="{{url('dashboard_files/img/4.jpg')}}" alt="user" class="rounded-circle">
                                        <span class="profile-status offline pull-right"></span>
                                    </span>
                                <div class="mail-contnet">
                                    <h5 class="message-title">Nirav Joshi</h5>
                                    <span class="mail-desc">Just see the my admin!</span>
                                    <span class="time">9:02 AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item" id='chat_user_5' data-user-id='5'>
                                    <span class="user-img">
                                        <img src="{{url('/dashboard_files/img/5.jpg')}}" alt="user" class="rounded-circle">
                                        <span class="profile-status offline pull-right"></span>
                                    </span>
                                <div class="mail-contnet">
                                    <h5 class="message-title">Sunil Joshi</h5>
                                    <span class="mail-desc">Just see the my admin!</span>
                                    <span class="time">9:02 AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item" id='chat_user_6' data-user-id='6'>
                                    <span class="user-img">
                                        <img src="{{url('/dashboard_files/img/6.jpg')}}" alt="user" class="rounded-circle">
                                        <span class="profile-status offline pull-right"></span>
                                    </span>
                                <div class="mail-contnet">
                                    <h5 class="message-title">Akshay Kumar</h5>
                                    <span class="mail-desc">Just see the my admin!</span>
                                    <span class="time">9:02 AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item" id='chat_user_7' data-user-id='7'>
                                    <span class="user-img">
                                        <img src="{{url('/dashboard_files/img/7.jpg')}}" alt="user" class="rounded-circle">
                                        <span class="profile-status offline pull-right"></span>
                                    </span>
                                <div class="mail-contnet">
                                    <h5 class="message-title">Pavan kumar</h5>
                                    <span class="mail-desc">Just see the my admin!</span>
                                    <span class="time">9:02 AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item" id='chat_user_8' data-user-id='8'>
                                    <span class="user-img">
                                        <img src="{{url('/dashboard_files/img/8.jpg')}}" alt="user" class="rounded-circle">
                                        <span class="profile-status offline pull-right"></span>
                                    </span>
                                <div class="mail-contnet">
                                    <h5 class="message-title">Varun Dhavan</h5>
                                    <span class="mail-desc">Just see the my admin!</span>
                                    <span class="time">9:02 AM</span>
                                </div>
                            </a>
                            <!-- Message -->
                        </div>
                    </li>
                </ul>
            </div>
            <!-- End Tab 2 -->
            <!-- Tab 3 -->
            <div class="tab-pane fade p-15" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h6 class="m-t-20 m-b-20">Activity Timeline</h6>
                <div class="steamline">
                    <div class="sl-item">
                        <div class="sl-left bg-success">
                            <i class="ti-user"></i>
                        </div>
                        <div class="sl-right">
                            <div class="font-medium">Meeting today
                                <span class="sl-date"> 5pm</span>
                            </div>
                            <div class="desc">you can write anything </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left bg-info">
                            <i class="fas fa-image"></i>
                        </div>
                        <div class="sl-right">
                            <div class="font-medium">Send documents to Clark</div>
                            <div class="desc">Lorem Ipsum is simply </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left">
                            <img class="rounded-circle" alt="user" src="{{url('/dashboard_files/img/2.jpg')}}"> </div>
                        <div class="sl-right">
                            <div class="font-medium">Go to the Doctor
                                <span class="sl-date">5 minutes ago</span>
                            </div>
                            <div class="desc">Contrary to popular belief</div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left">
                            <img class="rounded-circle" alt="user" src="{{url('/dashboard_files/img/1.jpg')}}"> </div>
                        <div class="sl-right">
                            <div>
                                <a href="javascript:void(0)">Stephen</a>
                                <span class="sl-date">5 minutes ago</span>
                            </div>

                            <div class="desc">Approve meeting with tiger</div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left bg-primary">
                            <i class="ti-user"></i>
                        </div>
                        <div class="sl-right">
                            <div class="font-medium">Meeting today
                                <span class="sl-date"> 5pm</span>
                            </div>
                            <div class="desc">you can write anything </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left bg-info">
                            <i class="fas fa-image"></i>
                        </div>
                        <div class="sl-right">
                            <div class="font-medium">Send documents to Clark</div>
                            <div class="desc">Lorem Ipsum is simply </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left">
                            <img class="rounded-circle" alt="user" src="{{url('/dashboard_files/img/4.jpg')}}"> </div>
                        <div class="sl-right">
                            <div class="font-medium">Go to the Doctor
                                <span class="sl-date">5 minutes ago</span>
                            </div>
                            <div class="desc">Contrary to popular belief</div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left">
                            <img class="rounded-circle" alt="user" src="{{url('/dashboard_files/img/6.jpg')}}"> </div>
                        <div class="sl-right">
                            <div>
                                <a href="javascript:void(0)">Stephen</a>
                                <span class="sl-date">5 minutes ago</span>
                            </div>
                            <div class="desc">Approve meeting with tiger</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Tab 3 -->
        </div>
    </div>
</aside>
<div class="chat-windows"></div>
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{asset('dashboard_files/js/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('dashboard_files/js/popper.min.js')}}"></script>
<script src="{{asset('dashboard_files/js/bootstrap.min.js')}}"></script>
<!-- apps -->
<script src="{{asset('dashboard_files/js/app.min.js')}}"></script>
<script src="{{asset('dashboard_files/js/app.init.js')}}"></script>
<script src="{{asset('dashboard_files/js/app-style-switcher.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('dashboard_files/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('dashboard_files/js/sparkline.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('dashboard_files/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('dashboard_files/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('dashboard_files/js/custom.min.js')}}"></script>
<!--This page JavaScript -->
<!--chartis chart-->
<script src="{{asset('dashboard_files/js/chartist.min.js')}}"></script>
<script src="{{asset('dashboard_files/js/chartist-plugin-tooltip.min.js')}}"></script>
<!--c3 charts -->
<script src="{{asset('dashboard_files/js/d3.min.js')}}"></script>
<script src="{{asset('dashboard_files/js/c3.min.js')}}"></script>
<!--chartjs -->
<script src="{{asset('dashboard_files/js/raphael.min.js')}}"></script>
<script src="{{asset('dashboard_files/js/morris.min.js')}}"></script>

<script src="{{asset('dashboard_files/js/dashboard1.js')}}"></script>
{{--<script src="{{asset('dashboard_files/ckeditor/config.js')}}"></script>--}}
<script src="{{asset('dashboard_files/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('dashboard_files/ckeditor/translations/ar.js')}}"></script>
<script src="{{asset('dashboard_files/js/site-custom.js')}}"></script>
<script src="{{asset('dashboard_files/js/image-preview.js')}}"></script>
<script src="{{asset('dashboard_files/jquery-number-master/jquery.number.js')}}"></script>
<script src="{{asset('dashboard_files/js/printThis.js')}}"></script>
<script src="{{asset('js/tui-image-editor.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree();
        //icheck
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //delete
        $('.delete').click(function (e) {
            var that = $(this)
            e.preventDefault();
            var n = new Noty({
                text: "@lang('site.confirm_delete')",
                type: "warning",
                killer: true,
                buttons: [
                    Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                        that.closest('form').submit();
                    }),
                    Noty.button("@lang('site.no')", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });
            n.show();
        });//end of delete


        // CKEDITOR.config.language = "ar";
        // config.language = 'ar';

    });//end of ready

</script>

@include('sweetalert::alert')
@yield('jsFooter')
</body>

</html>