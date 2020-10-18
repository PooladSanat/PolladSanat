@extends('layouts.master')
@section('content')
    <form autocomplete="off" id="productForm"
          name="productForm"
          enctype="multipart/form-data"
          method="post"
    >
        @csrf
        <input type="hidden" name="id" id="id" value="{{$id->id}}">
        <input type="hidden" name="sum_selll" id="sum_selll">
        <input type="hidden" name="number_selll" id="number_selll">
        <input type="hidden" name="price_selll" id="price_selll">
        <input type="hidden" name="price_full" id="price_full">
        <input type="hidden" name="taa" id="taa">
        <input type="hidden" name="price_f" id="price_f">
        <input type="hidden" name="ma" id="ma">
        <input type="hidden" name="takhh" id="takhh" value="{{$id->takhfif}}">
        <input type="hidden" name="createsa" id="createsa" value="{{$id->create}}">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            ویرایش مشخصات پیش فاکتور
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="row">


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام فروشنده
                                    </label>
                                    <select id="user_id" name="user_id" class="form-control"
                                            required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}"
                                                    @if($id->user_id == $user->id)
                                                    selected
                                                @endif
                                            >{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام خریدار
                                    </label>
                                    <select id="customer_id" name="customer_id" class="form-control"
                                            required>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}"
                                                    @if($id->customer_id == $customer->id)
                                                    selected
                                                @endif
                                            >{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نوع فاکتور
                                    </label>
                                    <select id="InvoiceType" name="InvoiceType" class="form-control"
                                            required>
                                        <option value="1" @if($id->invoiceType == 1) selected @endif>رسمی</option>
                                        <option value="2" @if($id->invoiceType == 2) selected @endif>غیر رسمی</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نحوه پرداخت
                                    </label>
                                    <select id="paymentMethod" name="paymentMethod" class="form-control"
                                            required>
                                        <option value="نقدی" @if($id->paymentMethod == "نقدی") selected @endif>نقدی
                                        </option>
                                        <option value="بصورت چک 1 ماهه"
                                                @if($id->paymentMethod == "بصورت چک 1 ماهه") selected @endif>بصورت چک 1
                                            ماهه
                                        </option>
                                        <option value="بصورت چک 2 ماهه"
                                                @if($id->paymentMethod == "بصورت چک 2 ماهه") selected @endif>بصورت چک 2
                                            ماهه
                                        </option>
                                        <option value="بصورت چک 3 ماهه"
                                                @if($id->paymentMethod == "بصورت چک 3 ماهه") selected @endif>بصورت چک 3
                                            ماهه
                                        </option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>تخفیف
                                    </label>
                                    <input type="text" name="takhfif" id="takhfif"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>سایر هزینه ها
                                    </label>
                                    <input type="text" value="{{$id->expenses}}" name="expenses" id="expenses"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>هزینه حمل
                                    </label>
                                    <input type="text" value="{{$id->Carry}}" name="Carry" id="Carry"
                                           class="form-control">
                                </div>
                            </div>




                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>تاریخ صدور پیش فاکتور
                                    </label>

                                    <input type="text" name="created" id="created"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>توضیحات
                                    </label>
                                    <textarea id="description"
                                              placeholder="لطفا توضیحات خود را در مورد پیش فاکتور وارد کنید"
                                              name="description" class="form-control">
{{$id->description}}
                                                    </textarea>
                                </div>
                            </div>


                        </div>
                        <div class="table table-responsive">
                            <table
                                class="table table-responsive table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>نام محصول</td>
                                    <td>رنگ</td>
                                    <td>قیمت فروش</td>
                                    <td>تعداد فروش</td>
                                    <td>مبلغ فروش</td>
                                    <td>وزن محصول فروخته شده</td>
                                    <td>مالیات</td>
                                    <td>عملیات</td>
                                </tr>
                                </thead>
                                <tbody
                                    id="TextBoxContainerbank">
                                <tr>
                                    <td id="productt"></td>
                                    <td id="colorr"></td>
                                    <td id="selll"></td>
                                    <td id="numberr">
                                    </td>
                                    <td id="Price_Selll">
                                    </td>

                                    <td id="Weightt"></td>
                                    <td id="Taxx"></td>
                                    <td id="actiont"></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="2">
                                        جمع
                                    </th>
                                    <th>
                                        <label id="sum_sell">0</label>
                                    </th>
                                    <th>
                                        <label id="number_sell">0</label>
                                    </th>
                                    <th>
                                        <label id="price_sell">0</label>
                                    </th>
                                    <th>
                                        <label id="Weight">0</label>
                                    </th>
                                    <th>
                                        <label id="tax">0</label>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="6">
                                        <center>تخفیف</center>
                                    </th>
                                    <th id="ta"></th>
                                </tr>
                                <tr>
                                    <th colspan="6">
                                        <center>جمع نهایی</center>
                                    </th>
                                    <th id="totalfinal"></th>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>

                </div>
                <div class="pull-left">
                    <button style="width: 130px" type="submit" class="btn btn-success" id="saveBtn" value="ثبت">
                        ثبت
                    </button>
                    &nbsp;&nbsp;
                    <a href="{{route('admin.invoice.success')}}" style="width: 130px" type="submit"
                       class="btn btn-danger">
                        برگشت
                    </a>
                </div>


            </div>


        </div>
    </form>




    @include('sell.scripts.suedit')





@endsection
