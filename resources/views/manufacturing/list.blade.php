@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">


            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        دستگاه BU1200
                    </div>
                    <div class="tools"></div>
                </div>

                <div class="portlet-body">

                    <table class="table table-striped table-bordered device1" id="device1">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">اولویت</th>
                            <th>محصول</th>
                            <th>رنگ</th>
                            <th>تعداد</th>
                            <th>قالب</th>
                            <th>Insert</th>
                            <th>تعداد تولید شده</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <diV class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <label style="color: red"> توقفات امروز تا به این لحظه : {{$full_time_stop}} دقیقه</label>
                            </div>
                            <div class="pull-left">
                                <a href="javascript:void(0)" id="BtnStop" class="btn btn-danger">
                                    ثبت توقفات
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        دستگاه BU800
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered device2" id="device2">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th>اولویت</th>
                            <th>محصول</th>
                            <th>رنگ</th>
                            <th>تعداد</th>
                            <th>قالب</th>
                            <th>Insert</th>
                            <th>وزن</th>
                            <th>تعداد تولید شده</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>


{{--            <div class="portlet box blue">--}}
{{--                <div class="portlet-title">--}}
{{--                    <div class="caption">--}}
{{--                        دستگاه BU802--}}
{{--                    </div>--}}
{{--                    <div class="tools"></div>--}}
{{--                </div>--}}
{{--                <div class="portlet-body">--}}
{{--                    <table class="table table-striped table-bordered device3" id="device3">--}}
{{--                        <thead style="background-color: #e8ecff">--}}
{{--                        <tr>--}}
{{--                            <th>اولویت</th>--}}
{{--                            <th>محصول</th>--}}
{{--                            <th>رنگ</th>--}}
{{--                            <th>تعداد</th>--}}
{{--                            <th>قالب</th>--}}
{{--                            <th>Insert</th>--}}
{{--                            <th>وزن</th>--}}
{{--                            <th>تعداد تولید شده</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}


        </div>
    </div>
    @include('manufacturing.scripts.script')
    @include('manufacturing.modals.modal')
@endsection
