@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                       لیست درخواستهای وجه
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>نام مشتری</th>
                            <th>مبلغ</th>
                            <th>اولویت</th>
                            <th>توضیحات</th>
                            <th>تاریخ درخواست</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">درخواست وجه جدید</a>
                </div>
            </div>
        </div>
    </div>
    @include('RequestMoney.modals.modal')
    @include('RequestMoney.scripts.script')
@endsection
