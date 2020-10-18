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
                                <center> صورت وضعیت : {{$name->name}}</center>
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
                            <th>ردیف</th>
                            <th>کد صورت حساب</th>
                            <th>تاریخ صدور</th>
                            <th>مبلغ صورت حساب(ریال)</th>
                            <th>جمع اسناد دریافتی(ریال)</th>
                            <th>مانده حساب(ریال)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $number = 1;
                        $total = null;
                        ?>
                        @foreach($clearings as $clearing)
                            <tr>
                                <th>{{$number ++}}</th>
                                <th>{{$clearing->id}}</th>
                                <th>{{$clearing->date}}</th>
                                <th>{{number_format($clearing->price)}}</th>
                                <th>
                                    {{number_format(DB::table('detail_customer_payment')
                                       ->where('payment_id',$clearing->id)
                                       ->sum('price'))}}
                                </th>

                                <?php
                                $s = DB::table('detail_customer_payment')
                                        ->where('payment_id', $clearing->id)
                                        ->sum('price') - $clearing->price;
                                ?>
                                @if($s == 0)
                                    <th style="background-color: rgba(144,221,251,0.73)">
                                        {{number_format($s)}}
                                    </th>
                                @elseif($s < 0)
                                    <th style="background-color: rgba(255,106,107,0.6)">
                                        {{number_format($s)}}
                                    </th>
                                @else
                                    <th style="background-color: rgba(204,255,141,0.67)">
                                        {{number_format($s)}}
                                    </th>
                                @endif

                                <?php
                                $total += $s;
                                ?>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot align="right">
                        <tr>
                        <tr>
                            <th colspan="5">جمع کل</th>
                            <th id="sum_j">{{number_format($total)}}</th>
                        </tr>
                        <tr>
                            <th colspan="5">مانده حساب مشتری</th>
                            <th id="sum_m">{{number_format($sumcustomer->creditor)}}</th>
                        </tr>
                        <tr>
                            <th colspan="5">جمع مبالغ فاکتورهای در جریان</th>
                            <th id="sum_j">{{number_format($sumtotal)}}</th>
                        </tr>
                        <tr>
                            <th colspan="5">صورت وضعیت</th>
                            @if($sumcustomer->creditor - $sum == 0)
                                <th style="background-color: rgba(144,221,251,0.73)">
                                    {{number_format($sumcustomer->creditor - $sum)}}
                                </th>
                            @elseif($sumcustomer->creditor - $sum < 0)
                                <th style="background-color: rgba(255,106,107,0.6)">
                                    {{number_format($sumcustomer->creditor - $sum)}}
                                </th>
                            @else
                                <th style="background-color: rgba(204,255,141,0.67)">
                                    { {{number_format($sumcustomer->creditor - $sum)}}
                                </th>
                            @endif
                        </tr>
                        </tfoot>
                    </table>

                    <br/>
                    <br/>

                    <table>
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th colspan="13">
                                <center style="text-align: center">پرداختی های مشتری</center>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>نوع سند</th>
                            <th>شماره سند</th>
                            <th>تاریخ سر رسید</th>
                            <th>بانک</th>
                            <th>نام صادر کننده</th>
                            <th>مبلغ</th>
                            <th>وصول</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $number = 1;
                        ?>
                        @foreach($detail_customer_payments as $detail_customer_payment)
                            <tr>

                                <th>{{$number ++}}</th>
                                <th>
                                    @if($detail_customer_payment->type == 1)
                                        نقدی
                                    @else
                                        چکی
                                    @endif
                                </th>
                                <th>{{$detail_customer_payment->shenase}}</th>
                                <th>{{$detail_customer_payment->date}}</th>
                                <th>{{$detail_customer_payment->name}}</th>
                                <th>{{$detail_customer_payment->name_user}}</th>
                                <th>{{number_format($detail_customer_payment->price)}}</th>
                                <th>
                                    @if($detail_customer_payment->type == 1)
                                        پرداخت شده
                                    @else
                                        @if($detail_customer_payment->status == 1)
                                            بدون وضعیت
                                        @elseif($detail_customer_payment->status == 2)
                                            پرداخت شده
                                        @else
                                            برگشت خورده
                                        @endif
                                    @endif
                                </th>


                            </tr>
                        @endforeach
                        </tbody>
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


