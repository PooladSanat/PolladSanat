@extends('layouts.master')
@section('content')
    @include('message.msg')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست تراکنش های مشتری
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
                            <th>تاریخ</th>
                            <th>شرح</th>
                            <th>بدهکار</th>
                            <th>بستانکار</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot align="right">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th colspan="3">باقیمانده حساب مشتری</th>
                            <th id="sum_pricee"></th>
                            <th id="sum_price"></th>
                        </tr>
                        {{--                        <tr>--}}
                        {{--                            <th colspan="5">مانده حساب(مانده حساب مشتری از قبل در سیستم)</th>--}}
                        {{--                            <th id="sum_customer">0</th>--}}
                        {{--                        </tr>--}}


                        </tfoot>
                    </table>
                    <br/>
                    <div class="text-left">

                        <button type="button" name="bulk_delete"
                                id="bulk_delete" class="btn btn-success"
                        >چاپ لیست تراکنش
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('CustomerTransactions.modals.modal')
    @include('CustomerTransactions.scripts.script')
@endsection
