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

        <img width="130" src="{{asset('/public/icon/logo.jpeg')}}">
        <br/>
        <strong>
            <center>بسمه تعالی</center>
        </strong>
        <!-- Control the column width, and how they should appear on different devices -->
        <div class="row">
            <div class="col-sm-8">
                <br/>
                <strong>از : شرکت قطعات پلاستیک پولاد پویش</strong>
                <br/>
                <strong> به : {{$customer->name}}</strong>
                <br/>
                <strong>موضوع : پیش فاکتور</strong>
            </div>
            <div class="col-sm-4">
                <br/>
                <strong> شماره: {{$id->invoiceNumber}}</strong>
                <br/>
                <strong> تاریخ: {{\Morilog\Jalali\Jalalian::forge(date('Y/m/d'))->format('Y/m/d')}}</strong>
            </div>
        </div>
        <br/>
        <p>احتراما، بدینوسیله پیش فاکتور اقلام مورد نیاز آن شرکت جهت بررسی تقدیم حضور می گردد. خواهشمند است در صورت
            تایید ذیل این برگه را مهر و امضا نموده به شماره 77327573 نمابر نمایید.</p>
        <table style="font-family: 'B Yekan'">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>نوع محصول</th>
                <th>رنگ</th>
                <th>تعداد(عدد)</th>
                <th>قیمت واحد(ریال)</th>
                <th>قیمت کل(ریال)</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $number = 1;
            ?>
            @foreach($invoice_products as $invoice_product)
                <tr>
                    <td>{{$number++}}</td>
                    <td>
                        @foreach($products as $product)
                            @if($product->id == $invoice_product->product_id)
                                {{$product->label}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($colors as $color)
                            @if($color->id == $invoice_product->color_id)
                                {{$color->name}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$invoice_product->salesNumber}}</td>
                    <td>{{number_format($invoice_product->salesPrice)}}</td>
                    <td>{{number_format($invoice_product->sumTotal)}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="3">تعداد کل</th>
                <th><label>{{$id->number_sell}}</label></th>
                <th><label>جمع مبلغ</label></th>
                <th><label>{{number_format($id->price_sell)}}</label></th>
            </tr>
            <tr>
                <th colspan="4" style="border: 1px"></th>
                <th>
                    @if(!empty($id->takhfif))
                        <strong>تخفیف</strong>
                        <hr/>
                    @endif
                    @if(!empty($id->expenses))
                        <strong>سایر هزینه ها</strong>
                        <hr/>
                    @endif
                    @if(!empty($id->Carry))
                        <strong>هزینه ارسال</strong>
                        <hr/>
                    @endif
                    @if(!empty($id->ma))
                        <strong>مالیات</strong>
                        <hr/>
                    @endif
                    <strong>جمع کل</strong>
                </th>
                <th>
                    @if(!empty($id->takhfif))
                        <strong>{{number_format($id->ta)}}</strong>
                        <hr/>
                    @endif
                    @if(!empty($id->expenses))
                        <strong>{{number_format($id->expenses)}}</strong>
                        <hr/>
                    @endif
                    @if(!empty($id->Carry))
                        <strong>{{number_format($id->Carry)}}</strong>
                        <hr/>
                    @endif
                    @if($id->ma != 0)
                        <strong>{{number_format($id->ma)}}</strong>
                        <hr/>
                    @endif
                    <strong> {{number_format($id->totalfinal)}}</strong>
                </th>
            </tr>
            </tfoot>
        </table>
        <br/>
        <p> نحوه پرداخت : {{$id->paymentMethod}}</p>
        <p> شماره حساب {{$bank->AccountNumber}} و یا شماره کارت {{$bank->CardNumber}} و یا شماره
            شبا {{$bank->ShabaNumber}}
            {{$bank->NameBank}} به نام {{$bank->name}}</p>
        <p> محل تحویل : {{$selectstore->name}}</p>
        @if(!empty($time))
            <p> زمان تحویل : {{$time}}</p>
        @endif
        <p> تاریخ اعتبار پیش فاکتور : {{$date}}</p>
        <br/>

        <li>در صورت تایید پیش فاکتور، باید کلیه اسناد مالی حاصل فروش قبل از تاریخ صدور مجوز بارگیری به واحد مالی شرکت
            قطعات پلاستیک پولاد پویش تحویل گردد.
        </li>
        <li>با توجه به توافق فی مابین در این پیش فاکتور و تایید جنابعالی در خصوص مدت بازپرداخت آن، در صورت تاخیر در
            پرداخت، هزینه تاخیر تادیه آن به میزان 3% ماهیانه و به صورت روزشمار محاسبه گشته وبه حساب بدهی شما منظور می
            گردد.
        </li>
        <li>حمل هر نوبت کالا منوط به تحویل کلیه اسناد مالی به فاکتورهای صادرشده قبلی است.</li>
        @if(!empty($description))
            <li>{{$description}}</li>
        @endif

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                <textarea disabled rows="10" cols="50">
                    در صورت تایید با درج نام خود مهر و امضا نمایید
                </textarea>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <p style="font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;با
                        تشکر</p>
                    <p style="font-size: 20px">شرکت قطعات پلاستیک پولاد پویش</p>

                    @if(!empty($user_id->sign))

                        <img src="{{url($user_id->sign)}}" width="270">
                    @endif

                    <p style="font-size: 11px">تهران ، تهرانپارس ، خیابان ناهــید ، خیابان میوه ، خیابان صـبوری ،
                        شماره
                        1</p>
                    <p style="font-size: 10px">تلفن:02177333337&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;www.pooladimm.com&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;کد
                        پستی:1658614511</p>
                    <p style="font-size: 10px">فکس:77327573&nbsp;&nbsp;&nbsp;info@pooladimm.com&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;صندوق
                        پستی:16895111</p>
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

