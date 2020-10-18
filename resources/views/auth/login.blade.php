<!DOCTYPE html>
<html lang="en">
<head>
    <title>ورود به پنل مدیریت پولاد صنعت</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/public/icon/logo.png')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('/public/login/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('/public/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('/public/login/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('/public/login/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('/public/login/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('/public/login/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/public/login/css/main.css')}}">

    <link rel="shortcut icon" type="image/x-icon" href="{{url('/public/icon/logo.png')}}"/>

    <link href="{{asset('/public/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('/public/assets/global/css/components-md-rtl.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{asset('/public/assets/pages/css/login-5-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('/public/assets/sweetalert.js')}}"></script>
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
    <!--===============================================================================================-->
</head>
<body style="font-family: Shahab">

<div class="limiter">
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
    <div class="container-login100">

        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{asset('/public/login/images/img-01.png')}}" alt="IMG">
            </div>

            <form autocomplete="off" class="login100-form" method="POST" action="{{ route('login') }}">

                @csrf
					<span class="login100-form-title">
						<strong style="font-family: Shahab">سیستم مدیریت پولاد صنعت</strong>
					</span>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="email" placeholder="نام کاربری" autocomplete="off">
                    <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                    @error('email')
                    <span role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="password" name="password" placeholder="کلمه عبور" autocomplete="off">
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                    @error('password')
                    <span role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="container-login100-form-btn">
                    <button style="font-family: Shahab;font-size: 18px" class="login100-form-btn">
                        ورود به سیستم
                    </button>
                </div>




                <div class="text-center p-t-136">
                    <a class="txt2" href="#">
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<!--===============================================================================================-->
<script src="{{asset('/public/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('/public/login/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('/public/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('/public/login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('/public/login/vendor/tilt/tilt.jquery.min.js')}}"></script>
<script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="{{asset('/public/login/js/main.js')}}"></script>
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
