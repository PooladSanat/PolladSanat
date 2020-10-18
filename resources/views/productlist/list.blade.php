@extends('layouts.master')
@section('content')
    @include('message.msg')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        درخواست تولید
                    </div>

                    <div class="tools"></div>

                </div>


                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>کارشناس فروش</th>
                            <th>محصول</th>
                            <th>رنگ</th>
                            <th>تعداد(عدد)</th>
                            <th>اولویت</th>
                            <th>تاریخ درخواستی کارشناس</th>
                            <th>تاریخ اتمام تولید</th>
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
    @include('productlist.modals.modal')
    @include('productlist.scripts.script')
@endsection
