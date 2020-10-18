<!DOCTYPE html>
<html xml:lang="fa">
<head>
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
            font-family: 'Far.YagutBold', Tahoma;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            font-family: 'Far.YagutBold', Tahoma, Sans-Serif;
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
<div class="container-fluid">
    <div class="container-fluid">
        <!-- Control the column width, and how they should appear on different devices -->

        <table>
            <thead>
            <tr>
                <th style="background-color: rgba(8,71,255,0.23)" colspan="9">اطلاعات پایه</th>
            </tr>
            <tr>
                <th>کد راهکاران</th>
                <th>نام</th>
                <th>کشور</th>
                <th>استان</th>
                <th>منطقه</th>
                <th>کارشناس</th>
                <th>نوع مشتری</th>
                <th>نحوه اشنایی</th>
                <th>تاریخ ثبت در سیستم</th>
            </tr>
            </thead>
            <tbody>
            <td>{{$id->code}}</td>
            <td>{{$id->name}}</td>
            <td>{{$country->name}}</td>
            <td>{{$city->name}}</td>
            <td>
                @foreach($areass as $areas)
                    @if($id->staate == $areas->id)
                        {{$areas->areas}}
                    @endif
                @endforeach

            </td>
            <td>{{$user->name}}</td>
            <td>{{$type->name}}</td>
            <td>{{$id->method}}</td>
            <td>{{\Morilog\Jalali\Jalalian::forge($id->created_at)->format('Y/m/d')}}</td>
            </tbody>
        </table>
    </div>
    <br/>
    @if($type->type == 2)
        <div class="container-fluid">
            <!-- Control the column width, and how they should appear on different devices -->
            <table>
                <thead>

                <tr>
                    <th style="background-color: rgba(8,71,255,0.23)" colspan="7">اطلاعات تکمیلی</th>
                </tr>
                <tr>
                    <th>جنسیت</th>
                    <th>تلفن همراه</th>
                    <th>تلفن ثابت</th>
                    <th>فکس</th>
                    <th>کد ملی</th>
                    <th>تاریخ تولد</th>
                    <th>ایمیل</th>
                </tr>
                </thead>
                <tbody>
                <td>
                    @if($personel->sex == 1)
                        مرد
                    @else
                        زن
                    @endif
                </td>
                <td>{{$personel->phone_personel}}</td>
                <td>{{$personel->tel_personel}}</td>
                <td>{{$personel->fax_personel}}</td>
                <td>{{$personel->codemeli_personel}}</td>
                <td>{{$personel->date_personel}}</td>
                <td>{{$personel->email_personel}}</td>
                </tbody>
                <tfoot>
                <tr>
                    <th>آدرس</th>
                    <th colspan="7">{{$personel->adders_personel}}</th>
                </tr>
                <tr>
                    <th>توضیحات</th>
                    <th colspan="7">{{$personel->text_personel}}</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <br/>
    @endif
    @if($type->type == 1)
        <div class="container-fluid">
            <!-- Control the column width, and how they should appear on different devices -->
            <table>

                <thead>
                <tr>
                    <th style="background-color: rgba(8,71,255,0.23)" colspan="8">اطلاعات فردی</th>
                </tr>
                <tr>
                    <th>تلفن دفتر</th>
                    <th>کد پستی</th>
                    <th>سال تاسیس</th>
                    <th>فکس دفتر</th>
                    <th>تلفن همراه</th>
                    <th>تاریخ تولد</th>
                    <th>ایمیل</th>
                    <th>کد ملی</th>
                </tr>
                </thead>
                <tbody>
                <td>{{$customer->tel_company}}</td>
                <td>{{$customer->post_company}}</td>
                <td>{{$customer->Established_company}}</td>
                <td>{{$customer->fax_company}}</td>
                <td>{{$customer->phone_company}}</td>
                <td>{{$customer->date_birth}}</td>
                <td>{{$customer->email_company}}</td>
                <td>{{$customer->national_company}}</td>
                </tbody>
                <tfoot>
                <tr>
                    <th>آدرس دفتر مرکزی</th>
                    <th colspan="7">{{$customer->adders_company}}</th>
                </tr>
                <tr>
                    <th>آدرس منزل</th>
                    <th colspan="7">{{$customer->home}}</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <br/>
        <div class="container-fluid">
            <!-- Control the column width, and how they should appear on different devices -->
            <table>
                <thead>
                <tr>
                    <th style="background-color: rgba(8,71,255,0.23)" colspan="8">اطلاعات محل کار</th>
                </tr>
                <tr>
                    <th>نام فروشگاه</th>
                    <th>سال تاسیس</th>
                    <th>تلفن انبار</th>
                </tr>
                </thead>
                <tbody>
                <td>{{$work->name_work_company}}</td>
                <td>{{$work->date_work_company}}</td>
                <td>{{$work->tel_work_company}}</td>
                </tbody>
                <tfoot>
                <tr>
                    <th>ادرس محل فعالیت</th>
                    <th colspan="7">{{$work->activity_work_company}}</th>
                </tr>
                <tr>
                    <th>سایر فعالیت ها</th>
                    <th colspan="7">{{$work->oactivity_work_company}}</th>
                </tr>
                <tr>
                    <th>ادرس انبارا</th>
                    <th colspan="7">{{$work->addersstore_work_company}}</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <br/>
        <div class="container-fluid">
            <!-- Control the column width, and how they should appear on different devices -->
            <table>
                <thead>
                <tr>
                    <th style="background-color: rgba(8,71,255,0.23)" colspan="8">وضعیت بانکی و اعتباری</th>
                </tr>
                <tr>
                    <th>نام بانک</th>
                    <th>شعبه</th>
                    <th>شماره حساب جاری</th>
                    <th>تاریخ افتتاح حساب</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banks as $bank)
                    <tr>
                        <td>{{$bank->name_bank_company}}</td>
                        <td>{{$bank->branch_bank_company}}</td>
                        <td>{{$bank->account_bank_company}}</td>
                        <td>{{$bank->date_bank_company}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <br/>
        <div class="container-fluid">
            <!-- Control the column width, and how they should appear on different devices -->
            <table>
                <thead>
                <tr>
                    <th style="background-color: rgba(8,71,255,0.23)" colspan="8">اسامی تامیین کنندگان</th>
                </tr>
                <tr>
                    <th>نام شرکت/شخص</th>
                    <th>تاریخ شروع همکاری</th>
                </tr>
                </thead>
                <tbody>
                @foreach($securings as $securing)
                    <tr>
                        <td>{{$securing->name_securing_company}}</td>
                        <td>{{$securing->date_securing_company}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <br/>
        <div class="container-fluid">
            <!-- Control the column width, and how they should appear on different devices -->
            <table>
                <thead>
                <tr>
                    <th style="background-color: rgba(8,71,255,0.23)" colspan="8">مشخصات پرسنل های شرکت</th>
                </tr>
                <tr>

                    <th>سمت</th>
                    <th>جنسیت</th>
                    <th>عنوان</th>
                    <th>نام</th>
                    <th>تلفن</th>
                    <th>داخلی</th>
                    <th>تلفن همراه</th>
                    <th>ایمیل</th>

                </tr>
                </thead>
                <tbody>
                @foreach($companys as $company)
                    <tr>
                        <td>{{$company->per_side_company}}</td>
                        <td>
                            @if($company->per_sex_company == 1)
                                مرد
                            @else
                                زن
                            @endif
                        </td>
                        <td>{{$company->per_title_company}}</td>
                        <td>{{$company->per_name_company}}</td>
                        <td>{{$company->per_tel_company_company}}</td>
                        <td>{{$company->per_inside_company}}</td>
                        <td>{{$company->per_phone_company}}</td>
                        <td>{{$company->per_email_company}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <br/>
    <br/>
    <br/>
    <br/>
</div>
</body>
</html>


<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/public/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $(document).ready(function () {
        persianToEnNumConvert();
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

