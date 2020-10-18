@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست ضایعات رنگ
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>قالب</th>
                            <th>از رنگ</th>
                            <th>به رنگ</th>
                            <th>ضایعات قابل مصرف(Kg)</th>
                            <th>ضایعات غیر قابل مصرف(Kg)</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">تعریف جدید</a>
                </div>
            </div>
        </div>
    </div>
    @include('ColorScrap.modals.modal')
    @include('ColorScrap.scripts.script')
@endsection