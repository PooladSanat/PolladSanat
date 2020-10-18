@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        انبار مستربچ
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px;">ردیف</th>
                            <th>نام رنگ</th>
                            <th>نام سازنده</th>
                            <th>درصد ترکیب</th>
                            <th>کد مستربچ</th>
                            <th>موجودی پرند</th>
                            <th>موجودی تهرانپارس</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td id="a"></td>
                            <td id="b"></td>
                            <td id="c"></td>
                            <td id="d"></td>
                            <td id="e"></td>
                            <td id="p"></td>
                            <td id="r"></td>
                            <td id="f"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('barncolors.modals.modal')
    @include('barncolors.scripts.script')
@endsection
