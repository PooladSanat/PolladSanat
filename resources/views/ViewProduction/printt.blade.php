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
<body dir="rtl" class="myclass" style="font-family: 'B Yekan'">
<br/>
<br/>
<div class="container-fluid">
    <div class="container-fluid">

        <table style="font-family: 'B Yekan' ; font-size: 18px">
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

        <table style="font-family: 'B Yekan' ; font-size: 18px">
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

        <table style="font-family: 'B Yekan' ; font-size: 18px">
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

        <table style="font-family: 'B Yekan' ; font-size: 18px">
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

        <table style="font-family: 'B Yekan' ; font-size: 18px">
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
    <br/>
    <br/>
    <br/>
    <div class="row">
        <div class="col-sm-9">
            {{--                        <input id="printbtn" class="btn btn-primary" type="button" value="تهیه نسخه چاپی"--}}
            {{--                               onclick="window.print();">--}}
        </div>
        <div class="col-sm-3">

            <button type="submit" class="btn btn-success" id="successProduct" value="ثبت نظر">
                ثبت نظر
            </button>
            &nbsp;&nbsp;&nbsp;
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
        invoices_id.push({'id': '{{$id}}'});
        for (var i in invoices_id)
            var id = invoices_id[i].id;


        $('#successProduct').click(function (e) {
            e.preventDefault();

            $.get("{{ route('admin.viewproduct.check.success') }}" + '/' + id, function (data) {
                $('#Success').modal('show');
                $('#id_invoice').val(id);
            });

        });


        $('#saveSuccess').click(function (e) {
            e.preventDefault();
            $('#saveSuccess').text('در حال ثبت اطلاعات...');
            $('#saveSuccess').prop("disabled", true);
            $.ajax({
                data: $('#CustomerSuccess').serialize(),
                url: "{{ route('admin.viewproduct.store.success') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        $('#CustomerSuccess').trigger("reset");
                        $('#Success').modal('hide');
                        Swal.fire({
                            title: 'موفق!',
                            text: 'نظر شما برای برنامه در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveSuccess').text('ثبت');
                        $('#saveSuccess').prop("disabled", false);

                    }
                }
            });
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


@include('ViewProduction.modal')

