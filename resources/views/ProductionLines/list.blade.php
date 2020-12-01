@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست خطوط تولید
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e6e6e6">
                        <tr>
                            <th>کد دستگاه</th>
                            <th>وضعیت دستگاه</th>
                            <th>قالب نصب شده</th>
                            <th>اینسرت نصب شده</th>
                            <th>تعداد سفارش باقی مانده</th>
                            <th>مدت زمان</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('ProductionLines.modals.modal')
    @include('ProductionLines.scripts.script')
@endsection
