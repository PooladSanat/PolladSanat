@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        هدف گذاری فروش
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th>ردیف</th>
                            <th>سال</th>
                            <th>فروردین</th>
                            <th>اردیبهشت</th>
                            <th>خرداد</th>
                            <th>تیر</th>
                            <th>مرداد</th>
                            <th>شهریور</th>
                            <th>مهر</th>
                            <th>آبان</th>
                            <th>آذر</th>
                            <th>دی</th>
                            <th>بهمن</th>
                            <th>اسفند</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">تعریف هدف جدید</a>
                </div>
            </div>
        </div>
    </div>
    @include('target.modals.modal')
    @include('target.scripts.script')
@endsection
