<div class="modal fade" id="successModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        ارسال سفارش به صف برنامه ریزی
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

                            <form autocomplete="off" id="successinvoices" name="successinvoices"
                                  class="form-horizontal">
                                <input type="hidden" name="id_success" id="id_success">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>زمان تحویل مورد نیاز
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="date" name="date" class="form-control example1"
                                               required>

                                    </div>
                                    <div class="col-md-12">
                                        <label>شرایط مورد نیاز تولید
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" name="Productionconditions"
                                                id="Productionconditions">
                                            <option value="1">تولید</option>
                                        </select>

                                    </div>

                                    <div class="col-md-12">
                                        <label>حساسیت مشتری
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" name="Priority" id="Priority">
                                            <option value="1">حساس</option>
                                            <option value="2">عادی</option>
                                        </select>

                                    </div>
                                    <div class="col-md-12">
                                        <label>سابقه تولید
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" name="history" id="history">
                                            <option value="1">دارد</option>
                                            <option value="2">ندارد</option>
                                        </select>

                                    </div>
                                    <div class="col-md-12">
                                        <label>نمونه تایید شده
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" name="Sample" id="Sample">
                                            <option value="1">دارد</option>
                                            <option value="2">ندارد</option>
                                        </select>

                                    </div>


                                    <div class="col-md-12">

                                        <label>توضیحات
                                        </label>
                                        <textarea name="description" id="description" rows="5"
                                                  class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>

                                    </div>


                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveToList" value="ثبت">
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

<div class="modal fade" id="Confirmpayment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        تاییده پرداخت مشتری
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

                            <form autocomplete="off" id="PaymentConfirm" name="PaymentConfirm"
                                  enctype="multipart/form-data"
                                  method="post">
                                <input type="hidden" name="invoice_id_payment" id="invoice_id_payment">
                                @csrf
                                <div class="row">


                                    <div class="col-md-12">

                                        <label>شماره حواله
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="number" name="number" class="form-control"
                                               placeholder="لطفا شماره حواله را وارد کنید"
                                               required>

                                    </div>

                                    <div class="col-md-12">

                                        <label>فایل پیوست
                                        </label>
                                        <input type="file" id="file" name="file" class="form-control"
                                               placeholder="لطفا نام تایید کننده را وارد کنید"
                                        >

                                    </div>

                                    <div class="col-md-12">

                                        <label>توضیحات
                                        </label>
                                        <textarea name="description" id="description" rows="5"
                                                  class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>

                                    </div>


                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="savePaymentConfirm" value="ثبت">
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

<div class="modal fade" id="ajaxModelDelete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
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

                            <form autocomplete="off" id="CustomerCanceled" name="CustomerCanceled"
                                  class="form-horizontal">
                                <input type="hidden" name="id_delete" id="id_delete">
                                @csrf
                                <div class="row">


                                    <div class="col-md-12">
                                        <div class="form-group">
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
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>توضیحات
                                            </label>
                                            <textarea name="description" id="description_c" rows="5"
                                                      class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>
                                        </div>
                                    </div>


                                </div>
                                <br/>
                                <hr/>
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

