@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div class="caption">
                        آرشیو فروش
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>شماره فاکتور</th>
                            <th>تاریخ صدور</th>
                            <th>فروشنده</th>
                            <th>خریدار</th>
                            <th>تعداد</th>
                            <th>نوع فاکتور</th>
                            <th>جمع کل(ریال)</th>
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
    @include('SellesArchive.modals.modal')
    @include('SellesArchive.scripts.script')
@endsection
