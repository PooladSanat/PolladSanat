@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                       مستربچ ها
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>کد مستربچ</th>
                            <th>نام سازنده</th>
                            <th>درصد ترکیب(درصد)</th>
                            <th>قیمت(ریال)</th>
                            <th>نام رنگ</th>
                            <th>حداقل</th>
                            <th>حداکثر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">تعریف مستربچ جدید</a>
                </div>
            </div>
        </div>
    </div>
    @include('colors.modals.modal')
    @include('colors.scripts.script')
@endsection
