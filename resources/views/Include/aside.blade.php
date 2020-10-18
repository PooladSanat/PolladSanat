<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-right image">
            @if(!empty(auth()->user()->avatar))
                <img src="{{url(auth()->user()->avatar)}}" class="img-circle" alt="User Image">
            @else
                <img src="{{url('/public/icon/male-user.png')}}" class="img-circle" alt="User Image">

            @endif
        </div>
        <div class="pull-right info">
            <p>{{auth()->user()->name}}</p>
        </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="active">
            <a href="{{route('home')}}">
                <i class="fa fa-dashboard"></i> <span>داشبورد</span>
                <span class="pull-left-container">
            </span>
            </a>
        </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>مدیریت کاربران</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                        <li><a href="{{route('admin.user.wizard')}}"><i class="fa fa-circle-o"></i>ثبت کاربر جدید</a>
                        </li>

                        <li><a href="{{route('admin.user.show')}}"><i class="fa fa-circle-o"></i>لیست کاربران</a></li>


                        <li><a href="{{route('admin.user.alternatives')}}"><i class="fa fa-circle-o"></i>جایگزینی</a>
                        </li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>مدیریت بخش ها</span>
                    <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">

                        <li><a href="{{route('admin.role.wizard')}}"><i class="fa fa-circle-o"></i>ثبت بخش جدید</a></li>


                        <li><a href="{{route('admin.role.show')}}"><i class="fa fa-circle-o"></i>لیست بخش ها</a></li>
                </ul>
            </li>
    </ul>
</section>
<!-- /.sidebar -->
