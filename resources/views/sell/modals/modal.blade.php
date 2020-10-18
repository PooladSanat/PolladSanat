<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            تایید پیش فاکتور توسط مشتری
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

                                <form autocomplete="off" id="CustomerConfirm" name="CustomerConfirm"
                                      class="form-horizontal">
                                    <input type="hidden" name="invoice_id" id="invoice_id">
                                    <input type="hidden" name="id_in" id="id_in">
                                    @csrf
                                    <div class="row">


                                        <div class="col-md-12">

                                                <label>تاریخ تایید مشتری
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="date" name="date" class="form-control"
                                                       required>

                                        </div>

                                        <div class="col-md-12">

                                                <label>نحوه تایید
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select class="form-control" name="HowConfirm" id="HowConfirm">
                                                    <option value="1">شفاهی</option>
                                                    <option value="2">فکس</option>
                                                    <option value="3">واتساپ</option>
                                                    <option value="4">تلگرام</option>
                                                    <option value="5">SMS</option>
                                                    <option value="6">سایر</option>
                                                </select>

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
                                                    id="saveConfirm" value="ثبت">
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

<div class="modal fade" id="ajaxModelCustomer" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="modal-body col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            سوابق مالی مشتری
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

                                <form autocomplete="off" id="CustomersValidate" name="CustomersValidate"
                                      class="form-horizontal">
                                    <input type="hidden" name="customer_id" id="customer_id">
                                    @csrf
                                    <div class="row">

                                        <div>
                                            <div class="col-md-3">
                                                <label>سقف اعتباری
                                                </label>
                                                <input type="text" id="Creditceiling" name="Creditceiling"
                                                       class="form-control"
                                                       required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>سقف حساب باز
                                                </label>
                                                <input type="text" id="Openceiling" name="Openceiling"
                                                       class="form-control"
                                                       required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>تعداد خرید سال جاری
                                                </label>
                                                <input type="text" id="Yearcount" name="Yearcount" class="form-control"
                                                       required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>تعداد خرید سال گذشته
                                                </label>
                                                <input type="text" id="yearAgoCount" name="yearAgoCount"
                                                       class="form-control"
                                                       required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>گردش حساب سال جاری
                                                </label>
                                                <input type="text" id="Yearturnover" name="Yearturnover"
                                                       class="form-control"
                                                       required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>گردش حساب سال گذشته
                                                </label>
                                                <input type="text" id="lastYearturnover" name="lastYearturnover"
                                                       class="form-control"
                                                       required>
                                            </div>
                                        </div>


                                        <div>


                                            <div class="col-md-3">
                                                <label>سابقه چک برگشتی
                                                </label>
                                                <input type="text" id="Checkback" name="Checkback" class="form-control"
                                                       required>
                                            </div>

                                            <div class="col-md-3">
                                                <label>چک های برگشتی در جریان
                                                </label>
                                                <input type="text" id="Checkbackintheflow" name="Checkbackintheflow"
                                                       class="form-control"
                                                       required>
                                            </div>

                                            <div class="col-md-3">
                                                <label>مانده حساب معوق
                                                </label>
                                                <input type="text" id="accountbalance" name="accountbalance"
                                                       class="form-control"
                                                       required>
                                            </div>

                                            <div class="col-md-3">
                                                <label>میانگین زمان معوق
                                                </label>
                                                <input type="text" id="Averagetimedelay" name="Averagetimedelay"
                                                       class="form-control"
                                                       required>
                                            </div>

                                            <div class="col-md-3">
                                                <label>فاکتورهای سررسید آتی
                                                </label>
                                                <input type="text" id="Futurefactors" name="Futurefactors"
                                                       class="form-control"
                                                       required>
                                            </div>

                                            <div class="col-md-3">
                                                <label>اسناد دریافتنی
                                                </label>
                                                <input type="text" id="Receiveddocuments" name="Receiveddocuments"
                                                       class="form-control"
                                                       required>
                                            </div>

                                            <div class="col-md-3">
                                                <label>مانده حساب باز
                                                </label>
                                                <input type="text" id="Openaccountbalance" name="Openaccountbalance"
                                                       class="form-control"
                                                       required>
                                            </div>

                                            <div class="col-md-3">
                                                <label>نحوه پرداخت فاکتورهای قبلی
                                                </label>
                                                <input type="text" id="paymentmethod" name="paymentmethod"
                                                       class="form-control"
                                                       required>
                                            </div>
                                            <div class="col-md-12">
                                                <label>توضیحات واحد مالی
                                                </label>
                                                <textarea class="form-control" id="description_m" name="description"
                                                          placeholder="لطفا توضیحات خود را در مورد مشتری وارد کنید">

                                            </textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <br/>
                                    <hr/>
                                    <div class="modal-footer">
                                        <div class="text-left">

                                            <button style="width: 130px" type="submit" class="btn btn-success"
                                                    id="saveCustomerValidate"
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











