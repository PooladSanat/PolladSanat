@extends('layouts.master')
@section('content')
    @include('message.msg')

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        گزارش عملکرد ماهانه
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-3">

                        </div>

                        <div class="col-md-2">
                            <label>از تاریخ:</label>
                            <input type="text" autocomplete="off" id="indate" name="indate" a class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>تا تاریخ:</label>
                            <input type="text" autocomplete="off" id="todate" name="todate" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <br/>
                            <button type="button" name="filter" id="filter" class="form-control btn btn-primary">
                                جستجو
                            </button>
                        </div>

                    </div>
                    <br/>
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px;text-align: center">تاریخ</th>
                            <th>تعداد تولید(عدد)</th>
                            <th>تعداد فروش(عدد)</th>
                            <th>مبلغ فروش(ریال)</th>
                            <th>تعداد مرجوعی(عدد)</th>
                            <th>اسناد دریافتی(ریال)</th>

                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot align="right">
                        <tr>
                            <th style="background-color: rgba(255,106,107,0.51)"></th>
                            <th style="background-color: rgba(255,106,107,0.51)"></th>
                            <th style="background-color: rgba(255,106,107,0.51)"></th>
                            <th style="background-color: rgba(255,106,107,0.51)"></th>
                            <th style="background-color: rgba(255,106,107,0.51)"></th>
                            <th style="background-color: rgba(255,106,107,0.51)"></th>

                        </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('ReportMonthly.modals.modal')
    @include('ReportMonthly.scripts.script')
@endsection
