@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        حساب مشتریان
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <a href="{{route('admin.customeraccount.print')}}" class="btn btn-primary"
                       target="_blank"
                    >چاپ و نمایش
                    </a>
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>نام مشتری</th>
                            <th>مانده حساب (ریال)</th>
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
    @include('customeraccount.modals.modal')
    @include('customeraccount.scripts.script')
@endsection
