@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        مشخصه محصول
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e6e6e6">
                        <tr>
                            <th style="width: 1px;">ردیف</th>
                            <th>کد</th>
                            <th>گروه کالایی</th>
                            <th>نام</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct">تعریف مشخصه محصول جدید</a>

                </div>
            </div>
        </div>
    </div>
    @include('ProductCharacteristic.modals.modal')
    @include('ProductCharacteristic.scripts.script')
@endsection
