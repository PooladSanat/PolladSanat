@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لیست اسناد دریافتی
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-1">

                        </div>
                        <div class="col-md-2">
                            <label>نام مشتری:</label>
                            <select class="form-control" id="customer_id" name="customer_id">
                                <option value="0">تمام مشتریان</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>از تاریخ:</label>
                            <input type="text" id="indate" name="indate" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>تا تاریخ:</label>
                            <input type="text" id="todate" name="todate" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>نام بانک:</label>
                            <select class="form-control" id="name" name="name">
                                <option value="0">تمام بانک ها</option>
                                <option value="بانک ملّی ایران">بانک ملّی ایران</option>
                                <option value='بانک سپه'>بانک سپه</option>
                                <option value='بانک صنعت و معدن'>بانک صنعت و معدن</option>
                                <option value='بانک کشاورزی'>بانک کشاورزی</option>
                                <option value='بانک مسکن'>بانک مسکن</option>
                                <option value='بانک توسعه صادرات ایران'>بانک توسعه صادرات ایران</option>
                                <option value='بانک توسعه تعاون'>بانک توسعه تعاون</option>
                                <option value='پست بانک ایران'>پست بانک ایران</option>
                                <option value='بانک اقتصاد نوین'>بانک اقتصاد نوین</option>
                                <option value='بانک پارسیان'>بانک پارسیان</option>
                                <option value='بانک کارآفرین'>بانک کارآفرین</option>
                                <option value='بانک سامان'>بانک سامان</option>
                                <option value='بانک سینا'>بانک سینا</option>
                                <option value='بانک خاور میانه'>بانک خاور میانه</option>
                                <option value='بانک شهر'>بانک شهر</option>
                                <option value='بانک دی'>بانک دی</option>
                                <option value='بانک صادرات'>بانک صادرات</option>
                                <option value='بانک ملت'>بانک ملت</option>
                                <option value='بانک تجارت'>بانک تجارت</option>
                                <option value='بانک رفاه'>بانک رفاه</option>

                                <option value='بانک حکمت ایرانیان'>بانک حکمت ایرانیان</option>

                                <option value='بانک گردشگری'>بانک گردشگری</option>

                                <option value='بانک ایران زمین'>بانک ایران زمین</option>

                                <option value='بانک قوامین'>بانک قوامین</option>

                                <option value='بانک انصار'>بانک انصار</option>

                                <option value='بانک سرمایه'>بانک سرمایه</option>

                                <option value='بانک پاسارگاد'>بانک پاسارگاد</option>

                                <option value='بانک مشترک ایران-ونزوئلا'>بانک مشترک ایران-ونزوئلا</option>

                                <option value='بانک قرض‌الحسنه مهر ایران'>بانک قرض‌الحسنه مهر ایران</option>

                                <option value='بانک قرض‌الحسنه رسالت'>بانک قرض‌الحسنه رسالت</option>

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
                    <table class="table table-striped table-bordered data-table" id="data-table">
                        <thead style="background-color: #e8ecff">
                        <tr>
                            <th style="width: 1px">ردیف</th>
                            <th>نام مشتری</th>
                            <th>بابت</th>
                            <th>نوع سند</th>
                            <th>تاریخ سند</th>
                            <th>بانک</th>
                            <th>نام صادر کننده</th>
                            <th>مبلغ</th>
                            <th>تاریخ دریافت</th>
                            <th>توضیحات</th>
                            <th>وصول</th>
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
    @include('Paymentdocuments.modals.modal')
    @include('Paymentdocuments.scripts.script')
@endsection
