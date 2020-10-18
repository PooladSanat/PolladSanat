@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست موجودی انبار مواد پلیمری
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>نوع مواد</th>
                            <th>نام مواد</th>
                            <th>شرکت سازنده</th>
                            <th>توضیحات</th>
                            <th>موجودی انبار پرند(کیلوگرم)</th>
                            <th>موجودی انبار تهرانپارس(کیلوگرم)</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('barnmaterials.modals.modal')
    @include('barnmaterials.scripts.script')
@endsection
