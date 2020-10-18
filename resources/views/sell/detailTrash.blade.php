@extends('layouts.master')
@section('content')
    @include('message.msg')
    <script
        src="{{asset('/public/js/5.js')}}"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        جزییات پیش فاکتور
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-fluid" id="myTable">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th>شماره پیش فاکتور</th>
                            <th>تاریخ فروش</th>
                            <th>نام فروشنده</th>
                            <th>نام خریدار</th>
                            <th>نام محصول</th>
                            <th>رنگ</th>
                            <th>قیمت فروش</th>
                            <th>تعداد فروش</th>
                            <th>مبلغ کل فروش</th>
                            <th>وزن محصول فروخته شده</th>
                            <th>نوع فاکتور</th>
                            <th>مالیات مبلغ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $detail)
                            <tr>

                                <td>{{$invoices->invoiceNumber}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::forge($invoices->created_at)->format('Y/m/d')}}</td>
                                <td>
                                    @foreach($users as $user)
                                        @if($user->id == $invoices->user_id)
                                            {{$user->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($customers as $customer)
                                        @if($customer->id == $invoices->customer_id)
                                            {{$customer->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($products as $product)
                                        @if($product->id == $detail->product_id)
                                            {{$product->label}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($colors as $color)
                                        @if($color->id == $detail->color_id)
                                            {{$color->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{number_format($detail->salesPrice)}} </td>
                                <td>{{number_format($detail->salesNumber)}} </td>
                                <td>{{number_format($detail->sumTotal)}} </td>
                                <td>{{number_format($detail->weight)}} </td>
                                <td>
                                    @if($invoices->invoiceType == 1)
                                        رسمی
                                    @else
                                        غیر رسمی
                                    @endif
                                </td>
                                <td>{{number_format($detail->taxAmount)}} </td>
                                <td>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="6">
                                جمع
                                <hr/>
                                میانگین
                            </th>
                            <th>
                                {{number_format($invoices->sum_sell)}}
                                <hr/>
                                {{number_format($invoices->sum_sell/2)}}

                            </th>
                            <th>
                                {{number_format($invoices->number_sell)}}
                                <hr/>
                                {{number_format($invoices->number_sell/2)}}

                            </th>
                            <th>
                                {{number_format($invoices->price_sell)}}
                                <hr/>
                                {{number_format($invoices->price_sell/2)}}

                            </th>
                            <th>
                                {{number_format($weight)}}
                                <hr/>
                                {{number_format($weight/2)}}

                            </th>
                            <th></th>
                            <th>
                                {{number_format($taxAmount)}}
                                <hr/>
                                {{number_format($taxAmount/2)}}

                            </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    @include('sell.scripts.detail')

@endsection
