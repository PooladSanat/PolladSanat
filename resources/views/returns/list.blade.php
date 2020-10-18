@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div class="caption">
                       لیست مرجوعی ها
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px;">ردیف</th>
                            <th style="width: 1px">کد مرجوعی</th>
                            <th>تاریخ ثبت</th>
                            <th>فروشنده</th>
                            <th>مشتری</th>
                            <th>تعداد مرجوعی</th>
                            <th>توضیحات مشتری</th>
                            <th>توضیحات فروش</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">تعریف مرجوعی جدید</a>

                </div>
            </div>
        </div>
    </div>
    @include('returns.modals.modal')
    @include('returns.scripts.script')
@endsection
