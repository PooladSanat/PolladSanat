@extends('layouts.master')
@section('content')
    <?php

    use App\Invoice;

    $id = DB::table('role_user')
        ->where('user_id', auth()->user()->id)
        ->first();
    $name = DB::table('roles')
        ->where('id', $id->role_id)
        ->first();
    $array_factor = array();
    $date = \Hekmatinasser\Verta\Verta::now()->format('Y/m/d');
    $returns = \App\Returns::where('date', $date)->count();
    $receiptproduct = DB::table('receiptproduct')->where('date', $date)->sum('number');
    $factor = DB::table('factors')->where('date', $date)->get();
    foreach ($factor as $item) {
        $array_factor[] = $item->pack_id;
    }
    $number_sum = DB::table('schedulings')->whereIn('pack', $array_factor)->sum('total');
    $number_sum_e = DB::table('schedulings')
        ->whereNull('statusfull')
        ->whereNull('end')
        ->sum('total');

    $farvardin = \App\Factors::where('Year', $v->year)
        ->where('Month', '1')
        ->sum('total');
    $may = \App\Factors::where('Year', $v->year)
        ->where('Month', '2')
        ->sum('total');
    $June = \App\Factors::where('Year', $v->year)
        ->where('Month', '3')
        ->sum('total');
    $Arrows = \App\Factors::where('Year', $v->year)
        ->where('Month', '4')
        ->sum('total');
    $August = \App\Factors::where('Year', $v->year)
        ->where('Month', '5')
        ->sum('total');
    $September = \App\Factors::where('Year', $v->year)
        ->where('Month', '6')
        ->sum('total');
    $stamp = \App\Factors::where('Year', $v->year)
        ->where('Month', '7')
        ->sum('total');
    $Aban = \App\Factors::where('Year', $v->year)
        ->where('Month', '8')
        ->sum('total');
    $Fire = \App\Factors::where('Year', $v->year)
        ->where('Month', '9')
        ->sum('total');
    $January = \App\Factors::where('Year', $v->year)
        ->where('Month', '10')
        ->sum('total');
    $Avalanche = \App\Factors::where('Year', $v->year)
        ->where('Month', '11')
        ->sum('total');
    $March = \App\Factors::where('Year', $v->year)
        ->where('Month', '12')
        ->sum('total');
    ?>
    <?php


    $farvardinn = DB::table('receiptproduct')
        ->where('status', 1)
        ->where('Year', $v->year)
        ->where('Month', '1')
        ->sum('number');

    $mayy = DB::table('receiptproduct')
        ->where('status', 1)
        ->where('Year', $v->year)
        ->where('Month', '2')
        ->sum('number');

    $Junee = DB::table('receiptproduct')
        ->where('status', 1)
        ->where('Year', $v->year)
        ->where('Month', '3')
        ->sum('number');

    $Arrowss = DB::table('receiptproduct')
        ->where('status', 1)
        ->where('Year', $v->year)
        ->where('Month', '4')
        ->sum('number');

    $Augustt = DB::table('receiptproduct')
        ->where('status', 1)
        ->where('Year', $v->year)
        ->where('Month', '5')
        ->sum('number');

    $Septemberr = DB::table('receiptproduct')
        ->where('status', 1)
        ->where('Year', $v->year)
        ->where('Month', '6')
        ->sum('number');

    $stampp = DB::table('receiptproduct')
        ->where('status', 1)
        ->where('Year', $v->year)
        ->where('Month', '7')
        ->sum('number');

    $Abann = DB::table('receiptproduct')
        ->where('status', 1)
        ->where('Year', $v->year)
        ->where('Month', '8')
        ->sum('number');

    $Firee = DB::table('receiptproduct')
        ->where('status', 1)
        ->where('Year', $v->year)
        ->where('Month', '9')
        ->sum('number');

    $Januaryy = DB::table('receiptproduct')
        ->where('status', 1)
        ->where('Year', $v->year)
        ->where('Month', '10')
        ->sum('number');

    $Avalanchee = DB::table('receiptproduct')
        ->where('status', 1)
        ->where('Year', $v->year)
        ->where('Month', '10')
        ->sum('number');

    $Marchh = DB::table('receiptproduct')
        ->where('status', 1)
        ->where('Year', $v->year)
        ->where('Month', '12')
        ->sum('number');

    ?>
    <style>
        .container {
            width: 70%;
            margin: 20px auto;
        }

        .p {
            text-align: center;
            font-size: 20px;
            padding-top: 240px;
        }
    </style>
    <script src="{{asset('/public/js/10.js')}}"></script>
    @if($name->name == "مدیر کارخانه")
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        پولاد صنعت در تاریخ {{$date}}
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-12">
                                    <br/>
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-aqua">
                                            <div class="inner">
                                                <h3>{{$returns}}</h3>

                                                <p>مرجوعی</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i
                                                    class="fa fa-arrow-circle-left"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-green">
                                            <div class="inner">
                                                <h3>{{$number_sum}}</h3>

                                                <p>خارج شده</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i
                                                    class="fa fa-arrow-circle-left"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-yellow">
                                            <div class="inner">
                                                <h3>{{$number_sum_e}}</h3>

                                                <p>در انتظار خروج</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i
                                                    class="fa fa-arrow-circle-left"></i></a>
                                        </div>
                                    </div>

                                    <!-- ./col -->
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-red">
                                            <div class="inner">
                                                <h3>{{$receiptproduct}}</h3>

                                                <p>تولید</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-pie-graph"></i>
                                            </div>
                                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i
                                                    class="fa fa-arrow-circle-left"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    @endif

    <div class="row">
        <div class="col-md-12">
            @can('نمودارها')
                <div class="col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                نمودارهای سال {{$v->year}}
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#activity" data-toggle="tab">نمودار فروش</a>
                                            </li>
                                            <li><a href="#settings" data-toggle="tab">نمودار تولید</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="activity">
                                                <div class="container">
                                                    <div>
                                                        <canvas id="barChart"></canvas>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="settings">
                                                <div class="container">
                                                    <div>
                                                        <canvas id="barChartt"></canvas>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            @can('مشتری و محصولات برتر')
                <div class="col-md-6">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                5 مشتری برتر سال {{$v->year}}
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group">
                                    <table class="table table-striped table-bordered">
                                        <thead style="background-color: #e8ecff">
                                        <tr>
                                            <th style="background-color: #e8ecff;text-align: center">ردیف</th>
                                            <th>مشتری</th>
                                            <th>تعداد خرید(عدد)</th>
                                            <th>مبلغ خرید(ریال)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $number = 1;
                                        ?>
                                        @foreach($invoices as $invoice)
                                            <tr>


                                                <td style="background-color: #e8ecff;text-align: center">{{$number++}}</td>
                                                <td>
                                                    @foreach($customers as $customer)

                                                        @if($invoice->customer_id == $customer->id)

                                                            <a href="#" data-toggle="modal" data-target="#youModal"
                                                               data-id="{{$customer->id}}" class="detail-customer">
                                                                {{$customer->name}}
                                                            </a>


                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{$invoice->number}}
                                                </td>
                                                <td>
                                                    {{number_format($invoice->price)}}
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                5 محصول برتر سال {{$v->year}}
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group">
                                    <table class="table table-striped table-bordered">
                                        <thead style="background-color: #e8ecff">
                                        <tr>
                                            <th style="background-color: #e8ecff;text-align: center">ردیف</th>
                                            <th>محصول</th>
                                            <th>رنگ</th>
                                            <th>تعداد فروش</th>
                                            <th>مبلغ فروش</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $number = 1;
                                        ?>
                                        @foreach($products as $productt)
                                            <tr>


                                                <td style="background-color: #e8ecff;text-align: center">{{$number++}}</td>
                                                <td>
                                                    @foreach($product as $produc)
                                                        @if($productt->product_id == $produc->id)
                                                            {{$produc->label}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($colors as $color)
                                                        @if($productt->color_id == $color->id)
                                                            {{$color->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{$productt->number}}
                                                </td>
                                                <td>
                                                    {{number_format($productt->price)}}
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>



    {{--        <div class="col-md-12">--}}
    {{--                <div class="portlet box blue">--}}
    {{--                    <div class="portlet-title">--}}
    {{--                        <div class="caption">--}}
    {{--                            نمودارهای آماری--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="portlet-body form">--}}
    {{--                        <div class="form-body">--}}
    {{--                            <div class="form-group">--}}
    {{--                                <div class="nav-tabs-custom">--}}
    {{--                                    <ul class="nav nav-tabs">--}}
    {{--                                        <li class="active"><a href="#activity" data-toggle="tab">هدف تعدادی</a></li>--}}
    {{--                                        <li><a href="#settings" data-toggle="tab">فروش ریالی</a></li>--}}
    {{--                                    </ul>--}}
    {{--                                    <div class="tab-content">--}}
    {{--                                        <div class="active tab-pane" id="activity">--}}
    {{--                                            <main class="container">--}}
    {{--                                                <div>--}}
    {{--                                                    <canvas id="TargetNumber"></canvas>--}}
    {{--                                                </div>--}}
    {{--                                                <hr/>--}}
    {{--                                                <br/>--}}
    {{--                                                <div class="col-md-4">--}}

    {{--                                                    <label class="col-md-4">فروشنده:</label>--}}
    {{--                                                    <select class="form-control col-md-8"--}}
    {{--                                                            name="id_user" id="id_user">--}}
    {{--                                                        @foreach($users as $user)--}}
    {{--                                                            <option value="{{$user->id}}">{{$user->name}}</option>--}}
    {{--                                                        @endforeach--}}
    {{--                                                    </select>--}}

    {{--                                                </div>--}}
    {{--                                                <div class="col-md-4">--}}
    {{--                                                    <label class="col-md-3">سال:</label>--}}
    {{--                                                    <select name="year" id="year" class="form-control col-md-9">--}}
    {{--                                                        <option value="1399">1399</option>--}}
    {{--                                                        <option value="1400">1400</option>--}}
    {{--                                                        <option value="1401">1401</option>--}}
    {{--                                                        <option value="1402">1402</option>--}}
    {{--                                                        <option value="1403">1403</option>--}}
    {{--                                                        <option value="1404">1404</option>--}}
    {{--                                                        <option value="1405">1405</option>--}}
    {{--                                                        <option value="1406">1406</option>--}}
    {{--                                                        <option value="1407">1407</option>--}}
    {{--                                                        <option value="1408">1408</option>--}}
    {{--                                                        <option value="1409">1409</option>--}}
    {{--                                                        <option value="1410">1410</option>--}}
    {{--                                                        <option value="1411">1411</option>--}}
    {{--                                                        <option value="1412">1412</option>--}}
    {{--                                                        <option value="1413">1413</option>--}}
    {{--                                                    </select>--}}
    {{--                                                </div>--}}
    {{--                                                <label></label>--}}
    {{--                                                <div class="col-md-4">--}}
    {{--                                                    <button style="width: 130px" type="submit"--}}
    {{--                                                            class="btn btn-success col-md-4"--}}
    {{--                                                            id="search_target_number" value="جستجو">--}}
    {{--                                                        جستجو--}}
    {{--                                                    </button>--}}
    {{--                                                </div>--}}
    {{--                                            </main>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="tab-pane" id="settings">--}}
    {{--                                            <main class="container">--}}
    {{--                                                <div>--}}
    {{--                                                    <canvas id="SellPrice"></canvas>--}}
    {{--                                                </div>--}}
    {{--                                                <hr/>--}}
    {{--                                                <br/>--}}
    {{--                                                <div class="col-md-4">--}}
    {{--                                                    <label class="col-md-4">فروشنده:</label>--}}
    {{--                                                    <select class="form-control col-md-8"--}}
    {{--                                                            name="id_sell" id="id_sell">--}}
    {{--                                                        @foreach($users as $user)--}}
    {{--                                                            <option value="{{$user->id}}">{{$user->name}}</option>--}}
    {{--                                                        @endforeach--}}
    {{--                                                    </select>--}}
    {{--                                                </div>--}}
    {{--                                                <div class="col-md-4">--}}
    {{--                                                    <label class="col-md-3">سال:</label>--}}
    {{--                                                    <select name="year_sell" id="year_sell" class="form-control col-md-9">--}}
    {{--                                                        <option value="1399">1399</option>--}}
    {{--                                                        <option value="1400">1400</option>--}}
    {{--                                                        <option value="1401">1401</option>--}}
    {{--                                                        <option value="1402">1402</option>--}}
    {{--                                                        <option value="1403">1403</option>--}}
    {{--                                                        <option value="1404">1404</option>--}}
    {{--                                                        <option value="1405">1405</option>--}}
    {{--                                                        <option value="1406">1406</option>--}}
    {{--                                                        <option value="1407">1407</option>--}}
    {{--                                                        <option value="1408">1408</option>--}}
    {{--                                                        <option value="1409">1409</option>--}}
    {{--                                                        <option value="1410">1410</option>--}}
    {{--                                                        <option value="1411">1411</option>--}}
    {{--                                                        <option value="1412">1412</option>--}}
    {{--                                                        <option value="1413">1413</option>--}}
    {{--                                                    </select>--}}
    {{--                                                </div>--}}
    {{--                                                <label></label>--}}
    {{--                                                <div class="col-md-4">--}}
    {{--                                                    <button style="width: 130px" type="submit"--}}
    {{--                                                            class="btn btn-success col-md-4"--}}
    {{--                                                            id="search_sell_price" value="جستجو">--}}
    {{--                                                        جستجو--}}
    {{--                                                    </button>--}}
    {{--                                                </div>--}}
    {{--                                            </main>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}

    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--        </div>--}}



    <script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
    <meta name="_token" content="{{ csrf_token() }}"/>

    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var TargetNumber;
            var SellPrice;
            var ctx = document.getElementById("TargetNumber").getContext('2d');
            TargetNumber = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
                    datasets: [{
                        label: '',
                        data: [],
                    }, {
                        label: '',
                        data: [],
                    }]

                },


            });
            var price = document.getElementById("SellPrice").getContext('2d');
            SellPrice = new Chart(price, {
                type: 'bar',
                data: {
                    labels: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
                    datasets: [{
                        label: '',
                        data: [],
                    }, {
                        label: '',
                        data: [],
                    }]

                },


            });


            $('#search_target_number').click(function () {
                var id = $('#id_user').val();
                var year = $('#year').val();
                var data = '&id=' + id + '&year=' + year;
                $.ajax({
                    type: "GET",
                    url: "{{route('home.chart')}}?data=" + data,
                    success: function (res) {
                        if (res.target != null || res.a != 0) {
                            var ctx = document.getElementById("TargetNumber").getContext('2d');
                            TargetNumber = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
                                    datasets: [{
                                        label: 'هدف سال',
                                        data: [res.fa, res.ma, res.Ju,
                                            res.Ar, res.Au, res.Se,
                                            res.sta, res.Ab, res.Fi,
                                            res.Ja, res.Av, res.Ma],
                                        backgroundColor: "rgba(255,0,0,1)"
                                    }, {
                                        label: 'فروش سال',
                                        data: [res.farvardin, res.may, res.June, res.Arrows
                                            , res.August, res.September, res.stamp
                                            , res.Aban, res.Fire, res.January, res.Avalanche, res.March],
                                        backgroundColor: "rgba(0,0,255,1)"
                                    }]
                                },
                            });

                        } else {
                            Swal.fire({
                                title: 'توجه!',
                                text: 'فروشنده مورد نظر امسال هدف و فروشی نداشته است!',
                                icon: 'info',
                                confirmButtonText: 'تایید'
                            });
                            var ctx = document.getElementById("TargetNumber").getContext('2d');
                            TargetNumber = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
                                    datasets: [{
                                        label: '',
                                        data: [],
                                    }, {
                                        label: '',
                                        data: [],
                                    }]
                                },
                            });
                        }
                    }
                });

                TargetNumber.destroy();
            });


            $('#search_sell_price').click(function () {
                var id_sell = $('#id_sell').val();
                var year_sell = $('#year_sell').val();
                var data = '&id=' + id_sell + '&year=' + year_sell;
                $.ajax({
                    type: "GET",
                    url: "{{route('home.chart.sell')}}?data=" + data,
                    success: function (res) {

                        if (res.invoices != null) {
                            var ctx = document.getElementById("SellPrice").getContext('2d');
                            SellPrice = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
                                    datasets: [{
                                        label: 'فروش سال',
                                        data: [res.farvardin, res.may, res.June, res.Arrows
                                            , res.August, res.September, res.stamp
                                            , res.Aban, res.Fire, res.January, res.Avalanche, res.March],
                                        backgroundColor: "rgba(0,0,255,1)"
                                    }]
                                },
                            });

                        } else {
                            Swal.fire({
                                title: 'توجه!',
                                text: 'برای فروشنده مورد نظر در این سال فروشی ثبت نشده است!',
                                icon: 'info',
                                confirmButtonText: 'تایید'
                            });
                            var ctx = document.getElementById("SellPrice").getContext('2d');
                            SellPrice = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
                                    datasets: [{
                                        label: '',
                                        data: [],
                                    }, {
                                        label: '',
                                        data: [],
                                    }]
                                },
                            });
                        }
                    }
                });

                SellPrice.destroy();
            });

        });

    </script>





    <script>
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }

        var DEFAULT_DATASET_SIZE = 7,
            addedCount = 0,
            color = Chart.helpers.color;
        var chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)',
            amir: 'rgba(172,171,183,0.89)',
        };

        function randomScalingFactor() {
            return Math.round(Math.random() * 100);
        }

        var barDataa = {
            labels: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
            datasets: [{
                label: 'تعداد تولید',
                backgroundColor: color(chartColors.red).alpha(0.4).rgbString(),
                borderColor: chartColors.red,
                borderWidth: 2,
                data: [{{$farvardinn}}, {{$mayy}}, {{$Junee}},
                    {{$Arrowss}}, {{$Augustt}}, {{$Septemberr}},
                    {{$stampp}}, {{$Abann}}, {{$Firee}},
                    {{$Januaryy}}, {{$Avalanchee}}, {{$Marchh}}]
            }]
        };
        var indexx = 11;
        var ctxc = document.getElementById("barChartt").getContext("2d");
        var myNewCharta = new Chart(ctxc, {
            type: 'bar',
            data: barDataa,
            options: {
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            return formatNumber(Number(tooltipItem.yLabel));
                        }
                    }
                },
                legend: {
                    display: true,
                },

            }
        });
    </script>

    <script>
        var DEFAULT_DATASET_SIZE = 7,
            addedCount = 0,
            color = Chart.helpers.color;

        var chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)',
            amir: 'rgba(172,171,183,0.89)',
        };

        function randomScalingFactor() {
            return Math.round(Math.random() * 100);
        }

        var barData = {
            labels: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
            datasets: [{
                label: 'تعداد فروش',
                backgroundColor: color(chartColors.red).alpha(0.4).rgbString(),
                borderColor: chartColors.red,
                borderWidth: 2,
                data: [{{$farvardin}}, {{$may}}, {{$June}},
                    {{$Arrows}}, {{$August}}, {{$September}},
                    {{$stamp}}, {{$Aban}}, {{$Fire}},
                    {{$January}}, {{$Avalanche}}, {{$March}}]
            }]
        };
        var index = 11;
        var ctx = document.getElementById("barChart").getContext("2d");
        var myNewChartB = new Chart(ctx, {
            type: 'bar',
            data: barData,
            options: {
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            return formatNumber(Number(tooltipItem.yLabel));
                        }
                    }
                },
                legend: {
                    display: true,
                },

            }
        });

    </script>


    <script>
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }

        $('body').on('click', '.detail-customer', function () {
            var passedID = $(this).attr('data-id');
            $('#ajaxcustomer').modal('show');


            $("#information").DataTable().destroy();
            $('.information').DataTable({
                processing: true,
                serverSide: true,
                "searching": false,
                "lengthChange": false,
                "info": false,
                "bPaginate": false,
                "bSort": false,
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                    if (parseInt(aData.price) > parseInt("0")) {
                        $('td:eq(5)', nRow).css('background-color', 'rgba(204,255,141,0.65)');
                    } else if (parseInt(aData.price) < parseInt("0")) {
                        $('td:eq(5)', nRow).css('background-color', 'rgba(255,106,107,0.64)');
                    } else if (parseInt(aData.price) == parseInt("0")) {
                        $('td:eq(5)', nRow).css('background-color', 'rgb(255,255,255,255)');
                    }
                    $('#adde').text(aData.adders);
                    $('#cappattioon').text('مشخصات کلی مشتری' + " " + "(" + aData.name + ")");

                }
                ,
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
                    url: "{{ route('admin.customer.detail.information.list') }}",
                    data: {
                        detail_factor: passedID,
                    },
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'expert', name: 'expert'},
                    {data: 'type', name: 'type'},
                    {data: 'phone', name: 'phone'},
                    {data: 'tel', name: 'tel'},
                    {data: 'pricee', name: 'pricee'},
                ]
            });

            $("#traconesh").DataTable().destroy();
            $('.traconesh').DataTable({
                processing: true,
                serverSide: true,
                "searching": false,
                "lengthChange": false,
                "info": false,
                "bPaginate": true,
                "bSort": false,
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('td:eq(0)', nRow).css('background-color', '#e8ecff');
                    if (parseInt(aData.price) > parseInt("0")) {
                        $('td:eq(4)', nRow).css('background-color', 'rgba(8,71,255,0.33)');
                    }
                    if (parseInt(aData.sum) > parseInt("0")) {
                        $('td:eq(3)', nRow).css('background-color', 'rgba(255,0,0,0.33)');
                    }

                    var api = this.api(), aData;
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    var wedTotal = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return formatNumber(intVal(a) + intVal(b));
                        }, 0);
                    var thuTotal = api
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                            return formatNumber(intVal(a) + intVal(b));
                        }, 0);


                    $(api.column(0).footer()).html('جمع کل');
                    $(api.column(3).footer()).html(wedTotal);
                    $(api.column(4).footer()).html(thuTotal);

                },
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
                    url: "{{ route('admin.customer.detail.traconesh.list') }}",
                    data:
                        {
                            customer_id: passedID,
                        },
                },

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'date', name: 'date'},
                    {data: 'description', name: 'description'},
                    {data: 'sum', name: 'sum'},
                    {data: 'price', name: 'price'},

                ]
            });


            $("#kharid").DataTable().destroy();
            $('.kharid').DataTable({
                processing: true,
                serverSide: true,
                "searching": false,
                "lengthChange": false,
                "info": false,
                "bPaginate": true,
                "bSort": false,
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('td:eq(0)', nRow).css('background-color', '#e8ecff');

                    if (aData.payment == "پرداخت شده") {
                        $('td:eq(5)', nRow).css('background-color', 'rgba(8,71,255,0.33)');
                    } else {
                        $('td:eq(5)', nRow).css('background-color', 'rgba(255,0,0,0.4)');
                    }


                    var api = this.api(), aData;
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    var wedTotal = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return formatNumber(intVal(a) + intVal(b));
                        }, 0);


                    $(api.column(0).footer()).html('جمع کل');
                    $(api.column(3).footer()).html(wedTotal);


                },
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
                    url: "{{ route('admin.customer.detail.kharid.list') }}",
                    data:
                        {
                            customer_id: passedID,
                        },
                },

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' , "className": "dt-center"},
                    {data: 'date', name: 'date'},
                    {data: 'invoiceNumber', name: 'invoiceNumber'},
                    {data: 'totalfinal', name: 'totalfinal'},
                    {data: 'paymentMethod', name: 'paymentMethod'},
                    {data: 'payment', name: 'payment'},


                ]
            });


            $("#asnad").DataTable().destroy();
            $('.asnad').DataTable({
                processing: true,
                serverSide: true,
                "searching": false,
                "lengthChange": false,
                "info": false,
                "bPaginate": true,
                "bSort": false,
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('td:eq(0)', nRow).css('background-color', '#e8ecff');

                    if (aData.status == "وصول نشده") {
                        $('td:eq(9)', nRow).css('background-color', 'rgba(255,0,0,0.33)');
                    } else if (aData.status == "وصول شده") {
                        $('td:eq(9)', nRow).css('background-color', 'rgba(8,71,255,0.28)');
                    } else {
                        $('td:eq(9)', nRow).css('background-color', 'rgba(10,255,45,0.17)');
                    }


                    var api = this.api(), aData;
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    var wedTotal = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return formatNumber(intVal(a) + intVal(b));
                        }, 0);


                    $(api.column(0).footer()).html('جمع کل');
                    $(api.column(3).footer()).html(wedTotal);


                },
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
                    url: "{{ route('admin.customer.detail.asnad.list') }}",
                    data:
                        {
                            customer_id: passedID,
                        },
                },

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' , "className": "dt-center"},
                    {data: 'customer', name: 'customer'},
                    {data: 'payment_id', name: 'payment_id'},
                    {data: 'type', name: 'type'},
                    {data: 'create', name: 'create'},
                    {data: 'name', name: 'name'},
                    {data: 'name_user', name: 'name_user'},
                    {data: 'price', name: 'price'},
                    {data: 'descriptionn', name: 'descriptionn'},
                    {data: 'status', name: 'status'},


                ]
            });


        });


    </script>

    @include('modal')
@endsection
