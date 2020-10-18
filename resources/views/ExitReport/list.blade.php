@extends('layouts.master')
<?php
$role_id = DB::table('role_user')
    ->where('user_id', auth()->user()->id)
    ->first();
$role_name = DB::table('roles')
    ->where('id', $role_id->role_id)
    ->first();
$custome = \App\Customer::where('expert', auth()->user()->id)->get();
?>
@section('content')
    @include('message.msg')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        گزارش آرشیو فروش
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label>از تاریخ:</label>
                            <input autocomplete="off" type="text" id="indate" name="indate" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>تا تاریخ:</label>
                            <input autocomplete="off" type="text" id="todate" name="todate" class="form-control">
                        </div>
                        @if($role_name->name == "Admin" or $role_name->name == "مدیریت")
                            <div class="col-md-3">
                                <label>نام مشتری:</label>
                                <select class="form-control" id="customer_id" name="customer_id">
                                    <option value="0">تمام مشتریان</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <div class="col-md-3">
                                <label>نام مشتری:</label>
                                <select class="form-control" id="customer_id" name="customer_id">
                                    <option value="0">تمام مشتریان</option>
                                    @foreach($custome as $custom)

                                        <option value="{{$custom->id}}">{{$custom->name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if($role_name->name == "Admin" or $role_name->name == "مدیریت")
                            <div class="col-md-2">
                                <label>نام فروشنده:</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    <option value="0">تمام فروشندگان</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="col-md-2">
                            <label>وضعیت پرداخت:</label>
                            <select class="form-control" id="type" name="type">
                                <option value="0">همه</option>
                                <option value="1">پرداخت شده</option>
                                <option value="2">پرداخت نشده</option>
                            </select>
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
                            <th width="10%">شماره فاکتور</th>
                            <th width="10%">تاریخ خروج</th>
                            <th width="20%">فروشنده</th>
                            <th width="20%">مشتری</th>
                            <th width="10%">تعداد محصول(عدد)</th>
                            <th>مبلغ فاکتور(ریال)</th>
                            <th>وضعیت پرداخت</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot align="right">
                        <tr style="background-color: rgba(0,162,60,0.2)">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="text-left">

                        <button type="button" name="bulk_delete"
                                id="bulk_delete" class="btn btn-success"
                        >چاپ گزارش آرشیو فروش
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('ExitReport.modals.modal')
    @include('ExitReport.scripts.script')
@endsection
