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
            <table>
                <thead>
                <tr>
                    <th>
                        <table>
                            <thead>
                            <tr>
                                <th>
                                    <h4 style="text-align: center">فاکتور فروش</h4>
                                    <br/>
                                    <div class="row">
                                        <div class="col-sm-10">

                                        </div>
                                        <div class="col-sm-2">
                                            <br/>
                                            @if(!empty($factor))
                                                <strong> شماره: {{$factor->number_factor}}</strong>
                                            @else
                                                <strong> شماره: {{$check->number_factor}}</strong>
                                            @endif
                                            <br/>
                                            <strong>
                                                تاریخ: {{\Morilog\Jalali\Jalalian::forge(date('Y/m/d'))->format('Y/m/d')}} </strong>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                        </table>
                        <table>
                            <thead>
                            <tr>
                                <th width="142">فروشنده</th>
                                <th>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <strong> نام فروشنده: پولاد پویش </strong>
                                            <br/>
                                            <strong> نشانی: تهران - شهرک صنعتی پرند - میدان فناوری - خیبان گلریز -
                                                خیابان بوستان شرقی - پلاک B29 </strong>
                                        </div>
                                        <div class="col-sm-4">
                                            <strong> کد اقتصادی: </strong>
                                            <br/>
                                            <strong> کد پستی: </strong>
                                        </div>
                                    </div>

                                </th>
                            </tr>
                            </thead>
                        </table>

                        <table>
                            <thead>
                            <tr>
                                <th width="142">خریــدار</th>
                                <th>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <strong> نام خریدار: {{$customers->name}} </strong>
                                            <br/>
                                            @if(!empty($customer_company))
                                                <strong> نشانی: {{$customer_company->adders_company}} </strong>
                                            @else
                                                <strong> نشانی: {{$customer_personal->adders_personel}} </strong>
                                            @endif
                                        </div>
                                        <div class="col-sm-7">
                                            <strong> کد اقتصادی: </strong>
                                            <br/>
                                            <strong> کد پستی: </strong>
                                            <br/>
                                            @if(!empty($customer_company))
                                                <strong> تلفن: {{$customer_company->tel_company}}</strong>
                                            @else
                                                <strong> تلفن: {{$customer_personal->phone_personel}}</strong>
                                            @endif

                                        </div>
                                    </div>

                                </th>
                            </tr>
                            </thead>
                        </table>

                        <table style="font-family: 'B Yekan'">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>کد محصول</th>
                                <th>نام محصول</th>
                                <th>رنگ محصول</th>
                                <th>تعداد(عدد)</th>
                                <th>فی(ریال)</th>
                                <th>مبلغ(ریال)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $number = 1;
                            $total = 0;
                            $totalall = 0;
                            ?>
                            @foreach($products as $product)
                                @foreach($invoice_products as $invoice_product)
                                    @if($invoice_product->id == $product->detail_id)
                                        @php
                                            $totalall += $total;
                                        @endphp
                                        <tr>
                                            <th>{{$number++}}</th>
                                            <th>{{$invoice_product->product_id}}</th>
                                            <th>
                                                @foreach($pooducts as $pooduct)
                                                    @if($invoice_product->product_id == $pooduct->id)
                                                        {{$pooduct->label}}
                                                    @endif

                                                @endforeach

                                            </th>
                                            <th>
                                                @foreach($colors as $color)
                                                    @if($invoice_product->color_id == $color->id)
                                                        {{$color->name}}
                                                    @endif

                                                @endforeach

                                            </th>
                                            <th>{{$product->total}}</th>
                                            <th>{{number_format($invoice_product->salesPrice)}}</th>
                                            @php($total = $invoice_product->salesPrice * $product->total)
                                            <th>{{number_format($total)}}</th>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach


                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="5" style="border: 1px"></th>
                                <th>

                                    <strong>جمع مبلغ</strong>
                                    <hr/>

                                    <strong>کرایه حمل</strong>
                                    <hr/>

                                    <strong>تخفیف مقداری</strong>
                                    <hr/>

                                    <strong>جمع اضافات</strong>
                                    <hr/>

                                    <strong>جمع کسور</strong>
                                    <hr/>

                                    <strong>جمع کل</strong>
                                </th>
                                <th>
                                    @php($sum = $totalall+$total)
                                    <strong>{{number_format($sum)}}</strong>
                                    <hr/>

                                    <strong>0</strong>
                                    <hr/>

                                    <strong>{{number_format($invoices->ta)}}</strong>
                                    <hr/>

                                    <strong>0</strong>
                                    <hr/>

                                    <strong>0</strong>
                                    <hr/>
                                    <strong>{{number_format(abs($sum-$invoices->ta))}}</strong>
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                        <table>
                            <thead>
                            <tr>
                                <th height="60px" width="142">توضیحات</th>
                                <th>{{$customers->description}}</th>
                            </tr>

                            </thead>
                        </table>
                        <table>
                            <thead>
                            <tr>
                                <th height="100px">امضا فروشنده</th>
                                <th>امضا خریدار</th>
                            </tr>

                            </thead>
                        </table>
                    </th>
                </tr>
                </thead>
            </table>


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


