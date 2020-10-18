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
                    <strong> به : </strong>
                    <br/>
                    <strong>موضوع : صورت حساب</strong>
                </div>
                <div class="col-sm-4">
                    <br/>
                    <strong> تاریخ: {{\Morilog\Jalali\Jalalian::forge(\Carbon\Carbon::now())->format('Y/m/d')}}</strong>
                </div>
            </div>
            <br/>
            <p>احتراما، بدینوسیله صورت حساب اقلام خریداری شده آن شرکت جهت بررسی تقدیم حضور می گردد. خواهشمند است در صورت
                تایید ذیل این برگه را مهر و امضا نموده به شماره 77327573 نمابر نمایید.</p>
            <table>
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>شماره فاکتور</th>
                    <th>تاریخ فاکتور</th>
                    <th>مبلغ فاکتور(ریال)</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $number = 1;
                $sum = 1;
                $sum_price = 0;
                ?>
                @foreach($factors as $factor)
                    <tr>
                        <td>{{$number++}}</td>
                        <td>{{$factor->pack_id}}</td>
                        <td>{{$factor->date}}</td>
                        <td>{{number_format($factor->sum)}}</td>
                    </tr>
                    <?php
                    $sum_price += $factor->sum;
                    ?>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3">جمع صورتحساب</th>
                    <th>{{number_format($sum_price)}}</th>
                </tr>




                </tfoot>
            </table>
            <br/>
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


                        <img src="" width="270">


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