<div class="modal fade" id="successdetailModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        ارسال سفارش به صف برنامه ریزی
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

                            <form autocomplete="off" id="successdetailinvoices" name="successdetailinvoices"
                                  class="form-horizontal">
                                <input type="hidden" name="invoice_product" id="invoice_product">
                                @csrf
                                <div id="alertdetail" style="display: none" class="alert alert-danger" role="alert">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>زمان تحویل مورد نیاز
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="date" name="date" class="form-control example1"
                                               required>

                                    </div>
                                    {{--                                    <div class="col-md-12">--}}
                                    {{--                                        <label>شرایط مورد نیاز تولید--}}
                                    {{--                                            <span--}}
                                    {{--                                                style="color: red"--}}
                                    {{--                                                class="required-mark">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <select class="form-control" name="Productionconditions" id="Productionconditions">--}}
                                    {{--                                            <option value="1">تولید</option>--}}
                                    {{--                                        </select>--}}

                                    {{--                                    </div>--}}

                                    {{--                                    <div class="col-md-12">--}}
                                    {{--                                        <label>حساسیت مشتری--}}
                                    {{--                                            <span--}}
                                    {{--                                                style="color: red"--}}
                                    {{--                                                class="required-mark">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <select class="form-control" name="Priority" id="Priority">--}}
                                    {{--                                            <option value="1">حساس</option>--}}
                                    {{--                                            <option value="2">عادی</option>--}}
                                    {{--                                        </select>--}}

                                    {{--                                    </div>--}}
                                    {{--                                    <div class="col-md-12">--}}
                                    {{--                                        <label>سابقه تولید--}}
                                    {{--                                            <span--}}
                                    {{--                                                style="color: red"--}}
                                    {{--                                                class="required-mark">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <select class="form-control" name="history" id="history">--}}
                                    {{--                                            <option value="1">دارد</option>--}}
                                    {{--                                            <option value="2">ندارد</option>--}}
                                    {{--                                        </select>--}}

                                    {{--                                    </div>--}}
                                    {{--                                    <div class="col-md-12">--}}
                                    {{--                                        <label>نمونه تایید شده--}}
                                    {{--                                            <span--}}
                                    {{--                                                style="color: red"--}}
                                    {{--                                                class="required-mark">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <select class="form-control" name="Sample" id="Sample">--}}
                                    {{--                                            <option value="1">دارد</option>--}}
                                    {{--                                            <option value="2">ندارد</option>--}}
                                    {{--                                        </select>--}}

                                    {{--                                    </div>--}}


                                    <div class="col-md-12">
                                        <label>تعداد تولید مجاز
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="number" id="numbere" name="numbere" class="form-control"
                                               required>

                                    </div>

                                    {{--                                    <div class="col-md-12">--}}
                                    {{--                                        <label>تعداد تولید شده--}}
                                    {{--                                            <span--}}
                                    {{--                                                style="color: red"--}}
                                    {{--                                                class="required-mark">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <input type="number" id="numberr" name="numberr" class="form-control"--}}
                                    {{--                                               disabled--}}
                                    {{--                                               required>--}}

                                    {{--                                    </div>--}}


                                    <div class="col-md-12">

                                        <label>توضیحات
                                        </label>
                                        <textarea name="description" id="description" rows="5"
                                                  class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>

                                    </div>


                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveToListd" value="ثبت">
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

<div class="modal fade" id="schedulingModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        ارسال برای بارگیری
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

                            <form autocomplete="off" id="schedulingform" name="schedulingform"
                                  class="form-horizontal">
                                <input type="hidden" name="scheduling" id="scheduling">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <label>مقدار بارگیری
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="number" id="number" name="number" class="form-control"
                                               required>

                                    </div>

                                    <div class="col-md-12">
                                        <label>نوع وسیله
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="type" id="type" class="form-control">
                                            <option>سواری</option>
                                            <option>وانت</option>
                                            <option>نیسان</option>
                                            <option>خاور</option>
                                            <option>تک</option>
                                            <option>جفت</option>
                                            <option>ترانزیت</option>
                                        </select>

                                    </div>

                                    <div class="col-md-12">
                                        <label>حمل از طرف
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="Carry" id="Carry" class="form-control">
                                            <option>پولاد پویش</option>
                                            <option>مشتری</option>
                                        </select>

                                    </div>


                                    <div class="col-md-12">
                                        <label>تاریخ حمل
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="datev" name="date" class="form-control"
                                               required>

                                    </div>

                                    <div class="col-md-12">
                                        <label>زمان حمل
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="time" id="time" class="form-control">
                                            <option>صبح</option>
                                            <option>ظهر</option>
                                            <option>عصر</option>
                                            <option>شب</option>
                                        </select>

                                    </div>


                                    <div class="col-md-12">
                                        <label>توضیحات
                                        </label>
                                        <textarea name="description" id="description" rows="5"
                                                  class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>
                                    </div>
                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveToscheduling" value="ثبت">
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

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        ارسال برای زمانبندی بارگیری
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

                            <form autocomplete="off" id="productlistForm" name="productlistForm"
                                  class="form-horizontal">
                                <input type="hidden" name="product_id" id="product_id">
                                <input type="hidden" name="commodity_id" id="commodity_id">
                                @csrf
                                <div class="row">

                                    <div class="hello" id='TextBoxesGroup'>
                                        <div id="TextBoxDiv1">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>نوع وسیله
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="type" id="type" class="form-control">
                                            <option>سواری</option>
                                            <option>وانت</option>
                                            <option>نیسان</option>
                                            <option>خاور</option>
                                            <option>تک</option>
                                            <option>جفت</option>
                                            <option>ترانزیت</option>
                                        </select>

                                    </div>

                                    <div class="col-md-12">
                                        <label>حمل از طرف
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="Carry" id="Carry" class="form-control">
                                            <option>پولاد پویش</option>
                                            <option>مشتری</option>
                                        </select>

                                    </div>


                                    <div class="col-md-12">
                                        <label>تاریخ حمل
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="dateu" name="date" class="form-control"
                                               required>

                                    </div>

                                    <div class="col-md-12">
                                        <label>زمان حمل
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="time" id="time" class="form-control">
                                            <option>صبح</option>
                                            <option>ظهر</option>
                                            <option>عصر</option>
                                            <option>شب</option>
                                        </select>

                                    </div>


                                    <div class="col-md-12">
                                        <label>توضیحات
                                        </label>
                                        <textarea name="description" id="description" rows="5"
                                                  class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>
                                    </div>
                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtnListS"
                                                value="ثبت">
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

