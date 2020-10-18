<?php
$custmer = \App\Customer::where('id',$id->customer_id)->first();
?>
    <!DOCTYPE html>
<html xml:lang="fa">
<head>

    <title>سیستم مدیریت پولاد صنعت</title>
    <script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/js/jquery.maskedinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/js/datatab.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/js/row.js')}}" type="text/javascript"></script>
    <link href="{{asset('/public/assets/global/css/plugins-md-rtl.min.css')}}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{{asset('/public/dist/css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{asset('/public/dist/css/rtl.css')}}">
    <link rel="stylesheet" href="{{asset('/public/dist/css/AdminLTE.css')}}">
    <link href="{{asset('/public/assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('/public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('/public/assets/global/css/components-md-rtl.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>

    <style>
        .example-modal .modal {
            position: relative;
            top: auto;
            bottom: auto;
            right: auto;
            left: auto;
            display: block;
            z-index: 1;
        }

        .example-modal .modal {
            background: transparent !important;
        }
    </style>
    <style>
        @media print {
            .control-group {
                display: none;
            }
        }
    </style>
    <style type="text/css">
        @media print {
            #printbtn {
                display: none;
            }

            #successProduct {
                display: none;
            }

            #deleteProduct {
                display: none;
            }

            #back {
                display: none;
            }
        }
    </style>
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/public/icon/logo.png')}}"/>
    <style>
        table {
            font-family: arial, sans-serif;
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
            font-family: 'Shahab';
            src: url('{{asset('/public/f/Yekan.woff2')}}') format('woff2'),
            url('{{asset('/public/f/Yekan.woff')}}') format('woff'),
            url('{{asset('/public/f/Yekan.ttf')}}') format('truetype'),
            url('{{asset('/public/f/Yekan.otf')}}') format('opentype');
            font-weight: normal;
            font-style: normal;
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


</head>
<body dir="rtl" class="myclass" style="font-family: Shahab">
<br/>
<br/>
<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">

                    </div>
                    <div class="col-sm-6">
                        <br/>
                        <br/>
                        <strong>   نام مشتری : {{$custmer->name}}</strong>
                    </div>
                    <div class="col-sm-4">
                        <br/>
                        <strong> شماره: {{$id->invoiceNumber}}</strong>
                        <br/>
                        <strong> تاریخ: {{\Morilog\Jalali\Jalalian::forge(date('Y/m/d'))->format('Y/m/d')}}</strong>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">خلاصه پیش فاکتور</a>
                        </li>
                        <li><a href="#a" data-toggle="tab">سوابق خرید قبلی مشتری</a></li>
                        <li><a href="#b" data-toggle="tab">فاکتورهای در جریان</a></li>
                        <li><a href="#c" data-toggle="tab">صورت وضعیت</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="container">
                                <div>
                                    <br/>
                                    <div class="row">

                                        <table>
                                            <thead>
                                            <tr>
                                                <th>
                                                    <br/>
                                                    <table style="font-family: Shahab">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="6"
                                                                style="background-color: rgba(255,135,73,0.44)">
                                                                خلاصه پیش فاکتور
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد</th>
                                                            <th>قیمت واحد(ریال)</th>
                                                            <th>قیمت کل(ریال)</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $sum = 0;
                                                        $tax = 0;
                                                        $number = 1;
                                                        ?>
                                                        @foreach($invoice_products as $invoice_product)
                                                            <?php
                                                            $sum = $sum + $invoice_product->sumTotal;
                                                            $tax = $tax + $invoice_product->taxAmount;
                                                            ?>
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
                                                            @if($id->price_sell > 0)
                                                                <th colspan="5">
                                                                    جمع کل
                                                                </th>

                                                                <th>
                                                                    {{number_format($id->price_sell)}}
                                                                </th>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th colspan="5">
                                                                @if(!empty($id->takhfif))
                                                                    <strong>تخفیف نماینده&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$id->takhfif}}
                                                                        %)</strong>
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

                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th style="background-color: rgba(23,0,255,0.31)"
                                                                colspan="5">
                                                                مبلغ قابل پرداخت
                                                            </th>

                                                            <th style="background-color: rgba(23,0,255,0.31)">
                                                                {{number_format($id->totalfinal)}}
                                                            </th>
                                                        </tr>
                                                        </tfoot>

                                                    </table>
                                                    <br/>
                                                    <div class="row">
                                                        <ul>
                                                            <li style="font-size: 120%;text-align: right">نحوه پرداخت:
                                                                <strong
                                                                    style="color: rgba(255,0,0,0.79)">{{$id->paymentMethod}}</strong>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            </div>
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-4">
                                                                امضاء فروشنده
                                                                <br/>
                                                                @if(!empty($user_ids->sign))

                                                                    <img src="{{url($user_ids->sign)}}" width="140">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                            </thead>
                                        </table>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="a">
                            <div class="container">
                                <div>
                                    <br/>
                                    <div class="row">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>
                                                    <table style="font-family: Shahab">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="6"
                                                                style="background-color: rgba(255,135,73,0.44)">
                                                                سوابق خرید های قبلی مشتری
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>تاریخ</th>
                                                            <th>فاکتور</th>
                                                            <th>مبلغ فاکتور</th>
                                                            <th>نحوه پرداخت</th>
                                                            <th>وضعیت پرداخت</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $number = 1;
                                                        ?>
                                                        @foreach($invoices_backs as $invoices_back)
                                                            <tr>
                                                                <td>{{$number++}}</td>
                                                                <td>{{$invoices_back->date}}</td>
                                                                <td>

                                                                    <a href="#" data-toggle="modal"
                                                                       data-target="#youModal"
                                                                       data-id="{{$invoices_back->pack_id}}"
                                                                       class="modalLinkk">
                                                                        {{$invoices_back->pack_id}}
                                                                    </a>

                                                                </td>
                                                                <td>{{number_format($invoices_back->sum)}}</td>
                                                                <td>{{$invoices_back->type}}</td>
                                                                <?php
                                                                $clearing_factor = DB::table('clearing_factor')
                                                                    ->where('pack_id', $invoices_back->pack_id)->first();
                                                                if (!empty($clearing_factor)) {
                                                                    $has_payment = \App\Payments::where('clearing_id', $clearing_factor->clearing_id)
                                                                        ->first();
                                                                }

                                                                ?>
                                                                @if(!empty($has_payment))
                                                                    <td style="background-color: rgba(0,162,60,0.44)">
                                                                        پرداخت شده
                                                                    </td>
                                                                @else
                                                                    <td style="background-color: rgba(255,0,0,0.44)">
                                                                        پرداخت نشده
                                                                    </td>
                                                                @endif


                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="b">
                            <div class="container">
                                <div>
                                    <br/>
                                    <div class="row">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>
                                                    <table style="font-family: Shahab">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="6"
                                                                style="background-color: rgba(255,135,73,0.44)">
                                                                فاکتور های در جریان مشتری
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>تاریخ</th>
                                                            <th>فاکتور</th>
                                                            <th>مبلغ فاکتور</th>
                                                            <th>نحوه پرداخت</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $number = 1;
                                                        ?>
                                                        @foreach($factors as $factor)
                                                            <tr>
                                                                <td>{{$number++}}</td>
                                                                <td>{{$factor->date}}</td>
                                                                <td>
                                                                    <a href="#" data-toggle="modal"
                                                                       data-target="#youModal"
                                                                       data-id="{{$factor->pack_id}}"
                                                                       class="modalLinkk">
                                                                        {{$factor->pack_id}}
                                                                    </a>
                                                                </td>
                                                                <td>{{number_format($factor->sum)}}</td>
                                                                <td>{{$factor->type}}</td>

                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="c">
                            <div class="container">
                                <div>
                                    <br/>
                                    <div class="row">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>
                                                    <table style="font-family: Shahab">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="6"
                                                                style="background-color: rgba(255,135,73,0.44)">
                                                                صورت وضعیت مشتری
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>کد صورتحساب</th>
                                                            <th>تاریخ صدور</th>
                                                            <th>مبلغ صورتحساب</th>
                                                            <th>جمع اسناد دریافتی</th>
                                                            <th>مانده حساب</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php
                                                        $number = 1;
                                                        $sum_s = null;
                                                        $sum_p = null;
                                                        $sum_c = null;
                                                        $facto = null;
                                                        ?>
                                                        @foreach($dataa as $data)
                                                            <tr>
                                                                <td>{{$number++}}</td>
                                                                <td>

                                                                    <a href="#" data-toggle="modal"
                                                                       data-target="#youModal"
                                                                       data-id="{{$data->id}}"
                                                                       class="modalLinkkk">
                                                                        {{$data->id}}
                                                                    </a>

                                                                </td>
                                                                <td>{{$data->date}}</td>
                                                                <td>{{number_format($data->price)}}</td>
                                                                <?php
                                                                $detail_customer_payment = DB::table('detail_customer_payment')
                                                                    ->where('payment_id', $data->id)->sum('price');
                                                                $sum = $detail_customer_payment - $data->price;
                                                                ?>
                                                                <td>{{number_format($detail_customer_payment)}}</td>

                                                                @if($sum < 0)
                                                                    <td style="background-color: rgba(255,106,107,0.33)">{{number_format(abs($sum))}}</td>
                                                                @elseif($sum >0)
                                                                    <td style="background-color: rgba(0,183,255,0.33)">{{number_format(abs($sum))}}</td>

                                                                @else
                                                                    <td style="background-color: rgb(255,249,255)">{{number_format(abs($sum))}}</td>

                                                                @endif


                                                                <?php

                                                                $sum_s += $data->price;
                                                                $sum_p += $detail_customer_payment;
                                                                $sum_c = $sum_p - $sum_s;

                                                                ?>
                                                                <?php
                                                                $facto = DB::table('factors')
                                                                    ->where('status', 0)
                                                                    ->whereNull('sort')
                                                                    ->where('customer_id', $data->customer_id)
                                                                    ->sum('sum');
                                                                ?>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>

                                                        <tfoot>

                                                        <tr>
                                                            <th colspan="3" style="text-align: right">جمع کل</th>
                                                            <th style="background-color: rgba(255,0,0,0.29)">{{number_format(abs($sum_s))}}</th>
                                                            @if($sum_p > 0)
                                                                <th style="background-color: rgba(13,143,255,0.33)">{{number_format(abs($sum_p))}}</th>
                                                            @else
                                                                <th>{{number_format(abs($sum_p))}}</th>
                                                            @endif

                                                            @if($sum_c > 0)
                                                                <th style="background-color: rgba(13,143,255,0.33)">{{number_format(abs($sum_c))}}</th>
                                                            @elseif($sum_c < 0)
                                                                <th style="background-color: rgba(255,0,0,0.29)">{{number_format(abs($sum_c))}}</th>
                                                            @else
                                                                <th>{{number_format(abs($sum_c))}}</th>
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <th colspan="5" style="text-align: right">جمع فاکتور های در
                                                                جریان
                                                            </th>
                                                            @if($facto != 0)
                                                                <th style="background-color: rgba(255,0,0,0.29)">{{number_format($facto)}}</th>

                                                            @else
                                                                <th>{{$facto}}</th>
                                                            @endif

                                                        </tr>

                                                        <?php
                                                        $sort = $sum_c - $facto
                                                        ?>

                                                        <tr>
                                                            <th colspan="5" style="text-align: right">صورت وضعیت</th>
                                                            @if($sort > 0)
                                                                <th style="background-color: rgba(13,143,255,0.33)">{{number_format(abs($sort))}}</th>

                                                            @elseif($sort < 0)
                                                                <th style="background-color: rgba(255,0,0,0.29)">{{number_format(abs($sort))}}</th>

                                                            @else
                                                                <th>{{number_format($sort)}}</th>
                                                            @endif
                                                        </tr>

                                                        </tfoot>
                                                    </table>
                                                </th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <br/>
                <div class="row">
                    <div class="col-sm-9">
                        {{--                        <input id="printbtn" class="btn btn-primary" type="button" value="تهیه نسخه چاپی"--}}
                        {{--                               onclick="window.print();">--}}
                    </div>
                    <div class="col-sm-3">

                        <button type="submit" class="btn btn-success" id="successProduct" value="تایید">
                            تایید
                        </button>
                        &nbsp;&nbsp;&nbsp;

                        <button type="submit" class="btn btn-danger" id="deleteProduct" value="عدم تایید">
                            عدم تایید
                        </button>
                        &nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-info" id="back" value="بازگشت به صفحه قبل">
                            بازگشت به صفحه قبل
                        </button>
                    </div>

                </div>
                <br/>
            </div>
        </div>
    </div>
