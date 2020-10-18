<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <title>ورود به پنل مدیریت پولاد صنعت</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/public/icon/logo.png')}}"/>

    <link href="{{asset('/public/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('/public/assets/global/css/components-md-rtl.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{asset('/public/assets/pages/css/login-5-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
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
    <script src="{{asset('/public/assets/sweetalert.js')}}"></script>

</head>
<body class=" login" style="font-family: Shahab">
<div class="user-login-5">
    @if(session()->has('pass-success'))
        <script>
            Swal.fire({
                title: 'موفق',
                text: 'کلمه عبور جدید با موفقیت برای شما ارسال شد',
                icon: 'success',
                confirmButtonText: 'تایید',
            })
        </script>
    @endif
    @if(session()->has('pass-error'))
        <script>
            Swal.fire({
                title: 'خطا!',
                text: 'شماره وارد شده اشتباه است کاربری با این شماره در سیستم موجود نمیباشد',
                icon: 'error',
                confirmButtonText: 'تایید'
            })
        </script>
    @endif

    <div class="row bs-reset">
        <div class="col-md-6 bs-reset mt-login-5-bsfix">
            <div class="login-bg">
                <img src="{{url('/public/assets/pages/img/login/bg1.jpg')}}" width="104.3%">
                <img class="login-logo" src="{{url('/public/icon/logo.png')}}" width="150"/></div>
        </div>
        <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
            <div class="login-content">
                <h1>سیستم مدیریت پولاد صنعت</h1>
                <p>سیستم جامع مدیریت پولاد صنعت</p>
                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf
                    @if(session()->has('checkUser'))
                        <div id="alert" class="alert alert-danger alert-dismissible">
                            <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">
                                &times;
                            </button>
                            <h4><i class="icon fa fa-trash"></i>خطا!</h4>
                            کاربر عزیز دسترسی های شما غیر فعال شده است.
                        </div>

                    @endif

                    @if(session()->has('exit'))
                        <div id="alert" class="alert alert-info alert-dismissible">
                            <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">
                                &times;
                            </button>
                            <h4><i class="icon fa fa-trash"></i>به روز رسانی!</h4>
                            پرسنل عزیز نرم افزار در حال به روزرسانی میباشد لطفا صبر کنید
                        </div>

                    @endif
                    <div class="row">
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="text"
                                   autocomplete="off" placeholder="نام کاربری" name="email" required/>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="password"
                                   autocomplete="off" placeholder="کلمه عبور" name="password" required/></div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="rem-password">
                                <label class="rememberme mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" name="remember" value="1"/> من را بخاطر بسپار
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-8 text-right">
                            <div class="forgot-password">
                                <a href="javascript:;" id="forget-password" class="forget-password"><span
                                        style="color: blue">کلمه عبور را فراموش کرده ام؟</span></a>
                            </div>
                            <button class="btn green" type="submit">ورود به سیستم</button>
                        </div>
                    </div>
                </form>
                <form class="forget-form" action="{{route('admin.user.RestPassword')}}" method="post">
                    @csrf
                    <h3 class="font-green">کلمه عبور خود را فراموش کرده ام؟</h3>
                    <p> لطفا شماره همراهی که در سیستم ثبت شده است را وارد کنید. </p>
                    <div class="form-group">
                        <input class="form-control form-control-solid placeholder-no-fix form-group" type="text"
                               autocomplete="off"
                               placeholder="شماره همراه" name="phone" required/>
                    </div>
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn green btn-outline">بازگشت</button>
                        <input type="submit" class="btn btn-success uppercase pull-right" value="ارسال">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/public/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('/public/assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('/public/assets/global/plugins/backstretch/jquery.backstretch.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('/public//assets/pages/scripts/login-5.min.js')}}" type="text/javascript"></script>
</body>

</html>
