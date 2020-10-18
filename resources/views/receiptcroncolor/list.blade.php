@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        رسید مستربچ
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>نام سازنده</th>
                            <th>رنگ</th>
                            <th>تعداد</th>
                            <th>تاریخ</th>
                            <th>ساعت</th>
                            <th>انبار</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">رسید جدید</a>
                </div>
            </div>
        </div>
    </div>
    @include('receiptcroncolor.modals.modal')
    @include('receiptcroncolor.scripts.script')
@endsection
