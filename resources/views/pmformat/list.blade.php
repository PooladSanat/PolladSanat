@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        PM قالب
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>دستگاه</th>
                            <th>ازتاریخ</th>
                            <th>تاتاریخ</th>
                            <th>ازساعت</th>
                            <th>تاساعت</th>
                            <th>وضعیت</th>
                            <th>علت</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">ثبت pm جدید</a>
                </div>
            </div>
        </div>
    </div>
    @include('pmformat.modals.modal')
    @include('pmformat.scripts.script')
@endsection
