@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        جزییات فاکتور تایید شده
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="dataa-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th>نام محصول</th>
                            <th>رنگ</th>
                            <th>تعداد</th>
                            <th>فروشنده</th>
                            <th>مشتری</th>
                            <th>موجودی انبار</th>
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
    @include('sell.scripts.detailsuccess')
    @include('sell.modals.detailsuccess')

@endsection
