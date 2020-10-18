<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                    </div>
                    <div class="caption pull-left">
                        <a data-dismiss="modal">
                            <i style="color: white" class="pull-left fa fa-close"></i>
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


<div class="modal fade" id="ajaxModellistr" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        جزییات تولید
                    </div>
                    <div class="caption pull-left">
                        <a data-dismiss="modal">
                            <i style="color: white" class="pull-left fa fa-close"></i>
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
                                            <ul class="nav nav-tabs" style="background-color: rgba(0,105,255,0.07)">
                                                <li class="active" style="width: 24%;"><a href="#t" data-toggle="tab">تعداد
                                                        تولید</a></li>
                                                <li style="width: 24%;"><a href="#f" data-toggle="tab">تعداد فروش</a>
                                                </li>
                                                <li style="width: 25%;"><a href="#m" data-toggle="tab">تعداد مرجوعی</a>
                                                </li>
                                                <li style="width: 24%;"><a href="#n" data-toggle="tab">اسناد دریافتی</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="t">
                                                    <table class="table table-striped table-bordered factttor"
                                                           id="factttor">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <td>ردیف</td>
                                                            <td>محصول</td>
                                                            <td>رنگ</td>
                                                            <td>تعداد</td>
                                                            <td>تاریخ</td>
                                                            <td>ساعت</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                    <br/>
                                                    <hr/>
                                                    <div class="modal-footer">
                                                        <div class="text-left">
                                                            <button style="width: 130px" type="button"
                                                                    class="btn btn-danger"
                                                                    data-dismiss="modal">
                                                                بستن
                                                            </button>

                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="tab-pane" id="f">
                                                    <table class="table table-striped table-bordered fro" id="fro">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <td>ردیف</td>
                                                            <td>فاکتور</td>
                                                            <td>فروشنده</td>
                                                            <td>خریدار</td>
                                                            <td>تعداد</td>
                                                            <td>قیمت</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <hr/>
                                                    <div class="modal-footer">
                                                        <div class="text-left">
                                                            <button style="width: 130px" type="button"
                                                                    class="btn btn-danger"
                                                                    data-dismiss="modal">
                                                                بستن
                                                            </button>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="m">
                                                    <table class="table table-striped table-bordered mar"
                                                           id="mar">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <td>ردیف</td>
                                                            <td>فروشنده</td>
                                                            <td>خریدار</td>
                                                            <td>فاکتور</td>
                                                            <td>تعداد مرجوعی</td>
                                                            <td>توضیحات</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                    <br/>
                                                    <hr/>
                                                    <div class="modal-footer">
                                                        <div class="text-left">
                                                            <button style="width: 130px" type="button"
                                                                    class="btn btn-danger"
                                                                    data-dismiss="modal">
                                                                بستن
                                                            </button>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="tab-pane" id="n">
                                                    <table class="table table-striped table-bordered asnad"
                                                           id="asnad">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <td>ردیف</td>
                                                            <td>خریدار</td>
                                                            <td>بابت</td>
                                                            <td>نوع پرداخت</td>
                                                            <td>شناسه</td>
                                                            <td>مبلغ(ریال)</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                    <br/>
                                                    <hr/>
                                                    <div class="modal-footer">
                                                        <div class="text-left">
                                                            <button style="width: 130px" type="button"
                                                                    class="btn btn-danger"
                                                                    data-dismiss="modal">
                                                                بستن
                                                            </button>

                                                        </div>
                                                    </div>

                                                </div>

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

    </div>
</div>
