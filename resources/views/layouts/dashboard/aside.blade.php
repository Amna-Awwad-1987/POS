
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile dropdown m-t-20">
                        <div class="user-pic">
                            <img src="{{url('dashboard/img/1.jpg')}}" alt="users" class="rounded-circle img-fluid" />
                        </div>
                        <div class="user-content hide-menu m-t-10">
                            <h5 class="m-b-10 user-name font-medium">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h5>
                            <a href="javascript:void(0)" class="btn btn-circle btn-sm m-r-5" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i class="ti-settings"></i>
                            </a>
                            <a class="btn btn-circle btn-sm" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="ti-power-off"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <div class="dropdown-menu animated flipInY" aria-labelledby="Userdd">
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
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <!-- User Profile-->
                <li class="nav-small-cap"><a href="{{route('dashboard.index')}}"><i class="mdi mdi-dots-horizontal"></i><span class="hide-menu font-18">{{__('site.dashboard')}}</span></a>
                </li>

                @if(auth()->user()->hasPermission('read_categories'))
                <li class="nav-small-cap"><a href="{{route('dashboard.categories.index')}}"><i class="mdi mdi-dots-horizontal"></i><span class="hide-menu font-18">{{__('site.categories')}}</span></a>
                </li>
                @endif
                @if(auth()->user()->hasPermission('read_products'))
                    <li class="nav-small-cap"><a href="{{route('dashboard.products.index')}}"><i class="mdi mdi-dots-horizontal"></i><span class="hide-menu font-18">{{__('site.products')}}</span></a>
                    </li>
                @endif
                @if(auth()->user()->hasPermission('read_clients'))
                    <li class="nav-small-cap"><a href="{{route('dashboard.clients.index')}}"><i class="mdi mdi-dots-horizontal"></i><span class="hide-menu font-18">{{__('site.clients')}}</span></a>
                    </li>
                @endif
{{--                @if(auth()->user()->hasPermission('read_clients'))--}}
                    <li class="nav-small-cap"><a href="{{route('dashboard.orders.index')}}"><i class="mdi mdi-dots-horizontal"></i><span class="hide-menu font-18">{{__('site.orders')}}</span></a>
                    </li>
{{--                @endif--}}
                @if(auth()->user()->hasPermission('read_users'))
                    <li class="nav-small-cap"><a href="{{route('dashboard.users.index')}}"><i class="mdi mdi-dots-horizontal"></i><span class="hide-menu font-18">{{__('site.users')}}</span></a>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
