@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box red-sunglo">

                <div class="portlet-title">

                    <div class="caption">
                        فاکتور های تسویه نشده
                    </div>
                    <div class="tools"></div>
                </div>

                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-2">
                            <label>نام فروشنده:</label>
                            <select class="form-control" id="user_id" name="user_id">
                                <option value="0">تمام فروشندها</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
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
                            <input type="text" id="indate" name="indate" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>تا تاریخ:</label>
                            <input type="text" id="todate" name="todate" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <br/>
                            <button type="button" name="filter" id="filter" class="form-control btn btn-primary">
                                جستجو
                            </button>
                        </div>
                    </div>
                    <br/>
                    <table class="table table-striped table-bordered data-table"
                           id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px"><input type="checkbox" id="select_all"></th>
                            <th>مشتری</th>
                            <th>فروشنده</th>
                            <th>فاکتور</th>
                            <th>شماره حواله</th>
                            <th>شماره فاکتور راهکاران</th>
                            <th>تاریخ فاکتور</th>
                            <th>مبلغ(ریال)</th>
                            <th>نحوه پرداخت</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <button type="button" name="bulk_delete"
                            id="bulk_delete" class="btn btn-primary"
                    >صدور صورت حساب
                    </button>
                </div>
            </div>
        </div>
    </div>
    @include('payment.modals.modal')
    @include('payment.scripts.script')
@endsection
