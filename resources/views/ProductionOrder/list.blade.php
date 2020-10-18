@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست سفارشات تولید
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px;">ردیف</th>
                            <th>کد سفارش</th>
                            <th>نام محصول</th>
                            <th>رنگ</th>
                            <th>تعداد تولید</th>
                            <th>تاریخ سفارش</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="{{route('admin.productionorder.wizard')}}">سفارش جدید</a>

                </div>
            </div>
        </div>
    </div>
    @include('ProductionOrder.modals.modal')
    @include('ProductionOrder.scripts.script')
@endsection
