<!DOCTYPE html>
<html xml:lang="fa">
<head>
    <style>
        .center {
            margin-left: auto;
            margin-right: auto;
        }

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

            #printer {
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
            padding: 5px;
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
        <?php
        $sum_invoice = null;
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">

                    <table>
                        <thead>
                        <tr>
                            <th width="20%">
                                <img width="40%" src="{{asset('/public/icon/logo.jpeg')}}">
                            </th>
                            <th width="50%"><h4>فرم اعلام محصول صندلی مرجوعی</h4></th>
                            <th width="20%" style="text-align: right">
                                تاریخ: {{$date}}
                                <br/>
                                شماره: {{$id}}
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3" style="background-color: rgba(135,142,145,0.18)">
                                    <span
                                        style="text-align: center;font-size: 15px">اعلام مشخصات مشتری و کالای مرجوعی</span>
                            </th>

                        </tr>
                        <tr>
                            <th colspan="3">
                                <br/>
                                <h6 style="text-align: right"><strong>نام مشتری:</strong> {{$customer_name->name}}</h6>
                                <h6 style="text-align: right"><strong>تاریخ خروج از انبار (بار اصلی
                                        مشتری):</strong> {{$invoices_date->date}}</h6>
                                <br/>
                                <table style="width: 60%" class="center">
                                    <thead style="background-color: rgba(135,142,145,0.18)">
                                    <tr>
                                        <th>نام کالای مرجوعی</th>
                                        <th>رنگ</th>
                                        <th>تعداد(عدد)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($detail_return as $item)
                                        <tr>
                                            <td>
                                                @foreach($products as $product)
                                                    @if($product->id == $item->product_id)
                                                        {{$product->label}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($colors as $color)
                                                    @if($color->id == $item->color_id)
                                                        {{$color->name}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$item->number}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <br/>
                                <h6 style="text-align: right"><strong>دلایل مشتری عودت
                                        محصول:</strong> {{$returns->Description_m}}</h6>
                                <h6 style="text-align: right"><strong>دلایل فروش جهت پذیرش محصول مشتری
                                        مرجوعی:</strong> {{$returns->Description_v}}</h6>
                                <h6 style="text-align: right"><strong>هزینه حمل:</strong> {{$returns->Cost}}</h6>
                                <br/>
                                @if(!empty($sign))
                                    <img src="{{url($sign->sign)}}" width="150">
                                @else
                                    <h6 style="text-align: center">نام و امضاء مدیر فروش:</h6>
                                @endif

                            </th>
                        </tr>
                        <tr>
                            <th colspan="3" style="background-color: rgba(135,142,145,0.18)">
                                    <span
                                        style="text-align: center;font-size: 15px">مجوز مرجوع نمودن بار توسط مشتری (قائم مقام مدیر عامل)</span>

                            </th>

                        </tr>
                        <tr>
                            <th colspan="3">
                                <h6 style="text-align: right">بدینوسیله با مرجوع نمودن محصول توسط مشتری به شرح فوق به
                                    انبار
                                    موافقت میگردد</h6>
                                @if(!empty($sign_))
                                    <img src="{{url($sign_->sign)}}" width="150">
                                @else
                                    <h6 style="text-align: center">امضاء:</h6>
                                @endif
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3" style="background-color: rgba(135,142,145,0.18)">
                                    <span
                                        style="text-align: center;font-size: 15px">اعلام مشخصات کمی کالای مرجوعی (انبار)</span>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3">
                                @if(!empty($sign__))
                                    <h6 style="text-align: right"><strong>تاریخ
                                            دریافت: </strong>{{\Morilog\Jalali\Jalalian::forge($barn->created_at)->format('Y/m/d')}}
                                    </h6>
                                @endif
                                <table>
                                    <thead style="background-color: rgba(135,142,145,0.18)">
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام کالا</th>
                                        <th>رنگ</th>
                                        <th>تعداد(عدد)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $number = 1;
                                    ?>
                                    @foreach($barn_temporaries as $item)
                                        <tr>
                                            <td>{{$number++}}</td>
                                            <td>
                                                @foreach($products as $product)
                                                    @if($product->id == $item->product_id)
                                                        {{$product->label}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($colors as $color)
                                                    @if($color->id == $item->color_id)
                                                        {{$color->name}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$item->number}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <br/>
                                @if(!empty($sign__))
                                    <img src="{{url($sign__->sign)}}" width="150">
                                @else
                                    <h6 style="text-align: center">امضاء مدیر انبار:</h6>
                                @endif
                            </th>


                        </tr>
                        <tr>
                            <th colspan="3" style="background-color: rgba(135,142,145,0.18)">
                                    <span
                                        style="text-align: center;font-size: 15px">اعلام وضعیت کیفی کالای مرجوعی (کنترل کیفیت)</span>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3">

                                <table>
                                    <thead style="background-color: rgba(135,142,145,0.18)">
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام کالا</th>
                                        <th>رنگ</th>
                                        <th>تعداد کل</th>
                                        <th>تعداد سالم</th>
                                        <th>تعداد معیوب(مشتری)</th>
                                        <th>تعداد معیوب(پولاد)</th>
                                    </tr>
                                    </thead>
                                    @if(!empty($qc))
                                        <tbody>
                                        <?php
                                        $number = 1;
                                        ?>
                                        @foreach($detail_return as $item)
                                            <tr>
                                                <td>{{$number++}}</td>
                                                <td>
                                                    @foreach($products as $product)
                                                        @if($product->id == $item->product_id)
                                                            {{$product->label}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($colors as $color)
                                                        @if($color->id == $item->color_id)
                                                            {{$color->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{$item->number}}</td>
                                                <td>{{$item->Healthy}}</td>
                                                <td>{{$item->wastage}}</td>
                                                <td>{{$item->wastagem}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    @endif
                                </table>
                                <br/>

                                @if(!empty($sign___))
                                    <img src="{{url($sign___->sign)}}" width="150">
                                @else
                                    <h6 style="text-align: center">امضاء مدیر کنترل کیفیت:</h6>
                                @endif
                            </th>
                        </tr>
                        <tr>
                            <table>
                                <thead>
                                <tr>
                                    <th style="background-color: rgba(135,142,145,0.18)">
                                        @if(!empty($sign_->statustwo))
                                            <span
                                                style="text-align: center;font-size: 15px">{{$admin->descriptiontwo}}</span>
                                        @else
                                            <span style="text-align: center;font-size: 15px">اعلام نظر قائم مقام مدیر عمل در شرکت پولاد</span>
                                        @endif

                                    </th>
                                    <th colspan="3">
                                        <br/>
                                        @if(!empty($sign_->statustwo))
                                            <img src="{{url($sign_->sign)}}" width="150">
                                        @else
                                            <h6 style="text-align: center">امضاء قائم مقام:</h6>
                                        @endif

                                    </th>
                                </tr>
                                </thead>
                            </table>

                        </tr>
                        <tr>

                        </tr>
                        </thead>
                    </table>


                    <br/>
                    <br/>
                    <a class="btn btn-primary" href="javascript:void(0)" id="printer">تهیه نسخه چاپی</a>
                    <br/>

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

    });

    $('#printer').click(function () {
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


