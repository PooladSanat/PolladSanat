<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>سیستم مدیریت پولاد</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('/public/dist/css/bootstrap-theme.css')}}">
    <!-- Bootstrap rtl -->
    <link rel="stylesheet" href="{{asset('/public/dist/css/rtl.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/public/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('/public/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/public/dist/css/AdminLTE.css')}}">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        @font-face {
            font-family: 'Shahab';
            src: url('http://cdn.font-store.ir/fonts/shahab/Shahab-Regular.woff2') format('woff2'),
            url('http://cdn.font-store.ir/fonts/shahab/Shahab-Regular.woff') format('woff'),
            url('http://cdn.font-store.ir/fonts/shahab/Shahab-Regular.ttf') format('truetype'),
            url('http://cdn.font-store.ir/fonts/shahab/Shahab-Regular.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }
    </style>
</head>
<body class="hold-transition lockscreen" style="font-family: Shahab">
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <a href="#"><b>پنل کاربری پولاد پویش</b></a>
    </div>
    <div class="lockscreen-name">{{auth()->user()->name}}</div>

    @foreach(auth()->user()->roles as $role)
        <div class="lockscreen-name" style="color: red">{{$role->name}}</div>
    @endforeach
    <div class="lockscreen-item">
        <div class="lockscreen-image">
            @if(!empty(auth()->user()->avatar))
                <img src="{{url(auth()->user()->avatar)}}" alt="User Image">
            @else
                <img src="{{url('/public/icon/male-user.png')}}" alt="User Image">
            @endif
        </div>
        <form class="lockscreen-credentials">
            <div class="input-group">
                <input type="password" class="form-control" placeholder="کلمه عبور">

                <div class="input-group-btn">
                    <button type="button" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="help-block text-center">
        برای ورود مجدد کلمه عبور خود را وارد کنید
    </div>
    <div class="lockscreen-footer text-center">
        <b>تمام حقوق این سیستم متعلق به <a>گروه صنعتی پولاد پویش</a> میباشد.</b>
    </div>
</div>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/public/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
</body>
</html>