<div class="modal fade" id="cancelModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        انصراف از الباقی تولید
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

                            <form autocomplete="off" id="cancelForm" name="cancelForm"
                                  class="form-horizontal">
                                <input type="hidden" name="id_p" id="id_p">
                                @csrf
                                <div class="row">

                                    <div class="hello" id='TextBoxesGroup'>
                                        <div id="TextBoxDiv1">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>دلیل انصراف
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" name="reason" id="reason" class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <label>توضیحات
                                        </label>
                                        <textarea name="description" id="description" rows="5"
                                                  class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>
                                    </div>
                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtncancel"
                                                value="ثبت">
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

<div class="modal fade" id="ajaxModelPrint" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="modal-body col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            پیش نمایش و چاپ پیش فاکتور
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

                                <form autocomplete="off" id="CustomerPrint" name="CustomerPrint"
                                      class="form-horizontal">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <label>انبار:</label>
                                                    <select name="selectstores" id="selectstoressss"
                                                            class="form-control">
                                                        @foreach($selectstores as $selectstore)
                                                            <option
                                                                value="{{$selectstore->id}}">{{$selectstore->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>انتخاب بانک:</label>
                                                    <select name="name_bank" id="name_bankkk"
                                                            class="form-control">
                                                        @foreach($banks as $bank)
                                                            <option
                                                                value="{{$bank->id}}">{{$bank->NameBank}}</option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                                <div class="col-md-6">

                                                    <label>تاریخ اعتبار پیش فاکتور:</label>
                                                    <input name="date" id="dateeee" class="form-control">
                                                </div>

                                                <div class="col-md-6">

                                                    <label>زمان تحویل</label>
                                                    <input name="timee" id="timee" class="form-control">
                                                </div>
                                                <div class="col-md-12">

                                                    <label>توضیحات:</label>
                                                    <textarea id="descriptionnn"
                                                              placeholder="لطفا توضیحات خود را در مورد پیش فاکتور وارد کنید"
                                                              name="description" class="form-control">

                                                    </textarea>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <br/>
                                    <hr/>
                                    <div class="modal-footer">
                                        <div class="text-left">
                                            <button style="width: 130px" type="button" class="btn btn-success"
                                                    id="PrintSell"
                                                    data-dismiss="modal">
                                                پیش نمایش و چاپ
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
</div>


<div class="modal fade" id="ToList" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="modal-body col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            ارسال برای صف تولید
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
                                <form autocomplete="off" id="tolistform" name="tolistform">
                                    <input type="hidden" id="id_d" name="id_d">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table table-responsive">
                                                <table
                                                    class="table table-responsive table-striped table-bordered">
                                                    <thead style="background-color: #e8ecff">
                                                    <tr>
                                                        <td>شماره فروش</td>
                                                        <td>محصول</td>
                                                        <td>رنگ</td>
                                                        <td>تعداد کل</td>
                                                        <td>تعداد ارسالی برای تولید</td>
                                                        <td>تاریخ</td>
                                                        <td>الویت</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody
                                                        id="TextBoxContainer">
                                                    <tr>
                                                        <td id="numf"></td>
                                                        <td id="product_m"></td>
                                                        <td id="color_m"></td>
                                                        <td id="sum_m"></td>
                                                        <td id="sum_s"></td>
                                                        <td id="date_m"></td>
                                                        <td id="olavit"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <hr/>
                                    <div class="modal-footer">
                                        <div class="text-left">
                                            <button style="width: 130px" type="button" class="btn btn-success"
                                                    id="savetolist"
                                                    data-dismiss="modal">
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
</div>