</div>
</body>


<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{asset('/public/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/public/assets/sweetalert.js')}}"></script>
<meta name="_token" content="{{ csrf_token() }}"/>
<script>
    $('.modalLinkk').click(function () {
        var detail_factor = $(this).attr('data-id');
        $('#ajaxModellistr').modal('show');
        $('#factor').DataTable().destroy();
        $('.factor').DataTable({
            processing: true,
            serverSide: true,
            "ordering": false,
            "paging": false,
            "info": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: {
                url: "{{ route('admin.payment.list.detail.factor.pack') }}",
                data: {
                    detail_factor: detail_factor,
                },
            },
            columns: [
                {data: 'pack', name: 'pack'},
                {data: 'user', name: 'user'},
                {data: 'customer_name', name: 'customer_name'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'total', name: 'total'},
                {data: 'date', name: 'date'},
            ],
            rowsGroup:
                [
                    0, 1, 2, 6
                ],


        });
    });


    $('.modalLinkkk').click(function () {
        var detail_factor = $(this).attr('data-id');
        $('#ajaxModellistre').modal('show');
        $('#factooooor').DataTable().destroy();
        $('.factooooor').DataTable({
            processing: true,
            serverSide: true,
            "ordering": false,
            "paging": false,
            "info": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: {
                url: "{{ route('admin.payment.list.detail.factor') }}",
                data: {
                    detail_factor: detail_factor,
                },
            },
            columns: [
                {data: 'pack', name: 'pack'},
                {data: 'customer', name: 'customer'},
                {data: 'user', name: 'user'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'total', name: 'total'},
                {data: 'created_at', name: 'created_at'},
            ],
            rowsGroup:
                [
                    0, 1, 2, 6
                ],

        });
    });

