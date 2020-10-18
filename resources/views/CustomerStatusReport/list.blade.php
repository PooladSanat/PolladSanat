@extends('layouts.master')
@section('content')
    @include('message.msg')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        صورت وضعیت مشتریان
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-3">
                            <label>نام مشتری:</label>
                            <select class="form-control" id="customer_id" name="customer_id">
                                <option value="0">تمام مشتریان</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>از تاریخ:</label>
                            <input autocomplete="off" type="text" id="indate" name="indate" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>تا تاریخ:</label>
                            <input autocomplete="off" type="text" id="todate" name="todate" class="form-control">
                        </div>
                        <div class="col-md-1">
                            <br/>
                            <button type="button" name="filter" id="filter" class="form-control btn btn-primary">
                                جستجو
                            </button>
                        </div>
                    </div>
                    <br/>
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>کد صورت حساب</th>
                            <th>تاریخ صدور</th>
                            <th>مبلغ صورت حساب(ریال)</th>
                            <th>جمع اسناد دریافتی(ریال)</th>
                            <th>مانده حساب(ریال)</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot align="right">
                        <tr>
                            <th colspan="3">جمع کل</th>
                            <th id="sum_gg">0</th>
                            <th id="sum_hh">0</th>
                            <th id="sum_jj">0</th>
                        </tr>
                        {{--                        <tr>--}}
                        {{--                            <th colspan="5">مانده حساب(مانده حساب مشتری از قبل در سیستم)</th>--}}
                        {{--                            <th id="sum_customer">0</th>--}}
                        {{--                        </tr>--}}
                        <tr>
                            <th colspan="5">جمع مبالغ فاکتورهای در جریان</th>
                            <th id="sum_j">0</th>
                        </tr>
                        <tr>
                            <th colspan="5">صورت وضعیت</th>
                            <th id="summ">0</th>
                        </tr>
                        </tfoot>
                    </table>
                    <br/>
                    <hr/>
                    <br/>

                    <table class="table table-striped table-bordered">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th>مانده حساب مشتری</th>
                            <th>صورت وضعیت فعلی</th>
                            <th>صورت وضعیت با احتساب مانده حساب مشتری</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td id="a">0</td>
                            <td id="b">0</td>
                            <td id="c">0</td>
                        </tr>
                        </tbody>
                        <tbody>
                        </tbody>
                    </table>

                    <br/>
                    <hr/>
                    <br/>

                    <table class="table table-striped table-bordered data" id="data">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th colspan="13">
                                <center style="text-align: center">پرداختی های مشتری</center>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>نوع سند</th>
                            <th width="15%">بابت</th>
                            <th>شماره سند</th>
                            <th>تاریخ</th>
                            <th>بانک</th>
                            <th>نام صادر کننده</th>
                            <th>مبلغ</th>
                            <th>وصول</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>


                    <div class="text-left">

                        <button type="button" name="bulk_delete"
                                id="bulk_delete" class="btn btn-success"
                        >چاپ صورت وضعیت
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('CustomerStatusReport.modals.modal')
    @include('CustomerStatusReport.scripts.script')
@endsection
