@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption">
                        خرید های تسویه شده
                    </div>
                    <div class="tools"></div>
                </div>

                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">
                            <label>نام مشتری:</label>
                            <select class="form-control" id="customer_id" name="customer_id">
                                <option value="">انتخاب کنید...</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>سال:</label>
                            <select class="form-control" name="year" id="year">
                                <option value="">انتخاب کنید...</option>
                                <option value="1398">1398</option>
                                <option value="1399">1399</option>
                                <option value="1400">1400</option>
                                <option value="1401">1401</option>
                                <option value="1402">1402</option>
                                <option value="1403">1403</option>
                                <option value="1404">1404</option>
                                <option value="1405">1405</option>
                                <option value="1406">1406</option>
                                <option value="1407">1407</option>
                                <option value="1408">1408</option>
                                <option value="1409">1409</option>
                                <option value="1410">1410</option>
                                <option value="1411">1411</option>
                                <option value="1412">1412</option>
                                <option value="1413">1413</option>
                                <option value="1414">1414</option>
                                <option value="1415">1415</option>
                                <option value="1416">1416</option>
                                <option value="1417">1417</option>
                                <option value="1418">1418</option>
                                <option value="1419">1419</option>
                                <option value="1420">1420</option>
                                <option value="1421">1421</option>
                                <option value="1422">1422</option>
                                <option value="1423">1423</option>
                                <option value="1424">1424</option>
                                <option value="1425">1425</option>
                                <option value="1426">1426</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>ماه:</label>
                            <select class="form-control" name="month" id="month">
                                <option value="">انتخاب کنید ...</option>
                                <option value="1">فروردین</option>
                                <option value="2">اردیبهشت</option>
                                <option value="3">خرداد</option>
                                <option value="4">تیر</option>
                                <option value="5">مرداد</option>
                                <option value="6">شهریور</option>
                                <option value="7">مهر</option>
                                <option value="8">آبان</option>
                                <option value="9">آذر</option>
                                <option value="10">دی</option>
                                <option value="11">بهمن</option>
                                <option value="12">اسفند</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <br/>
                            <button type="button" name="filter" id="filter" class="form-control btn btn-primary">
                                جستجو
                            </button>
                        </div>


                    </div>
                    <br/>
                    <table class="table table-striped table-bordered cell-border stripe display data-table"
                           id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">مشتری</th>
                            <th>فاکتور</th>
                            <th>مبلغ(ریال)</th>
                            <th>نحوه پرداخت</th>
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
    @include('paymentsuccess.modals.modal')
    @include('paymentsuccess.scripts.script')
@endsection
