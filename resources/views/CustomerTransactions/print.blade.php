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
    <title>سیستم مدیریت پولاد پویش</title>

    <style>
        @media print {
            .control-group {
                display: none;
            }
        }
    </style>
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
            font-size: 17px;
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">


                    <strong>
                        <div class="row">

                            <div class="col-md-4">
                                <center> لیست تراکنش : {{$name->name}}</center>
                            </div>
                            <div class="col-md-4">
                                <center> از تاریخ : {{$in}}</center>
                            </div>
                            <div class="col-md-4">
                                <center> تا تاریخ : {{$to}}</center>
                            </div>

                        </div>

                    </strong>
                    <br/>
                    <br/>
                    <table>
                        <thead>
                        <tr>
                            <th colspan="5" style="background-color: rgba(0,162,60,0.45)">لیست تراکنش</th>
                        </tr>
                        <tr>
                            <th>ردیف</th>
                            <th>تاریخ</th>
                            <th>شرح</th>
                            <th>بدهکار(ریال)</th>
                            <th>بستانکار(ریال)</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $number = 1;
                        $total = null;
                        $tsum = 0;
                        $tprice = 0;
                        ?>
                        @foreach($clearings as $clearing)
                            <tr>
                                <th>{{$number ++}}</th>
                                <th>{{$clearing->date}}</th>

                                @if(!empty($clearing->return_id))
                                    <th> بستانکار بابت مرجوعی با کد {{$clearing->return_id}}</th>
                                @else
                                    @if(!empty($clearing->price))
                                        <th>{{$clearing->descriptionn}}</th>
                                    @else
                                        <th> بدهی بابت فاکتور {{$clearing->rahkaran}}</th>
                                    @endif
                                @endif

                                @if(!empty($clearing->sum))
                                    <th style="background-color: rgba(255,0,0,0.3)">{{number_format($clearing->sum)}}</th>
                                @else
                                    <th>{{number_format($clearing->sum)}}</th>
                                @endif

                                @if(!empty($clearing->price))
                                    <th style="background-color: rgba(23,0,255,0.26)">{{number_format($clearing->price)}}</th>
                                @else
                                    <th>{{number_format($clearing->price)}}</th>
                                @endif


                            </tr>
                            <?php
                            $tsum += $clearing->sum;
                            $tprice += $clearing->price;
                            ?>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>جمع کل</th>
                            <th></th>
                            <th></th>
                            <th>{{number_format($tsum)}}</th>
                            <th>{{number_format($tprice)}}</th>

                        </tr>
                        <tr>
                            <th colspan="3">باقیمانده حساب مشتری</th>
                            @if($tprice - $tsum > 0)
                                <th>0</th>
                                <th style="background-color: rgba(0,183,255,0.4)">{{number_format(abs($tprice - $tsum))}}</th>
                            @elseif($tprice - $tsum < 0)
                                <th style="background-color: rgba(255,0,0,0.4)">{{number_format(abs($tprice - $tsum))}}</th>
                                <th>0</th>
                            @else
                                <th>0</th>
                                <th>0</th>
                            @endif

                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
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


