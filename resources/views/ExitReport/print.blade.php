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

                            <div class="col-md-3">
                                <center> نام مشتری : {{$name}}</center>
                            </div>
                            <div class="col-md-2">
                                <center> نام فروشنده : {{$namee}}</center>
                            </div>
                            <div class="col-md-2">
                                <center> از تاریخ : {{$in}}</center>
                            </div>
                            <div class="col-md-3">
                                <center> تا تاریخ : {{$to}}</center>
                            </div>
                            <div class="col-md-2">
                                <center> وضعیت پرداخت : {{$types}}</center>
                            </div>

                        </div>

                    </strong>
                    <br/>
                    <br/>
                    <table>
                        <thead>
                        <tr>
                            <th style="background-color: rgba(23,0,255,0.14)" colspan="8">گزارش خروج کالا</th>
                        </tr>
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>شماره فاکتور</th>
                            <th>تاریخ خروج</th>
                            <th>فروشنده</th>
                            <th>مشتری</th>
                            <th>تعداد محصول(عدد)</th>
                            <th>مبلغ فاکتور(ریال)</th>
                            <th>وضعیت پرداخت</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $number = 1;
                        $number_total = null;
                        $price_total = null;
                        ?>
                        @foreach($data as $dat)
                            <tr>
                                <td>{{$number++}}</td>
                                <td>{{$dat->pack_id}}</td>
                                <td>{{$dat->date}}</td>
                                <td>
                                    @foreach($users as $user)
                                        @if($user->id == $dat->user_id)
                                            {{$user->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($customers as $customer)
                                        @if($customer->id == $dat->customer_id)
                                            {{$customer->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$dat->total}}</td>
                                <td>{{number_format($dat->sum)}}</td>

                                @if($dat->payment == 1)
                                    <td style="background-color: rgba(8,71,255,0.28)">پرداخت شده</td>
                                @else
                                    <td style="background-color: rgba(255,0,0,0.36)">پرداخت نشده</td>
                                @endif

                            </tr>
                            <?php
                            $number_total += $dat->total;
                            $price_total += $dat->sum;
                            ?>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr style="background-color: rgba(0,162,60,0.31)">
                            <th colspan="5">جمع کل</th>
                            <th>{{$number_total}}</th>
                            <th>{{number_format($price_total)}}</th>
                            <th></th>
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


