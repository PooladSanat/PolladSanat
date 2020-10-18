@extends('layouts.master')


@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green-haze">
                <div class="portlet-title">
                    <div class="caption">
                        لیست پیش فاکتورهای تایید شده
                    </div>
                </div>
                <div class="portlet-body">
                    <form autocomplete="off" id="productForm"
                          name="productForm" class="form-horizontal">
                        @csrf
                    </form>
                    <table class="table table-striped table-bordered data-table " id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th>
                                <input type="checkbox" id="select_all">
                            </th>
                            <th style="width: 1px">شماره فروش</th>
                            <th>شماره فاکتور</th>
                            <th>نام فروشنده</th>
                            <th>نام خریدار</th>
                            <th>نام محصول</th>
                            <th>رنگ</th>
                            <th>تعداد</th>
                            <th>باقیمانده</th>
                            <th>موجودی انبار</th>
                            <th>جمع تقاضا</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="bulk_delete">ارسال برای زمان بندی
                        بارگیری</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-danger" href="javascript:void(0)" id="To_List">ارسال برای صف تولید</a>
                </div>
            </div>
        </div>
    </div>
    @include('sell.scripts.success')
    @include('sell.modals.success')
@endsection
