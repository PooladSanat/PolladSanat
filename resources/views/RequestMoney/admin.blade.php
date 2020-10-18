@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <input type="hidden" name="id" id="id" value="{{$id}}">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست تراکنش های مشتری
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-tablee" id="data-tablee">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>تاریخ</th>
                            <th>شرح</th>
                            <th>بدهکار</th>
                            <th>بستانکار</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $number = 1;
                        $sum_price = null;
                        $sum_sum = null;
                        ?>
                        @foreach($requestmoneys as $requestmoney)
                            <tr>
                                <th>{{$number++}}</th>
                                <th>{{$requestmoney->date}}</th>

                                @if(!empty($requestmoney->return_id))
                                    <th> بستانکار بابت مرجوعی با کد {{$requestmoney->return_id}}</th>
                                @else
                                    @if(!empty($requestmoney->price))
                                        <th>{{$requestmoney->descriptionn}}</th>
                                    @else
                                        <th> بدهی بابت فاکتور {{$requestmoney->rahkaran}}</th>
                                    @endif
                                @endif

                                @if($requestmoney->sum != 0)
                                    <th style="background-color: rgba(255,0,0,0.31)">
                                        {{number_format(abs($requestmoney->sum))}}
                                    </th>
                                @else
                                    <th>
                                        {{number_format(abs($requestmoney->sum))}}
                                    </th>
                                @endif

                                @if($requestmoney->price != 0)
                                    <th style="background-color: rgba(0,0,255,0.25)">
                                        {{number_format($requestmoney->price)}}
                                    </th>
                                @else
                                    <th>
                                        {{number_format(abs($requestmoney->price))}}

                                    </th>
                                @endif
                            </tr>
                            <?php
                            $sum_price += $requestmoney->price;
                            $sum_sum += $requestmoney->sum;
                            ?>
                        @endforeach
                        </tbody>
                        <tbody>
                        <tr>
                            <th colspan="3">جمع کل</th>
                            <th>{{number_format(abs($sum_sum))}}</th>
                            <th>{{number_format($sum_price)}}</th>
                        </tr>
                        <tr>
                            <th colspan="3">باقیمانده</th>
                            @if(abs($sum_sum) > $sum_price)
                                <th style="background-color: rgba(255,0,0,0.31)">{{number_format(abs($sum_sum) - $sum_price)}}</th>
                            @else
                                <th></th>
                            @endif
                            @if(abs($sum_sum) < $sum_price)
                                <th style="background-color: rgba(0,0,255,0.25)">{{number_format(abs($sum_sum) - $sum_price)}}</th>
                            @else
                                <th></th>
                            @endif
                        </tr>

                        </tbody>
                    </table>
                    <ul>
                        <li>مبلغ درخواستی مشتری <span
                                style="color: rgba(255,0,0,0.78)">{{number_format($request_money->price)}}</span>
                            میباشد.
                        </li>
                    </ul>
                    <div class="text-left">

                        <a class="btn btn-success" href="javascript:void(0)" id="createNt">تایین وضعیت</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-info" href="{{route('admin.RequestMoney.list')}}"> بازگشت به صفحه قبل</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('RequestMoney.modals.modaal')
    @include('RequestMoney.scripts.script')
@endsection
