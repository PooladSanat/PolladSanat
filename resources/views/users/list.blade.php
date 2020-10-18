@extends('layouts.master')

@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست کاربران
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered data-table"
                           id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px;text-align: center">ردیف</th>

                            <th> نام و نام خانوادگی</th>

                            <th>نقش</th>

                            <th>نام کاربری</th>

                            <th> شماره تماس</th>

                            <th>انلاین</th>

                            <th> وضعیت</th>

                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a class="btn btn-primary" href="javascript:void(0)" id="createNewProduct">تعریف کاربر جدید</a>
                </div>
            </div>
        </div>
    </div>
    @include('users.modals.modal')
    @include('users.scripts.script')
@endsection
