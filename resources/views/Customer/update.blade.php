@extends('layouts.master')
@include('Customer.scripts.update')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        ثبت اطلاعات مشتری جدید
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body">
                    <div class="registercontpage">
                        <div class="stepwizard col-md-offset-3">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step">
                                    <a href="#step-1" type="button"
                                       class="btn btn-circle btn-default1 btn-primary">1</a>
                                    <p>اطلاعات پایه</p>
                                </div>

                                <div class="stepwizard-step">
                                    <a href="#step-2" type="button" class="btn btn-default1 btn-circle"
                                       disabled="disabled">2</a>
                                    <p>اطلاعات تکمیلی</p>
                                </div>

                            </div>
                        </div>

                        <form autocomplete="off" id="productForm"
                              name="productForm"
                              enctype="multipart/form-data"
                              method="post"
                        >
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$id->id}}">
                            <input type="hidden" id="id_customer" name="id" value="{{$id->id}}">
                            <input type="hidden" id="zone_id" name="zone_id" value="{{$id->city}}">
                            <input type="hidden" id="areas_id" name="areas_id" value="{{$id->staate}}">
                            <input type="hidden" id="datew" name="datew" value="{{$id->date}}">
                            @if(!empty($customer_company->Established_company))
                                <input type="hidden" id="Established_companyr" name="Established_companyr"
                                       value="{{$customer_company->Established_company}}">
                            @endif
                            <div class="row setup-content" id="step-1" style="display: block;">
                                <br/>
                                <hr/>
                                <div class="col-md-12">
                                    <div class="col-md-6 form-group">
                                        <div class="col-md-12">
                                            <div class="form-group field ">
                                                <label class="col-md-4"> کد راهکاران </label>
                                                <div class="col-md-8">
                                                    <input type="text" id="code"
                                                           name="code"
                                                           class="form-control"
                                                           value="{{$id->code}}"
                                                           placeholder="لطفا کد مشتری را وارد کنید">
                                                </div>
                                            </div>
                                            <div class="form-group field ">
                                                <label class="control-label main col-md-4"> نحوه اشنایی <span
                                                        style="color: red" class="required-mark">*</span></label>
                                                <div class="col-md-8">
                                                    <select dir="rtl" id="select2-eapl" class="form-control"
                                                            name="methodd" multiple
                                                            required>
                                                        @foreach($methods as $method)
                                                            <option
                                                                value="{{$method->method}}"

                                                                @if($id->method == $method->method)
                                                                selected
                                                                @endif
                                                            >{{$method->method}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="form-group field ">
                                                <label class="control-label main col-md-4"> کشور <span
                                                        style="color: red" class="required-mark">*</span></label>
                                                <div class="col-md-8">
                                                    <select dir="rtl" class="form-control"
                                                            name="country"
                                                            id="country"
                                                            required>
                                                        @foreach($country as $countr)
                                                            <option value="{{$countr->country_id}}"
                                                                    @if($id->country == $countr->country_id)
                                                                    selected
                                                                @endif
                                                            >{{$countr->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="form-group field ">
                                                <label for="sel1" class="control-label main col-md-4"> نوع مشتری <span
                                                        style="color: red" class="required-mark">*</span></label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="type" id="type"
                                                    >
                                                        @foreach($typeCustomers as $typeCustomer)
                                                            <option
                                                                value="{{$typeCustomer->id}}"
                                                                @if($id->type == $typeCustomer->id)
                                                                selected
                                                                @endif
                                                            >{{$typeCustomer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group field ">
                                                <label for="sel1" class="control-label main col-md-4"> منطقه <span
                                                        style="color: red" class="required-mark">*</span></label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="staate" id="staate">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <div class="col-md-12">
                                            <div class="form-group field ">
                                                <label class="control-label main col-md-4"> نام مشتری <span
                                                        style="color: red" class="required-mark">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" id="name"
                                                           name="name"
                                                           value="{{$id->name}}"
                                                           required="required" class="form-control"
                                                           placeholder="لطفا نام مشتری را وارد کنید">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="form-group field ">
                                                <label class="control-label main col-md-4"> تاریخ اشنایی <span
                                                        style="color: red" class="required-mark">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" id="date"
                                                           name="date"
                                                           required="required" class="form-control"
                                                           placeholder="لطفا تاریخ اشنایی مشتری را وارد کنید">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="form-group field ">
                                                <label class="control-label main col-md-4"> استان <span
                                                        style="color: red"
                                                        class="required-mark">*</span></label>
                                                <div class="col-md-8">
                                                    <select name="city" id="city"
                                                            class="form-control">
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="form-group field ">
                                                <label class="control-label main col-md-4"> کارشناس <span
                                                        style="color: red"
                                                        class="required-mark">*</span></label>
                                                <div class="col-md-8">
                                                    <select class="form-control" id="expert" name="expert">
                                                        @foreach($users as $user)
                                                            @foreach($recents as $recent)
                                                                @if($user->id == $recent->user_id)
                                                                    <option
                                                                        value="{{$user->id}}"
                                                                        @if($id->expert == $user->id)
                                                                        selected
                                                                        @endif
                                                                    >{{$user->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-2">توضیحات</label>
                                        <div class="col-md-10">
                                            <div class="help-block with-errors"></div>
                                            <textarea name="description" id="description" class="form-control"
                                                      rows="2" cols="50"
                                                      placeholder="توضیحات در مورد مشتری">
 {{$id->description}}
                                                </textarea>


                                        </div>
                                    </div>
                                    <button class="btn btn-primary nextBtn pull-right" id="nextBtn"
                                            type="button">
                                        ادامه
                                    </button>
                                </div>
                            </div>

                            <div class="row setup-content" id="step-2" style="display: block;">
                                <br/>
                                <hr/>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div id="personal" style="display: none">
                                            <div class="col-md-12">
                                                <div class="col-md-6 form-group">
                                                    <div class="col-md-12">
                                                        <div class="form-group field ">
                                                            <label for="sel1"
                                                                   class="control-label main col-md-4"> جنسیت <span
                                                                    style="color: red"
                                                                    class="required-mark">*</span></label>
                                                            <div class="col-md-8">
                                                                <select class="form-control" name="sex_personel"
                                                                        id="sex_personel">
                                                                    <option value="1"
                                                                            @if(!empty($customer_personal) and $customer_personal->sex == 1) selected @endif>
                                                                        مرد
                                                                    </option>
                                                                    <option value="2"
                                                                            @if(!empty($customer_personal) and $customer_personal->sex == 2) selected @endif>
                                                                        زن
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group field ">
                                                            <label class="control-label main col-md-4">تلفن
                                                                همراه

                                                                <span
                                                                    style="color: red"
                                                                    class="required-mark">*</span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <input type="text"
                                                                       id="phone_personel"
                                                                       name="phone_personel"
                                                                       @if(!empty($customer_personal->phone_personel))
                                                                       value="{{$customer_personal->phone_personel}}"
                                                                       @endif
                                                                       required="required" class="form-control"
                                                                       placeholder="لطفا شماره تلفن همراه را وارد کنید"
                                                                       data-error="Minimum 3 character required">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group field ">
                                                            <label class="control-label main col-md-4">تلفن ثابت</label>
                                                            <div class="col-md-8">
                                                                <input type="text"
                                                                       id="tel_personel"
                                                                       name="tel_personel"
                                                                       @if(!empty($customer_personal->tel_personel))
                                                                       value="{{$customer_personal->tel_personel}}"
                                                                       @endif
                                                                       required="required" class="form-control"
                                                                       placeholder="لطفا شماره تلفن ثابت را وارد کنید"
                                                                       data-error="Minimum 3 character required">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group field ">
                                                            <label class="control-label main col-md-4">فکس</label>
                                                            <div class="col-md-8">
                                                                <input type="text"
                                                                       id="fax_personel"
                                                                       name="fax_personel"
                                                                       @if(!empty($customer_personal->fax_personel))
                                                                       value="{{$customer_personal->fax_personel}}"
                                                                       @endif
                                                                       required="required" class="form-control"
                                                                       placeholder="لطفا فکس را وارد کنید">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <div class="col-md-12">
                                                        <div class="form-group field ">
                                                            <label class="control-label main col-md-4">کد ملی</label>
                                                            <div class="col-md-8">
                                                                <input type="text"
                                                                       id="codemeli_personel"
                                                                       name="codemeli_personel"
                                                                       @if(!empty($customer_personal->codemeli_personel))
                                                                       value="{{$customer_personal->codemeli_personel}}"
                                                                       @endif
                                                                       required="required" class="form-control"
                                                                       placeholder="لطفا کد ملی را وارد کنید">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group field ">
                                                            <label class="control-label main col-md-4">تاریخ
                                                                تولد</label>
                                                            <div class="col-md-8">
                                                                <input type="text"
                                                                       id="date_personel"
                                                                       name="date_personel"
                                                                       required="required" class="form-control example1"
                                                                       placeholder="لطفا تاریخ تولد را وارد کنید">
                                                                <div class="help-block with-errors"></div>
                                                                @if(!empty($customer_personal->date_personel))
                                                                    <input type="hidden" name="D_date_personel"
                                                                           id="D_date_personel"
                                                                           value="{{$customer_personal->date_personel}}">
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group field ">
                                                            <label class="control-label main col-md-4">ایمیل</label>
                                                            <div class="col-md-8">
                                                                <input type="text"
                                                                       id="email_personel"
                                                                       name="email_personel"
                                                                       @if(!empty($customer_personal->email_personel))
                                                                       value="{{$customer_personal->email_personel}}"
                                                                       @endif
                                                                       required="required" class="form-control"
                                                                       placeholder="لطفا ایمیل را وارد کنید"
                                                                       data-error="Minimum 3 character required">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group col-md-12">
                                                        <label class="control-label col-md-2">ادرس</label>
                                                        <div class="col-md-10">
                                                    <textarea name="adders_personel" id="adders_personel"
                                                              placeholder="لطفا ادرس را وارد کنید" class="form-control"
                                                              rows="2" cols="50">
 @if(!empty($customer_personal->adders_personel))
                                                            {{$customer_personal->adders_personel}}
                                                        @endif
                                                    </textarea>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="control-label col-md-2">توضیحات</label>
                                                        <div class="col-md-10">
                                                   <textarea name="text_personel" id="text_personel"
                                                             placeholder="لطفا توضیحات را وارد کنید"
                                                             class="form-control" rows="2" cols="50">
@if(!empty($customer_personal->text_personel))
                                                           {{$customer_personal->text_personel}}
                                                       @endif
                                                    </textarea>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>


                                        </div>


                                        <div id="company" style="display: none">


                                            <div class="col-md-12">
                                                <div class="nav-tabs-custom">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#activity" data-toggle="tab">مشخصات
                                                                فردی</a></li>
                                                        <li><a href="#car" data-toggle="tab">مشخصات محل کار</a></li>
                                                        <li><a href="#bank" data-toggle="tab">وضعیت بانکی و اعتباری</a>
                                                        </li>
                                                        <li><a href="#tamin" data-toggle="tab">اسامی تامیین کنندگان</a>
                                                        </li>
                                                        <li><a href="#madark" data-toggle="tab">مدارک</a></li>
                                                        <li><a href="#psh" data-toggle="tab">مشخصات پرسنل های شرکت</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="active tab-pane" id="activity">
                                                            <div class="col-md-12">
                                                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                                <div class="portlet box blue">
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            مشخصات فردی
                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="col-md-4 form-group">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group ">
                                                                                            <label
                                                                                                class="control-label col-md-6">کد
                                                                                                اقتصادی</label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="code_company"
                                                                                                       name="code_company"
                                                                                                       @if(!empty($customer_company->code_company))
                                                                                                       value="{{$customer_company->code_company}}"
                                                                                                       @endif
                                                                                                       class="form-control">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">تلفن
                                                                                                دفتر
                                                                                                <span
                                                                                                    style="color: red"
                                                                                                    class="required-mark">*</span>
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input maxlength="100"
                                                                                                       minlength="3"
                                                                                                       type="text"
                                                                                                       id="tel_company"
                                                                                                       name="tel_company"
                                                                                                       @if(!empty($customer_company->tel_company))
                                                                                                       value="{{$customer_company->tel_company}}"
                                                                                                       @endif
                                                                                                       class="form-control"
                                                                                                       data-error="Minimum 3 character required">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">کد
                                                                                                پستی</label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="post_company"
                                                                                                       name="post_company"
                                                                                                       @if(!empty($customer_company->post_company))
                                                                                                       value="{{$customer_company->post_company}}"
                                                                                                       @endif
                                                                                                       class="form-control"
                                                                                                       data-error="Minimum 3 character required">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>


                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-4 form-group">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">سال
                                                                                                تاسیس</label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="Established_company"
                                                                                                       name="Established_company"
                                                                                                       class="form-control"
                                                                                                >
                                                                                                @if(!empty($customer_company->Established_company))
                                                                                                    <input type="hidden"
                                                                                                           name="H_Established_companys"
                                                                                                           id="H_Established_companys"
                                                                                                           value="{{$customer_company->Established_company}}">
                                                                                                @endif
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">فکس
                                                                                                دفتر
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="fax_company"
                                                                                                       name="fax_company"
                                                                                                       @if(!empty($customer_company->fax_company))
                                                                                                       value="{{$customer_company->fax_company}}"
                                                                                                       @endif
                                                                                                       class="form-control"
                                                                                                       data-error="Minimum 3 character required">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                تلفن همراه
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="phone_company"
                                                                                                       name="phone_company"
                                                                                                       class="form-control"
                                                                                                       @if(!empty($customer_company->phone_company))
                                                                                                       value="{{$customer_company->phone_company}}"
                                                                                                       @endif
                                                                                                       data-error="Minimum 3 character required">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>


                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-4 form-group">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                تاریخ تولد
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="date_birth"
                                                                                                       name="date_birth"
                                                                                                       class="form-control"
                                                                                                >

                                                                                                @if(!empty($customer_company->date_birth))
                                                                                                    <input type="hidden"
                                                                                                           name="D_date_birth"
                                                                                                           id="D_date_birth"
                                                                                                           value="{{$customer_company->date_birth}}">
                                                                                                @endif
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                ایمیل
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="email_company"
                                                                                                       name="email_company"
                                                                                                       @if(!empty($customer_company->email_company))
                                                                                                       value="{{$customer_company->email_company}}"
                                                                                                       @endif
                                                                                                       class="form-control"
                                                                                                       data-error="Minimum 3 character required">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                کد ملی
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="national_company"
                                                                                                       name="national_company"
                                                                                                       @if(!empty($customer_company->national_company))
                                                                                                       value="{{$customer_company->national_company}}"
                                                                                                       @endif
                                                                                                       class="form-control"
                                                                                                       data-error="Minimum 3 character required">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>


                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-md-12 form-group">
                                                                                    <div class="form-group col-md-12">
                                                                                        <label
                                                                                            class="control-label col-md-2">ادرس
                                                                                            دفتر
                                                                                            مرکزی</label>
                                                                                        <div class="col-md-10">
                                                <textarea name="adders_company" id="adders_company" class="form-control"
                                                          rows="2" cols="50"
                                                          placeholder="لطفا ادرس دفتر مرکزی را وارد کنید">
 @if(!empty($customer_company->adders_company))
                                                        {{$customer_company->adders_company}}
                                                    @endif
                                                 </textarea>
                                                                                            <div
                                                                                                class="help-block with-errors"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12 form-group">
                                                                                    <div class="form-group col-md-12">
                                                                                        <label
                                                                                            class="control-label col-md-2">
                                                                                            ادرس منزل
                                                                                        </label>
                                                                                        <div class="col-md-10">
                                                <textarea name="adders_home" id="adders_home" class="form-control"
                                                          rows="2" cols="50"
                                                          placeholder="لطفا ادرس منزل را وارد کنید">
 @if(!empty($customer_company->home))
                                                        {{$customer_company->home}}
                                                    @endif
                                                 </textarea>
                                                                                            <div
                                                                                                class="help-block with-errors"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane" id="car">
                                                            <div class="col-md-12">
                                                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                                <div class="portlet box blue">
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            مشخصات محل کار
                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="col-md-4 form-group">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                نام فروشگاه
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="name_work_company"
                                                                                                       @if(!empty($customer_work->name_work_company))
                                                                                                       value="{{$customer_work->name_work_company}}"
                                                                                                       @endif
                                                                                                       name="name_work_company"
                                                                                                       class="form-control">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                سال تاسیس
                                                                                                <span
                                                                                                    style="color: red"
                                                                                                    class="required-mark">*</span>
                                                                                            </label>
                                                                                            <div class="col-md-6">


                                                                                                <input maxlength="100"
                                                                                                       minlength="3"
                                                                                                       type="text"
                                                                                                       id="date_work_company"
                                                                                                       name="date_work_company"

                                                                                                       class="form-control"
                                                                                                       data-error="Minimum 3 character required">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @if(!empty($customer_work->date_work_company))
                                                                                            <input type="hidden"
                                                                                                   name="D_date_work_company"
                                                                                                   id="D_date_work_company"
                                                                                                   value="{{$customer_work->date_work_company}}">
                                                                                        @endif

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                تلفن
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="tel_work_company"
                                                                                                       name="tel_work_company"
                                                                                                       @if(!empty($customer_work->tel_work_company))
                                                                                                       value="{{$customer_work->tel_work_company}}"
                                                                                                       @endif
                                                                                                       class="form-control"
                                                                                                       data-error="Minimum 3 character required">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                فکس
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="fax_work_company"
                                                                                                       name="fax_work_company"
                                                                                                       @if(!empty($customer_work->fax_work_company))
                                                                                                       value="{{$customer_work->fax_work_company}}"
                                                                                                       @endif
                                                                                                       class="form-control"
                                                                                                       data-error="Minimum 3 character required">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                تابلو فروشگاه
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <select
                                                                                                    name="panel_work_company"
                                                                                                    id="panel_work_company"
                                                                                                    class="form-control">
                                                                                                    <option value="1"
                                                                                                            @if(!empty($customer_work->panel_work_company) and $customer_work->panel_work_company == 1)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        دارد
                                                                                                    </option>
                                                                                                    <option value="2"
                                                                                                            @if(!empty($customer_work->panel_work_company) and
                                                                                                            $customer_work-> panel_work_company== 2)


                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        ندارد
                                                                                                    </option>
                                                                                                </select>

                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                ابعاد تابلو فروشگاه
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="dimensions_work_company"
                                                                                                       name="dimensions_work_company"
                                                                                                       @if(!empty($customer_work->dimensions_work_company))
                                                                                                       value="{{$customer_work->dimensions_work_company}}"
                                                                                                       @endif
                                                                                                       class="form-control"
                                                                                                >
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-4 form-group">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                کد پستی
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="post_work_company"
                                                                                                       @if(!empty($customer_work->post_work_company))
                                                                                                       value="{{$customer_work->post_work_company}}"
                                                                                                       @endif
                                                                                                       name="post_work_company"
                                                                                                       class="form-control"
                                                                                                >
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                نوع فعالیت
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <select
                                                                                                    name="type_work_company"
                                                                                                    id="type_work_company"
                                                                                                    class="form-control">
                                                                                                    <option value="1"
                                                                                                            @if(!empty($customer_work->type_work_company) and $customer_work->type_work_company == 1)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        خرده فروش
                                                                                                    </option>
                                                                                                    <option value="2"
                                                                                                            @if(!empty($customer_work->type_work_company) and $customer_work->type_work_company == 2)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        عمده فروش
                                                                                                    </option>
                                                                                                    <option value="3"
                                                                                                            @if(!empty($customer_work->type_work_company) and $customer_work->type_work_company == 3)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        واسطه
                                                                                                    </option>
                                                                                                </select>

                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                وضعیت فروشگاه
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <select
                                                                                                    name="status_work_company"
                                                                                                    id="status_work_company"
                                                                                                    class="form-control">
                                                                                                    <option value="1"
                                                                                                            @if(!empty($customer_work->status_work_company) and $customer_work->status_work_company == 1)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        مالک
                                                                                                    </option>
                                                                                                    <option value="2"
                                                                                                            @if(!empty($customer_work->status_work_company) and $customer_work->status_work_company == 2)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        استیجاری
                                                                                                    </option>
                                                                                                    <option value="3"
                                                                                                            @if(!empty($customer_work->status_work_company) and $customer_work->status_work_company == 3)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        سرقفلی
                                                                                                    </option>
                                                                                                </select>

                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                تلفن انبار
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="telstore_work_company"
                                                                                                       @if(!empty($customer_work->telstore_work_company))
                                                                                                       value="{{$customer_work->telstore_work_company}}"
                                                                                                       @endif
                                                                                                       name="telstore_work_company"
                                                                                                       class="form-control"
                                                                                                >
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                نوع مالکیت
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <select
                                                                                                    name="owner_work_company"
                                                                                                    id="owner_work_company"
                                                                                                    class="form-control">
                                                                                                    <option value="1"
                                                                                                            @if(!empty($customer_work->owner_work_company) and $customer_work->owner_work_company == 1)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        مالک
                                                                                                    </option>
                                                                                                    <option value="2"
                                                                                                            @if(!empty($customer_work->owner_work_company) and $customer_work->owner_work_company == 2)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        استیجاری
                                                                                                    </option>
                                                                                                    <option value="3"
                                                                                                            @if(!empty($customer_work->owner_work_company) and $customer_work->owner_work_company == 3)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        سرقفلی
                                                                                                    </option>
                                                                                                </select>

                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                مربوط به شرکت
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="dec_work_company"
                                                                                                       @if(!empty($customer_work->dec_work_company))
                                                                                                       value="{{$customer_work->dec_work_company}}"
                                                                                                       @endif
                                                                                                       name="dec_work_company"
                                                                                                       class="form-control"
                                                                                                >
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-md-4 form-group">
                                                                                    <div class="col-md-12">

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                جواز کسب
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <select
                                                                                                    name="license_work_company"
                                                                                                    id="license_work_company"
                                                                                                    class="form-control">
                                                                                                    <option value="1"
                                                                                                            @if(!empty($customer_work->license_work_company) and $customer_work->license_work_company == 1)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        دارد
                                                                                                    </option>
                                                                                                    <option value="2"
                                                                                                            @if(!empty($customer_work->license_work_company) and $customer_work->license_work_company == 2)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        ندارد
                                                                                                    </option>
                                                                                                </select>

                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                شماره جواز
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="numlicense_work_company"
                                                                                                       name="numlicense_work_company"
                                                                                                       @if(!empty($customer_work->numlicense_work_company))
                                                                                                       value="{{$customer_work->numlicense_work_company}}"
                                                                                                       @endif
                                                                                                       class="form-control"
                                                                                                >
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                اعتبار جواز
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="credibilitylicense_work_company"
                                                                                                       name="credibilitylicense_work_company"
                                                                                                       class="form-control"
                                                                                                >
                                                                                                @if(!empty($customer_work->credibilitylicense_work_company))
                                                                                                    <input type="hidden"
                                                                                                           name="C_credibilitylicense_work_company"
                                                                                                           id="C_credibilitylicense_work_company"
                                                                                                           value="{{$customer_work->credibilitylicense_work_company}}">
                                                                                                @endif
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                انبار
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <select
                                                                                                    name="store_work_company"
                                                                                                    id="store_work_company"
                                                                                                    class="form-control">
                                                                                                    <option value="1"
                                                                                                            @if(!empty($customer_work->store_work_company) and $customer_work->store_work_company == 1)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        دارد
                                                                                                    </option>
                                                                                                    <option value="2"

                                                                                                            @if(!empty($customer_work->store_work_company) and $customer_work->store_work_company == 2)
                                                                                                            selected
                                                                                                        @endif
                                                                                                    >
                                                                                                        ندارد
                                                                                                    </option>
                                                                                                </select>

                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label col-md-6">
                                                                                                ابعاد انبار
                                                                                            </label>
                                                                                            <div class="col-md-6">
                                                                                                <input type="text"
                                                                                                       id="dimensionsstore_work_company"
                                                                                                       name="dimensionsstore_work_company"
                                                                                                       @if(!empty($customer_work->dimensionsstore_work_company))
                                                                                                       value="{{$customer_work->dimensionsstore_work_company}}"
                                                                                                       @endif
                                                                                                       class="form-control"
                                                                                                >
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>


                                                                                <div class="col-md-12 form-group">
                                                                                    <div class="form-group col-md-12">
                                                                                        <label
                                                                                            class="control-label col-md-2">
                                                                                            ادرس محل فعالیت
                                                                                        </label>
                                                                                        <div class="col-md-10">
                                                <textarea name="activity_work_company" id="activity_work_company"
                                                          class="form-control"
                                                          rows="2" cols="50"
                                                          placeholder="لطفا ادرس محل فعالیت را وارد کنید">
 @if(!empty($customer_work->activity_work_company))
                                                        {{$customer_work->activity_work_company}}
                                                    @endif
                                                 </textarea>
                                                                                            <div
                                                                                                class="help-block with-errors"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12 form-group">
                                                                                    <div class="form-group col-md-12">
                                                                                        <label
                                                                                            class="control-label col-md-2">
                                                                                            سایر فعالیت ها
                                                                                        </label>
                                                                                        <div class="col-md-10">
                                                <textarea name="oactivity_work_company" id="oactivity_work_company"
                                                          class="form-control"
                                                          rows="2" cols="50"
                                                          placeholder="لطفا سایر فعالیت ها را وارد کنید">
 @if(!empty($customer_work->oactivity_work_company))
                                                        {{$customer_work->oactivity_work_company}}
                                                    @endif
                                                 </textarea>
                                                                                            <div
                                                                                                class="help-block with-errors"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12 form-group">
                                                                                    <div class="form-group col-md-12">
                                                                                        <label
                                                                                            class="control-label col-md-2">
                                                                                            ادرس انبار
                                                                                        </label>
                                                                                        <div class="col-md-10">
                                                <textarea name="addersstore_work_company" id="addersstore_work_company"
                                                          class="form-control"
                                                          rows="2" cols="50"
                                                          placeholder="لطفا ادرس انبار را وارد کنید">
  @if(!empty($customer_work->addersstore_work_company))
                                                        {{$customer_work->addersstore_work_company}}
                                                    @endif
                                                 </textarea>
                                                                                            <div
                                                                                                class="help-block with-errors"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane" id="bank">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                                        <div class="portlet box blue">
                                                                            <div class="portlet-title">
                                                                                <div class="caption">
                                                                                    وضعیت بانکی و اعتباری
                                                                                </div>
                                                                            </div>
                                                                            <div class="portlet-body">


                                                                                <div class="table table-responsive">
                                                                                    <table
                                                                                        class="table table-responsive table-striped table-bordered">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <td>نام بانک</td>
                                                                                            <td>شعبه</td>
                                                                                            <td>شماره حساب جاری</td>
                                                                                            <td>تاریخ افتتاح حساب</td>
                                                                                            <td>عملیات</td>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody
                                                                                            id="TextBoxContainerbank">
                                                                                        <tr>
                                                                                            <td id="namee"></td>
                                                                                            <td id="shobee"></td>
                                                                                            <td id="shomaree"></td>
                                                                                            <td id="tarikhh"></td>
                                                                                            <td id="actiont"></td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                        <tfoot>
                                                                                        <tr>
                                                                                            <th colspan="1">
                                                                                                <button id="btnAddbank"
                                                                                                        type="button"
                                                                                                        onclick="addInput10()"
                                                                                                        class="btn btn-primary"
                                                                                                        data-toggle="tooltip">
                                                                                                    <i class="fa fa-plus"></i>
                                                                                                </button>
                                                                                            </th>
                                                                                        </tr>
                                                                                        </tfoot>
                                                                                    </table>

                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="tab-pane" id="tamin">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                                        <div class="portlet box blue">
                                                                            <div class="portlet-title">
                                                                                <div class="caption">
                                                                                    اسامی تامیین کنندگان
                                                                                </div>
                                                                            </div>
                                                                            <div class="portlet-body">


                                                                                <div class="table table-responsive">
                                                                                    <table
                                                                                        class="table table-responsive table-striped table-bordered">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <td>نام شرکت/شخص</td>
                                                                                            <td>تاریخ شروع همکاری</td>
                                                                                            <td>عملیات</td>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody
                                                                                            id="TextBoxContainerbankk">
                                                                                        <tr>
                                                                                            <td id="nameee"></td>
                                                                                            <td id="shobeee"></td>
                                                                                            <td id="actiontt"></td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                        <tfoot>
                                                                                        <tr>
                                                                                            <th colspan="1">
                                                                                                <button id="btnAddbank"
                                                                                                        type="button"
                                                                                                        onclick="addInput11()"
                                                                                                        class="btn btn-primary"
                                                                                                        data-toggle="tooltip">
                                                                                                    <i class="fa fa-plus"></i>
                                                                                                </button>
                                                                                            </th>
                                                                                        </tr>
                                                                                        </tfoot>
                                                                                    </table>

                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="tab-pane" id="madark">
                                                            <div class="col-md-12">
                                                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                                <div class="portlet box blue">
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            مدارک
                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="col-md-4 form-group">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                class="control-label">
                                                                                                شناسنامه
                                                                                            </label>
                                                                                            @if(!empty($customer_document->certificate_documents_company))
                                                                                                <li style="color: green"
                                                                                                    class="fa fa-check"
                                                                                                    id="check_certificate_documents_company"></li>
                                                                                                <a target="_blank"
                                                                                                   id="view_certificate_documents_company"
                                                                                                   href="{{url($customer_document->certificate_documents_company)}}"><span>مشاهده فایل</span></a>
                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                <a href="javascript:void(0)"
                                                                                                   id="delete_certificate_documents_company"><span>حذف فایل</span></a>
                                                                                                <li style="color: red;visibility: hidden"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_certificate_documents_company"></li>
                                                                                            @else
                                                                                                <li style="color: red"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_certificate_documents_company"></li>
                                                                                            @endif

                                                                                            <div class="col-md-12">
                                                                                                <input type="file"
                                                                                                       id="certificate_documents_company"
                                                                                                       name="certificate_documents_company"
                                                                                                       class="form-control"
                                                                                                       value="Send Request"
                                                                                                >
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <label
                                                                                                class="control-label">
                                                                                                کارت ملی
                                                                                            </label>
                                                                                            @if(!empty($customer_document->cart_documents_company))
                                                                                                <li style="color: green"
                                                                                                    class="fa fa-check"
                                                                                                    id="check_cart_documents_company"></li>
                                                                                                <a target="_blank"
                                                                                                   id="view_cart_documents_company"
                                                                                                   href="{{url($customer_document->cart_documents_company)}}"><span>مشاهده فایل</span></a>
                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                <a href="javascript:void(0)"
                                                                                                   id="delete_cart_documents_company"><span>حذف فایل</span></a>
                                                                                                <li style="color: red;visibility: hidden"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_cart_documents_company"></li>
                                                                                            @else
                                                                                                <li style="color: red"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_cart_documents_company"></li>
                                                                                            @endif
                                                                                            <div class="col-md-12">
                                                                                                <input type="file"
                                                                                                       id="cart_documents_company"
                                                                                                       name="cart_documents_company"
                                                                                                       class="form-control">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <label
                                                                                                class="control-label">
                                                                                                محل فعالیت
                                                                                            </label>
                                                                                            @if(!empty($customer_document->activity_documents_company))
                                                                                                <li style="color: green"
                                                                                                    class="fa fa-check"
                                                                                                    id="check_activity_documents_company"></li>
                                                                                                <a target="_blank"
                                                                                                   id="view_activity_documents_company"
                                                                                                   href="{{url($customer_document->activity_documents_company)}}"><span>مشاهده فایل</span></a>
                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                <a href="javascript:void(0)"
                                                                                                   id="delete_activity_documents_company"><span>حذف فایل</span></a>
                                                                                                <li style="color: red;visibility: hidden"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_activity_documents_company"></li>
                                                                                            @else
                                                                                                <li style="color: red"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_activity_documents_company"></li>
                                                                                            @endif
                                                                                            <div class="col-md-12">
                                                                                                <input type="file"
                                                                                                       id="activity_documents_company"
                                                                                                       name="activity_documents_company"
                                                                                                       class="form-control">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-4 form-group">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group ">
                                                                                            <label
                                                                                                class="control-label">
                                                                                                مالکیت فروشگاه
                                                                                            </label>
                                                                                            @if(!empty($customer_document->store_documents_company))
                                                                                                <li style="color: green"
                                                                                                    class="fa fa-check"
                                                                                                    id="check_store_documents_company"></li>
                                                                                                <a target="_blank"
                                                                                                   id="view_store_documents_company"
                                                                                                   href="{{url($customer_document->store_documents_company)}}"><span>مشاهده فایل</span></a>
                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                <a href="javascript:void(0)"
                                                                                                   id="delete_store_documents_company"><span>حذف فایل</span></a>
                                                                                                <li style="color: red;visibility: hidden"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_store_documents_company"></li>
                                                                                            @else
                                                                                                <li style="color: red"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_store_documents_company"></li>
                                                                                            @endif
                                                                                            <div class="col-md-12">
                                                                                                <input type="file"
                                                                                                       id="store_documents_company"
                                                                                                       name="store_documents_company"
                                                                                                       class="form-control">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group ">
                                                                                            <label
                                                                                                class="control-label">
                                                                                                مالکیت انبار
                                                                                            </label>
                                                                                            @if(!empty($customer_document->ownership_documents_company))
                                                                                                <li style="color: green"
                                                                                                    class="fa fa-check"
                                                                                                    id="check_ownership_documents_company"></li>
                                                                                                <a target="_blank"
                                                                                                   id="view_ownership_documents_company"
                                                                                                   href="{{url($customer_document->ownership_documents_company)}}"><span>مشاهده فایل</span></a>
                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                <a href="javascript:void(0)"
                                                                                                   id="delete_ownership_documents_company"><span>حذف فایل</span></a>
                                                                                                <li style="color: red;visibility: hidden"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_ownership_documents_company"></li>
                                                                                            @else
                                                                                                <li style="color: red"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_ownership_documents_company"></li>
                                                                                            @endif
                                                                                            <div class="col-md-12">
                                                                                                <input type="file"
                                                                                                       id="ownership_documents_company"
                                                                                                       name="ownership_documents_company"
                                                                                                       class="form-control">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group ">
                                                                                            <label
                                                                                                class="control-label">
                                                                                                تاسیس و بهره برداری
                                                                                            </label>
                                                                                            @if(!empty($customer_document->established_documents_company))
                                                                                                <li style="color: green"
                                                                                                    class="fa fa-check"
                                                                                                    id="check_established_documents_company"></li>
                                                                                                <a target="_blank"
                                                                                                   id="view_established_documents_company"
                                                                                                   href="{{url($customer_document->established_documents_company)}}"><span>مشاهده فایل</span></a>
                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                <a href="javascript:void(0)"
                                                                                                   id="delete_established_documents_company"><span>حذف فایل</span></a>
                                                                                                <li style="color: red;visibility: hidden"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_established_documents_company"></li>
                                                                                            @else
                                                                                                <li style="color: red"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_established_documents_company"></li>
                                                                                            @endif
                                                                                            <div class="col-md-12">
                                                                                                <input type="file"
                                                                                                       id="established_documents_company"
                                                                                                       name="established_documents_company"
                                                                                                       class="form-control">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>


                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-4 form-group">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group ">
                                                                                            <label
                                                                                                class="control-label">
                                                                                                عکس فروشگاه
                                                                                            </label>
                                                                                            @if(!empty($customer_document->sstore_documents_company))
                                                                                                <li style="color: green"
                                                                                                    class="fa fa-check"
                                                                                                    id="check_sstore_documents_company"></li>
                                                                                                <a target="_blank"
                                                                                                   id="view_sstore_documents_company"
                                                                                                   href="{{url($customer_document->sstore_documents_company)}}"><span>مشاهده فایل</span></a>
                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                <a href="javascript:void(0)"
                                                                                                   id="delete_sstore_documents_company"><span>حذف فایل</span></a>
                                                                                                <li style="color: red;visibility: hidden"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_sstore_documents_company"></li>
                                                                                            @else
                                                                                                <li style="color: red"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_sstore_documents_company"></li>
                                                                                            @endif
                                                                                            <div class="col-md-12">
                                                                                                <input type="file"
                                                                                                       id="sstore_documents_company"
                                                                                                       name="sstore_documents_company"
                                                                                                       class="form-control">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <label
                                                                                                class="control-label">
                                                                                                عکس انبار
                                                                                            </label>
                                                                                            @if(!empty($customer_document->pstore_documents_company))
                                                                                                <li style="color: green"
                                                                                                    class="fa fa-check"
                                                                                                    id="check_pstore_documents_company"></li>
                                                                                                <a target="_blank"
                                                                                                   id="view_pstore_documents_company"
                                                                                                   href="{{url($customer_document->pstore_documents_company)}}"><span>مشاهده فایل</span></a>
                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                <a href="javascript:void(0)"
                                                                                                   id="delete_pstore_documents_company"><span>حذف فایل</span></a>
                                                                                                <li style="color: red;visibility: hidden"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_pstore_documents_company"></li>
                                                                                            @else
                                                                                                <li style="color: red"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_pstore_documents_company"></li>
                                                                                            @endif
                                                                                            <div class="col-md-12">
                                                                                                <input type="file"
                                                                                                       id="pstore_documents_company"
                                                                                                       name="pstore_documents_company"
                                                                                                       class="form-control">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <label
                                                                                                class="control-label">
                                                                                                استعلام
                                                                                            </label>
                                                                                            @if(!empty($customer_document->final_documents_company))
                                                                                                <li style="color: green"
                                                                                                    class="fa fa-check"
                                                                                                    id="check_final_documents_company"></li>
                                                                                                <a target="_blank"
                                                                                                   id="view_final_documents_company"
                                                                                                   href="{{url($customer_document->final_documents_company)}}"><span>مشاهده فایل</span></a>
                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                <a href="javascript:void(0)"
                                                                                                   id="delete_final_documents_company"><span>حذف فایل</span></a>
                                                                                                <li style="color: red;visibility: hidden"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_final_documents_company"></li>
                                                                                            @else
                                                                                                <li style="color: red"
                                                                                                    class="fa fa-remove"
                                                                                                    id="uncheck_final_documents_company"></li>
                                                                                            @endif
                                                                                            <div class="col-md-12">
                                                                                                <input type="file"
                                                                                                       id="final_documents_company"
                                                                                                       name="final_documents_company"
                                                                                                       class="form-control">
                                                                                                <div
                                                                                                    class="help-block with-errors"></div>
                                                                                            </div>
                                                                                        </div>


                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane" id="psh">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                                        <div class="portlet box blue">
                                                                            <div class="portlet-title">
                                                                                <div class="caption">
                                                                                    مشخصات پرسنل های شرکت
                                                                                </div>
                                                                            </div>
                                                                            <div class="portlet-body">


                                                                                <div class="table table-responsive">
                                                                                    <table
                                                                                        class="table table-responsive table-striped table-bordered">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <td>سمت</td>
                                                                                            <td>جنسیت</td>
                                                                                            <td>عنوان</td>
                                                                                            <td>نام</td>
                                                                                            <td>تلفن</td>
                                                                                            <td>داخلی</td>
                                                                                            <td>تلفن همراه</td>
                                                                                            <td>ایمیل</td>
                                                                                            <td>عملیات</td>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody
                                                                                            id="TextBoxContainerbankkk">
                                                                                        <tr>
                                                                                            <td id="per_side"></td>
                                                                                            <td id="per_sex"></td>
                                                                                            <td id="per_title"></td>
                                                                                            <td id="per_name"></td>
                                                                                            <td id="per_phone"></td>
                                                                                            <td id="per_inside"></td>
                                                                                            <td id="per_email"></td>
                                                                                            <td id="per_tel"></td>
                                                                                            <td id="actionttt"></td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                        <tfoot>
                                                                                        <tr>
                                                                                            <th colspan="1">
                                                                                                <button id="btnAddbank"
                                                                                                        type="button"
                                                                                                        onclick="addInput12()"
                                                                                                        class="btn btn-primary"
                                                                                                        data-toggle="tooltip">
                                                                                                    <i class="fa fa-plus"></i>
                                                                                                </button>
                                                                                            </th>
                                                                                        </tr>
                                                                                        </tfoot>
                                                                                    </table>

                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>


                                        </div>
                                        <div class="pull-left">
                                            <button style="width: 130px" type="submit" class="btn btn-success"
                                                    id="saveBtn" value="ثبت">
                                                ثبت
                                            </button>
                                            &nbsp;&nbsp;
                                            <a href="{{route('admin.customers.index')}}" style="width: 130px"
                                               type="submit" class="btn btn-danger">
                                                برگشت
                                            </a>
                                        </div>
                                    </div>

                                </div>

                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        $('#customer').addClass('active');

    </script>

@endsection
