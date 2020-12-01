@extends('layouts.master')
@section('content')

    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        برنامه ریزی تولید
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs" style="background-color: white">
                            <li style="background-color: #e6e6e6" class="active"><a href="#a" data-toggle="tab">برنامه ریزی</a></li>
                            <li style="background-color: #e6e6e6"><a href="#b" data-toggle="tab">برنامه های جاری</a></li>

                        </ul>
                        <div class="tab-content">

                            <div class="active tab-pane" id="a">
                                <br/>
                                <table class="table table-striped table-bordered data-table" id="data-table">
                                    <thead style="background-color: #e6e6e6">
                                    <tr>
                                        <th style="width: 1px">ردیف</th>
                                        <th>محصول</th>
                                        <th>حداقل(عدد)</th>
                                        <th>حداکثر(عدد)</th>
                                        <th>موجودی قابل فروش انبار(عدد)</th>
                                        <th>تعداد برنامه ریزی شده(عدد)</th>
                                        <th>تعداد نیاز به تولید(عدد)</th>
                                        <th>دستگاه</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="b">
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach($devices as $device)
                                            <div class="portlet box blue">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        دستگاه {{$device->name}}
                                                    </div>
                                                    <div class="tools"></div>
                                                </div>
                                                <div class="portlet-body">
                                                    <table
                                                        class="table table-striped table-bordered device_data-table{{$device->id}}"
                                                        id="device_data-table{{$device->id}}">
                                                        <thead style="background-color: #e6e6e6">
                                                        <tr>
                                                            <th style="width: 1px">شماره برنامه</th>
                                                            <th>محصول</th>
                                                            <th>قالب</th>
                                                            <th>اینسرت</th>
                                                            <th style="width: 1px">برنامه</th>
                                                            <th style="width: 1px">باقی مانده</th>
                                                            <th>زمان شروع</th>
                                                            <th>زمان پایان</th>
                                                            <th>وضعیت برنامه</th>
                                                            <th>وضعیت مواد</th>
                                                            <th>تاریخ تامیین مواد</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tablecontentss">
                                                        </tbody>
                                                    </table>


                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @include('ViewProduction.modals.modal')
    @include('ViewProduction.scripts.script')
@endsection
