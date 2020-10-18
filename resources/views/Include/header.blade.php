@php
    $users = DB::table('role_user')->where('user_id',auth()->user()->id)->get();
    foreach ($users as $user)
    $roles = \App\Role::where('id',$user->role_id)->get();
    foreach ($roles as $role)
@endphp
<!-- Logo -->
<a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">پولاد</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>سیستم مدیریت</b></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    <span class="label label-success">1</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">1 پیام خوانده نشده</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li><!-- start message -->
                                <a href="#">
                                    <div class="pull-right">
                                        <img src="{{url('/public/dist/img/user2-160x160.jpg')}}" class="img-circle"
                                             alt="User Image">
                                    </div>
                                    <h4>
                                        علیرضا
                                        <small><i class="fa fa-clock-o"></i> ۵ دقیقه پیش</small>
                                    </h4>
                                    <p>متن پیام</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer"><a href="#">نمایش تمام پیام ها</a></li>
                </ul>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning">1</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">1 اعلان جدید</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-warning text-yellow"></i> اخطار دقت کنید
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer"><a href="#">نمایش همه</a></li>
                </ul>
            </li>
            <li class="dropdown notifications-menu">
                <a href="{{route('admin.user.lock')}}" class="dropdown-toggle">
                    <i class="fa fa-lock"></i>
                </a>
            </li>
            <!-- Tasks: style can be found in dropdown.less -->
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    @if(!empty(auth()->user()->avatar))
                        <img src="{{url(auth()->user()->avatar)}}" class="user-image" alt="User Image">
                    @else
                        <img src="{{url('/public/icon/male-user.png')}}" class="user-image" alt="User Image">
                    @endif


                    <span class="hidden-xs">{{auth()->user()->name}}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        @if(!empty(auth()->user()->avatar))
                            <img src="{{url(auth()->user()->avatar)}}" class="img-circle" alt="User Image">
                        @else
                            <img src="{{url('/public/icon/male-user.png')}}" class="img-circle"
                                 alt="User Image">
                        @endif

                        <p>
                            {{auth()->user()->name}}
                            <small>{{$role->name}}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-right">
                            <a href="{{route('admin.user.profile')}}" class="btn btn-default btn-flat">پروفایل</a>
                        </div>
                        <div class="pull-left">


                            <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                خروج
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
