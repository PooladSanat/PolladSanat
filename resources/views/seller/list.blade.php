@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        تامیین کنندگان
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>کد</th>
                            <th>نام شرکت</th>
                            <th>نام شخص رابط</th>
                            <th>سمت</th>
                            <th>شماره تلفن</th>
                            <th>داخلی</th>
                            <th>همراه</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">تعریف تامیین کننده جدید</a>

                </div>
            </div>
        </div>
    </div>
    @include('seller.modals.modal')
    @include('seller.scripts.script')
@endsection
