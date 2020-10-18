@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box red-sunglo">
                <div class="portlet-title">
                    <div class="caption">
                        لیست شکایات
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>کد شکایت</th>
                            <th>تاریخ شکایت</th>
                            <th>مشتری</th>
                            <th>میزان اهمیت</th>
                            <th>شماره فاکتور مربوطه</th>
                            <th>موضوع</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">ثبت شکایات جدید</a>
                </div>
            </div>
        </div>
    </div>
    @include('Complaints.modals.modal')
    @include('Complaints.scripts.script')
@endsection
