@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        برنامه ریزی تولید
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>محصول</th>
                            <th>رنگ</th>
                            <th>تعدا موجودی انبار</th>
                            <th>تعداد سفارش در جریان</th>
                            <th>تعداد موجودی موقت</th>
                            <th>مجموع</th>
                            <th>حداقل</th>
                            <th>حداکثر</th>
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
    @include('ViewProduction.modals.modal')
    @include('ViewProduction.scripts.script')
@endsection
