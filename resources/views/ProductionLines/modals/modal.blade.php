<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                    </div>
                    <div class="caption pull-left">
                        <a data-dismiss="modal">
                            <i style="color: white" class="pull-left fa fa-closee"></i>
                        </a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="form-group">

                            <form autocomplete="off" id="productForm" name="productForm" class="form-horizontal">
                                <input type="hidden" name="id" id="id">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <label>نام صاحب حساب
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="لطفا نام صاحب حساب را وارد کنید"
                                               required>
                                    </div>

                                    <div class="col-md-12">
                                        <label>نام بانک
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="NameBank" name="NameBank" class="form-control"
                                               placeholder="لطفا نام بانک را وارد کنید"
                                               required>
                                    </div>

                                    <div class="col-md-12">
                                        <label>شماره کارت
                                        </label>
                                        <input type="text" id="CardNumber" name="CardNumber"
                                               class="form-control"
                                               placeholder="لطفا شماره کارت را وارد کنید"
                                               required>
                                    </div>

                                    <div class="col-md-12">

                                        <label>شماره حساب
                                        </label>
                                        <input type="text" id="AccountNumber" name="AccountNumber"
                                               class="form-control"
                                               placeholder="لطفا شمار حساب را وارد کنید"
                                               required>

                                    </div>

                                    <div class="col-md-12">

                                        <label>شماره شبا
                                        </label>
                                        <input type="text" id="ShabaNumber" name="ShabaNumber"
                                               class="form-control"
                                               placeholder="لطفا شماره شبا را وارد کنید"
                                               required>

                                    </div>

                                    <div class="col-md-12">
                                        <label>وضعیت حساب
                                        </label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">فعال</option>
                                            <option value="2"> غیر فعال</option>
                                        </select>
                                    </div>

                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">

                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtn" value="ثبت">
                                            ثبت
                                        </button>

                                        <button style="width: 130px" type="button" class="btn btn-danger"
                                                data-dismiss="modal">
                                            انصراف
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="ajaxModel_device" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="cappattioon">
                        وضعیت دستگاه
                    </div>
                    <div class="caption pull-left">
                        <a data-dismiss="modal">
                            <i style="color: white" class="pull-left fa fa-closee"></i>
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="form-group">

                            <form autocomplete="off" id="productForm" name="productForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs" style="background-color: white">
                                                <li style="background-color: #e6e6e6" class="active"><a href="#a"
                                                                                                        data-toggle="tab">
                                                        برنامه های تولیدی</a></li>
                                                <li style="background-color: #e6e6e6"><a href="#b" data-toggle="tab">
                                                        توقفات</a></li>
                                                <li style="background-color: #e6e6e6"><a href="#c" data-toggle="tab">درخواست
                                                        ها</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">

                                                <div class="active tab-pane" id="a">
                                                    <br/>
                                                    <table class="table table-striped table-bordered information_datee"
                                                           id="information_datee">

                                                        <thead style="background-color: #e6e6e6">
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>کد فروش</th>
                                                            <th>محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد سفارش</th>
                                                            <th>تعداد تولید سالم</th>
                                                            <th>تعداد باقی مانده</th>
                                                            <th>وضعیت QC</th>
                                                            <th>وضعیت</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>

                                                    </table>

                                                </div>

                                                <div class="tab-pane" id="b">
                                                    <br/>
                                                    <table class="table table-striped table-bordered stop_datee"
                                                           id="stop_datee">
                                                        <thead style="background-color: #e6e6e6">
                                                        <tr>
                                                            <th style="width: 1%;text-align: center">ردیف</th>
                                                            <th>تاریخ ثبت</th>
                                                            <th>ثبت کننده</th>
                                                            <th>تاریخ شروع</th>
                                                            <th>تاریخ پایان</th>
                                                            <th>مدت توقف</th>
                                                            <th>قالب نصب شده</th>
                                                            <th>دلیل توقف</th>
                                                            <th>توضیحات</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                    <div class="text-left">
                                                        <a class="btn btn-danger" href="javascript:void(0)"
                                                           id="createstop">ثبت توقف جدید</a>

                                                    </div>


                                                </div>

                                                <div class="tab-pane" id="c">
                                                    <br/>
                                                    <table class="table table-striped table-bordered kharid"
                                                           id="kharid">
                                                        <thead style="background-color: #e6e6e6">
                                                        <tr>
                                                            <th style="width: 1%">ردیف</th>
                                                            <th>تاریخ</th>
                                                            <th>فاکتور</th>
                                                            <th>مبلغ(ریال)</th>
                                                            <th>نحوه پرداخت</th>
                                                            <th>وضعیت پرداخت</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>

                                                        <tfoot align="right">
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>


                                                        </tfoot>
                                                    </table>

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <hr/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxStore_information" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        ثبت اطلاعات تولید
                    </div>
                    <div class="caption pull-left">
                        <a data-dismiss="modal">
                            <i style="color: white" class="pull-left fa fa-closee"></i>
                        </a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="form-group">

                            <form autocomplete="off" id="productFor" name="productFor">
                                <input type="hidden" id="id_id" name="id_id">
                                @csrf
                                <div class="row">

                                    <div class="col-md-3">

                                    </div>

                                    <div class="col-md-3">
                                        <label>تاریخ
                                        </label>
                                        <input type="text" id="dateu" name="date" class="form-control"
                                               required>
                                    </div>

                                    <div class="col-md-3">
                                        <label>انتخاب شیفت
                                        </label>
                                        <select class="form-control" name="shift" id="shift">
                                            <option value="1">روز</option>
                                            <option value="2">شب</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <br/>
                                        <br/>
                                        <div class="table table-responsive">
                                            <table
                                                class="table table-responsive table-striped table-bordered">
                                                <thead style="background-color: #e6e6e6">
                                                <tr style="background-color: #e6e6e6">
                                                    <td>محصول تولیدی</td>
                                                    <td>تعداد کل سفارش</td>
                                                    <td>تعداد تولید شده قبل</td>
                                                    <td>تعداد تولید سالم</td>
                                                    <td>تعداد تولید D2</td>
                                                    <td>تعداد تولید ضایعات</td>
                                                    <td>سایکل تایم</td>
                                                </tr>
                                                </thead>
                                                <tbody
                                                    id="TextBoxContainer">

                                                <tr>
                                                    <td id="products"></td>
                                                    <td id="totalnumber"></td>
                                                    <td id="numberproduced"></td>
                                                    <td id="hnumber"></td>
                                                    <td id="gnumber"></td>
                                                    <td id="wnumber"></td>
                                                    <td id="stime"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered information_datee_list"
                                               id="information_datee_list">

                                            <thead style="background-color: #e6e6e6">
                                            <tr>
                                                <th>ردیف</th>
                                                <th>ثبت کننده</th>
                                                <th>تاریخ</th>
                                                <th>شیفت</th>
                                                <th>تعداد سالم</th>
                                                <th>تعداد درجه 2</th>
                                                <th>تعداد ضایعات</th>
                                                <th>عملیات</th>
                                            </tr>
                                            </thead>

                                        </table>

                                    </div>

                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">

                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtnstore" value="ثبت">
                                            ثبت
                                        </button>

                                        <button style="width: 130px" type="button" class="btn btn-danger"
                                                data-dismiss="modal">
                                            انصراف
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="ajaxModelStop" aria-hidden="true">
    <?php
    $formats = \App\Format::all();
    ?>
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        ثبت توقف جدید
                    </div>
                    <div class="caption pull-left">
                        <a data-dismiss="modal">
                            <i style="color: white" class="pull-left fa fa-closee"></i>
                        </a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="form-group">

                            <form autocomplete="off" id="productForsam" name="productForsam" class="form-horizontal">
                                <input type="hidden" name="id_device" id="id_device">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <label>تاریخ شروع
                                        </label>
                                        <input type="text" id="inda" name="indate" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>ساعت شروع
                                        </label>
                                        <input type="text" id="inti" name="intime" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>تاریخ پایان
                                        </label>
                                        <input type="text" id="toda" name="todate" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>ساعت پایان
                                        </label>
                                        <input type="text" id="toti" name="totime" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>نوع توقف
                                        </label>
                                        <select class="form-control" name="typestop" id="typestop">
                                            <option>انتخاب کنید...</option>
                                            <option value="1">فروش</option>
                                            <option value="2">فنی</option>
                                            <option value="3">غیر فنی</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>دلیل توقف
                                        </label>
                                        <select class="form-control" name="desstop" id="desstop">
                                            <option>اتخاب کنید...</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label>قالب نصب شده
                                        </label>
                                        <select class="form-control" name="format_id" id="format_id">
                                            @foreach($formats as $format)
                                                <option value="{{$format->id}}">{{$format->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label>توضیحات</label>
                                        <textarea name="description" id="description" class="form-control"
                                                  rows="2" cols="50">

                                                </textarea>


                                    </div>


                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">

                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtnstop" value="ثبت">
                                            ثبت
                                        </button>

                                        <button style="width: 130px" type="button" class="btn btn-danger"
                                                data-dismiss="modal">
                                            انصراف
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="ajaxpishtolid" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption_pish">
                        ثبت پیش تولید برای برنامه
                    </div>
                    <div class="caption pull-left">
                        <a data-dismiss="modal">
                            <i style="color: white" class="pull-left fa fa-closee"></i>
                        </a>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="form-group">

                            <form autocomplete="off" id="productFormpish" name="productFormpish"
                                  class="form-horizontal">

                                <input type="hidden" name="id_pishtolid" id="id_pishtolid">

                                @csrf

                                <div class="row">

                                    <div class="col-md-3">

                                        <label>مقدار پیش تولید

                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>

                                        <input type="number" id="number_pish" name="number_pish" class="form-control"
                                               required>
                                    </div>

                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered pish_date"
                                               id="pish_date">

                                            <thead style="background-color: #e6e6e6">
                                            <tr>
                                                <th>ردیف</th>
                                                <th>مقدار</th>
                                                <th>تاریخ</th>
                                                <th>ثبت کننده</th>
                                                <th>نظر QC</th>
                                                <th>عملیات</th>
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>

                                </div>

                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">

                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtntolid" value="ثبت">
                                            ثبت
                                        </button>

                                        <button style="width: 130px" type="button" class="btn btn-danger"
                                                data-dismiss="modal">
                                            انصراف
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
