<div class="modal fade" id="Delete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        لغو پیش فاکتور
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

                            <form autocomplete="off" id="Customer_Canceled" name="Customer_Canceled"
                                  class="form-horizontal">
                                <input type="hidden" name="id_delete" id="id_delete">
                                @csrf
                                <div class="row">


                                    <div class="col-md-12">

                                        <label>دلیل لغو
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" name="cancellation" id="cancellation">
                                            <option value="1">ثبت فروش تکراری</option>
                                            <option value="2">بالا بودن قیمت</option>
                                            <option value="3">تغییر در سفارش</option>
                                            <option value="4">عدم پرداخت بدهی قبلی</option>
                                            <option value="5">کم بودن سقف اعتباری</option>
                                            <option value="6">مشکل تولید</option>
                                            <option value="7">عدم تایید نمونه ارسال شده</option>
                                            <option value="8">تعطیل شده</option>
                                            <option value="9">بد حساب</option>
                                            <option value="10">زمان تحویل طولانی</option>
                                            <option value="11">ضایعات زیاد تولید</option>
                                            <option value="12">عدم توانایی پرداخت فاکتور</option>
                                            <option value="13">گذشت مدت زمان طولانی از زمان ثبت فاکتور</option>
                                            <option value="14">بالا رفتن قیمت مواد</option>
                                            <option value="15">عدم تحویل بار مشتری</option>
                                            <option value="16">سایر</option>


                                        </select>

                                    </div>


                                    <div class="col-md-12">

                                        <label>بازگردانی به بخش:
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" name="step" id="step">
                                            <option value="1">فروش</option>
                                            <option value="2">مالی</option>
                                            <option value="3">پیش فاکتورهای تایید نشده</option>
                                        </select>

                                    </div>


                                    <div class="col-md-12">

                                        <label>توضیحات
                                        </label>
                                        <textarea name="description" id="description_c" rows="5"
                                                  class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>

                                    </div>


                                </div>
                                <br/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveCancel" value="ثبت">
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

<div class="modal fade" id="Success" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        تایید پیش فاکتور
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="form-group">

                            <form autocomplete="off" id="CustomerSuccess" name="CustomerSuccess"
                                  class="form-horizontal">
                                <input type="hidden" name="id_invoice" id="id_invoice">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>توضیحات
                                            </label>
                                            <textarea name="description" id="description_invoice" rows="5"
                                                      class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>
                                        </div>
                                    </div>


                                </div>
                                <br/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveSuccess" value="ثبت">
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
                        جزییات فاکتور
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
                                        <table class="table table-striped table-bordered factor" id="factor">
                                            <thead style="background-color: #e8ecff">
                                            <tr>
                                                <td style="width: 1px">شماره فاکتور</td>
                                                <td>فروشنده</td>
                                                <td>خریدار</td>
                                                <td>محصول</td>
                                                <td>رنگ</td>
                                                <td>تعداد</td>
                                                <td>تاریخ</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                    </div>


                                </div>
                                <br/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="button" class="btn btn-danger"
                                                data-dismiss="modal">
                                            بستن
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

<div class="modal fade" id="ajaxModellistre" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        جزییات صورت حساب
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
                                        <table class="table table-striped table-bordered factooooor" id="factooooor">
                                            <thead style="background-color: #e8ecff">
                                            <tr>
                                                <td style="width: 1px">شماره فاکتور</td>
                                                <td>فروشنده</td>
                                                <td>خریدار</td>
                                                <td>محصول</td>
                                                <td>رنگ</td>
                                                <td>تعداد</td>
                                                <td>تاریخ</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                    </div>



                                </div>
                                <br/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="button" class="btn btn-danger"
                                                data-dismiss="modal">
                                            بستن
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