</script>

<script src="{{asset('/public/assets/global/scripts/datatable.js')}}" type="text/javascript"></script>

<script src="{{asset('/public/assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>

<script src="{{asset('/public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
        type="text/javascript"></script>

<script src="{{asset('/public/assets/pages/scripts/table-datatables-colreorder.js')}}"
        type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var invoices_id = [];
        invoices_id.push({'id': '{{$id->id}}'});
        for (var i in invoices_id)
            var id = invoices_id[i].id;


        $('#successProduct').click(function (e) {
            e.preventDefault();

            $.get("{{ route('admin.invoice.check.success') }}" + '/' + id, function (data) {
                $('#Success').modal('show');
                $('#id_invoice').val(id);
                $('#description_invoice').val(data.description);
            });
            $('#saveSuccess').click(function (e) {
                e.preventDefault();
                var form = $('#CustomerSuccess').serialize();
                $('#Success').modal('hide');
                Swal.fire({
                    title: 'تایید پیش فاکتور!',
                    text: "پیش فاکتور تایید شود و به فروشنده اطلاع داده شود؟",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'تایید',
                    cancelButtonText: 'انصراف',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            data: form,
                            url: "{{ route('admin.invoice.admin.success') }}",
                            type: "POST",
                            dataType: 'json',
                            success: function (data) {
                                Swal.fire({
                                    title: 'موفق!',
                                    text: 'مشخصات پیش فاکتور با موفقیت تایید شد',
                                    icon: 'success',
                                    confirmButtonText: 'تایید'
                                }).then((result) => {
                                    window.location.replace('{{route('admin.invoice.index')}}');
                                });
                            }
                        });
                        $('#id_invoice').val('');
                        $('#description_invoice').val('');

                    }

                });


            });
        });


        $('#deleteProduct').click(function (e) {
            e.preventDefault();

            $.get("{{ route('admin.invoice.check.canceled') }}" + '/' + id, function (data) {
                $('#Delete').modal('show');
                $('#id_delete').val(id);
                $('#cancellation').val(data.cancellation);
                $('#description_c').val(data.description);
            });
            $('#saveCancel').click(function (e) {
                e.preventDefault();
                var form = $('#Customer_Canceled').serialize();
                $('#Delete').modal('hide');
                Swal.fire({
                    title: 'لغو پیش فاکتور!',
                    text: "عدم تایید پیش فاکتور و ارسال آن به بخش پیش فاکتورهای تایید نشده؟",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'تایید',
                    cancelButtonText: 'انصراف',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            data: form,
                            url: "{{ route('admin.invoice.delete') }}",
                            type: "POST",
                            dataType: 'json',
                            success: function (data) {
                                Swal.fire({
                                    title: 'موفق!',
                                    text: 'پیش فاکتور با موفقیت لغو شد',
                                    icon: 'success',
                                    confirmButtonText: 'تایید'
                                }).then((result) => {
                                    window.location.replace('{{route('admin.invoice.index')}}');
                                });
                            }
                        });
                        $('#id_delete').val();
                        $('#cancellation').val();
                        $('#description_c').val();
                    }

                });


            });
        });

        $('#back').click(function (e) {
            e.preventDefault();
            window.location.replace('{{route('admin.invoice.index')}}');

        });


    });

</script>
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

</html>
@include('sell.detail.modal')



