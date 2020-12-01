<!DOCTYPE html>
<html xml:lang="fa">
<head>
    <style>


        div.header {
            display: block;
            text-align: center;
            position: running(header);
        }

        div.footer {
            display: block;
            text-align: center;
            position: running(footer);
        }

        @page {
            @top-center {
                content: element(header)
            }
        }

        @page {
            @bottom-center {
                content: element(footer)
            }
        }
    </style>
    <title>سیستم مدیریت پولاد صنعت</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{url('/public/icon/logo.png')}}"/>
    <link
        rel="stylesheet"
        href="{{asset('/public/css/2.css')}}">
    <style>
        table {
            font-family: 'Far.YagutBold', Tahoma, Sans-Serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: right;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <style>
        @font-face {
            font-family: 'Far.YagutBold';
            src: url('{{asset('/public/font/Weblogma_Yekan.eot')}}');
            src: local('☺'),
            url('{{asset('/public/font/Far_Yagut.woff')}}') format('woff'),
            url('{{asset('/public/font/Far_Yagut.ttf')}}') format('truetype'),
            url('{{asset('/public/font/Far_Yagut.svg')}}') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        .myclass {
            font-family: 'Far.YagutBold', Tahoma, Sans-Serif;
            font-size: 3px;
        }


    </style>
    <style>
        th, td {
            border: 1px solid black;
            text-align: center;
        }

        hr {
            border-top: 1px solid black;
            margin-bottom: 0.4em;
            margin-top: 0.4em;
        }
    </style>
    <style type="text/css">
        textarea {
            border: 1px solid black;
            text-align: center;
        }
    </style>


</head>
<body dir="rtl" class="myclass" style="font-family: 'B Yekan'">
<br/>
<br/>
<div class="container-fluid">
    <div class="container-fluid">

        <table style="font-family: 'B Yekan' ; font-size: 35px">
            <thead>
            <th colspan="6" style="background-color: rgba(112,112,112,0.28)">برنامه تولید شماره {{$id}}</th>
            <tr>
                <th>محصول</th>
                <th>{{$products->label}} - {{$color->name}}</th>
            </tr>
            <tr>
                <th>درصد اختلاط : {{$production_information->Percentmasterbatch}}%</th>
                <th>طول زمان تولید : {{$ss}}</th>

            </tr>


            </thead>
            <tbody>
            </tbody>
        </table>

        <table style="font-family: 'B Yekan' ; font-size: 32px">
            <thead>
            <th colspan="6" style="background-color: rgba(112,112,112,0.28)">شرایط تولید</th>
            <tr>
                <th>کد قالب:&nbsp;&nbsp;&nbsp; {{$namee->name}}</th>
                <th>کد دستگاه:&nbsp;&nbsp;&nbsp;{{$devices->name}}</th>
                <th> نوع اختلاط: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>میکسر<input
                            type="checkbox"></label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label>دستی<input type="checkbox"></label>
                </th>
            </tr>

            </thead>
            <tbody>
            </tbody>
        </table>

        <table style="font-family: 'B Yekan' ; font-size: 35px">
            <thead>
            <th colspan="6" style="background-color: rgba(112,112,112,0.28)">مشخصه مواد مصرفی</th>
            @foreach($detail_production_information as $detail_production)
                @foreach($polymerics as $polymeric)
                    @if($detail_production->materials == $polymeric->id)
                        <tr>
                            <th>{{$polymeric->code}}</th>
                            <th>%{{$detail_production->percentage}}</th>
                            <?php
                            $p = $production_orders->number * $model_products->size / 1000;
                            $pp = $p * $detail_production->percentage;
                            ?>
                            <th>{{$pp}} (کیلوگرم)</th>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            <tr>
                <th>{{$colors->manufacturer}}       {{$colors->masterbatch}}</th>
                <th>%{{$production_information->Percentmasterbatch}}</th>
                <?php
                $rr = $production_orders->number * $model_products->size / 1000;
                $ttr = $rr * $production_information->Percentmasterbatch;
                ?>
                <th>{{$ttr}} (کیلوگرم)</th>
            </tr>

            </thead>
            <tbody>
            </tbody>
        </table>

        <table style="font-family: 'B Yekan' ; font-size: 35px">
            <thead>
            <th colspan="6" style="background-color: rgba(112,112,112,0.28)">ثبت درخواست تولید سفارشی</th>
            <tr>
                <th>تاریخ تولید:</th>
                <th>نوبت تولید:</th>
                <th>مسئول تولید:</th>
                <th>تعداد : {{$production_orders->number}}</th>
                <th>وزن محصول : {{$model_products->size}} (گرم)</th>


            </tr>
            <tr>
                <th colspan="5" style="text-align: right">توضیحات:</th>
            </tr>
            <tr>
                <th colspan="5" style="text-align: right">برنامه ریزی:<br/>امضاء؟</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <table style="font-family: 'B Yekan' ; font-size: 35px">
            <thead>
            <th colspan="7" style="background-color: rgba(112,112,112,0.28)">کنترل کیفیت تولید</th>
            <tr>
                <th colspan="7" style="text-align: right">
                    @if(!empty($qc_production->description))
                        <label> توضیحات: {{$qc_production->description}}</label>
                    @else
                        <label>توضیحات:</label>
                    @endif
                    <br/>
                    <br/>
                    @if(!empty($user->sign))
                        <img src="{{url($user->sign)}}" width="30">
                    @else
                        <label>امضاء؟</label>
                    @endif


                </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>


    </div>
</div>
</body>
</html>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/public/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $(document).ready(function () {
        persianToEnNumConvert();
        window.print();
    });

    function persianToEnNumConvert() {
        persianNums = {0: '۰', 1: '۱', 2: '۲', 3: '۳', 4: '۴', 5: '۵', 6: '۶', 7: '۷', 8: '۸', 9: '۹'};

        function change(el) {
            if (el.nodeType == 3) {
                var list = el.data.match(/[0-9]/g);
                if (list != null && list.length != 0) {
                    for (var i = 0; i < list.length; i++)
                        el.data = el.data.replace(list[i], persianNums[list[i]]);
                }
            }
            for (var i = 0; i < el.childNodes.length; i++) {
                change(el.childNodes[i]);
            }
        }

        change(document.body);
    }


</script>

