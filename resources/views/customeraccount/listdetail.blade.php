@extends('layouts.master')
@section('content')
    @include('message.msg')
    <input type="hidden" name="iii" id="iiii" value="{{$id}}">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        جزییات پرداخت مشتری
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered ee" id="ee">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>نام مشتری</th>
                            <td>نوع پرداخت</td>
                            <td>شماره چک</td>
                            <td>نام بانک</td>
                            <td>نام صادر کننده</td>
                            <td>مبلغ(ریال)</td>
                            <td>تاریخ وصول چک</td>
                            <td>تاریخ ثبت در سیستم</td>
                            <td>عملیات</td>
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
