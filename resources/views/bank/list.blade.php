@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست حسابهای بانکی
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>نام صاحب حساب</th>
                            <th>نام بانک</th>
                            <th>شماره کارت</th>
                            <th>شماره حساب</th>
                            <th>شماره شبا</th>
                            <th>وضعیت حساب</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">تعریف حساب جدید</a>
                </div>
            </div>
        </div>
    </div>
    @include('bank.modals.modal')
    @include('bank.scripts.script')
@endsection
