@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div class="caption">
                        لیست مرجوعی های تایید نشده
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th width="1px">
                                <input type="checkbox" id="select_all">
                            </th>

                            <th style="width: 1px">کد مرجوعی</th>
                            <th>تاریخ ثبت</th>
                            <th>فروشنده</th>
                            <th>مشتری</th>
                            <th>نام محصول</th>
                            <th>رنگ</th>
                            <th>تعداد مرجوعی</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="bulk_delete">ارسال به حواله های
                        خروج</a>

                </div>
            </div>
        </div>
    </div>
    @include('returns.modals.modal')
    @include('returns.scripts.nscript')
@endsection
