<div class="modal fade" id="ajaxadmin" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        تسویه حساب صورت حساب
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

                            <form autocomplete="off" id="productFoerm" name="productFoerm">
                                <input type="hidden" name="customer_iderr" id="customer_iderr">
                                <input type="hidden" name="cid" id="cid">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <label>نام مشتری</label>
                                        <input readonly type="text" name="cnamee" id="cnamee" class="form-control">

                                    </div>


                                    <div class="col-md-4">
                                        <label> اسناد پرداختی مشتری</label>
                                        <input readonly type="text" name="document_customer_payment"
                                               id="document_customer_payment"
                                               class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label> فاکتورهای صادرشده</label>
                                        <input readonly type="text" name="factor_customer_payment"
                                               id="factor_customer_payment"
                                               class="form-control">
                                        <input readonly type="hidden" name="pricesummm" id="pricesummm"
                                               class="form-control">
                                    </div>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>

                                    <div class="col-md-12">
                                        <table style="border:2px solid black;" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col" style="width: 250px">شرح</th>
                                                <th scope="col">بدهکار(ریال)</th>
                                                <th scope="col">بستانکار(ریال)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row" style="width: 250px">مبلغ صورتحساب</th>
                                                <td></td>
                                                <td id="b1" style="color: rgb(255,43,28)"></td>

                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 250px">مبلغ پرداختی مشتری (بابت این صورت
                                                    حساب)
                                                </th>
                                                <td id="p1" style="color: #0014fb"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">مانده حساب مشتری (از قبل در سیستم)</th>
                                                <td id="m1" style="color: #0014fb"></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <th scope="row">مبلغ قابل پرداخت</th>
                                                <td></td>
                                                <td id="f1" style="color: rgb(255,43,28)"></td>
                                            </tr>


                                            </tbody>
                                        </table>
                                    </div>

                                    <br/>

                                    <div class="col-md-3">
                                        <label>وضعیت</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">تایید</option>
                                            <option value="2">عدم تایید</option>
                                        </select>
                                    </div>

                                    <div class="col-md-9">
                                        <label>توضیحات</label>
                                        <input type="text" name="description_admin" id="description_admin"
                                               class="form-control">
                                    </div>


                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success" id="admin"
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


<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        تسویه حساب صورت حساب
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
                                <input type="hidden" name="customer_ider" id="customer_ider">
                                <input type="hidden" name="customer_ideeeer" id="customer_ideeeer">

                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>نام مشتری</label>
                                        <input readonly type="text" name="cname" id="cname" class="form-control">

                                    </div>
                                    <div class="col-md-3">
                                        <label>موجودی مشتری</label>
                                        <input readonly type="text" name="cprice" id="cprice" class="form-control">
                                        <input readonly type="hidden" name="cpriicee" id="cpriicee"
                                               class="form-control">

                                    </div>
                                    <div class="col-md-3">
                                        <label>اخرین بروزرسانی حساب مشتری</label>
                                        <input readonly type="text" name="cupdate" id="cupdate" class="form-control">

                                    </div>

                                    <div class="col-md-3">
                                        <label>مبلغ صورت حساب</label>
                                        <input readonly type="text" name="pricesum" id="pricesum" class="form-control">
                                        <input readonly type="hidden" name="pricesuumm" id="pricesuumm"
                                               class="form-control">

                                    </div>

                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <div class="col-md-12">


                                        <table class="table table-striped table-bordered gfgf" id="gfgf">
                                            <thead style="background-color: #e8ecff">
                                            <tr>
                                                <th>ردیف</th>
                                                <td>نوع سند</td>
                                                <td>شماره سند</td>
                                                <td>تاریخ سند</td>
                                                <td>نام بانک</td>
                                                <td>نام صادر کننده</td>
                                                <td>مبلغ(ریال)</td>
                                                <td>عملیات</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                    </div>


                                    <div class="col-md-12">

                                        <div class="table table-responsive">
                                            <table
                                                class="table table-responsive table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <td>نوع سند</td>
                                                    <td>شماره سند</td>
                                                    <td>تاریخ سند</td>
                                                    <td>نام بانک</td>
                                                    <td>نام صادر کننده</td>
                                                    <td>مبلغ(ریال)</td>
                                                    <td>عملیات</td>
                                                </tr>
                                                </thead>
                                                <tbody
                                                    id="TextBoxContainerbank">

                                                <tr>
                                                    <td id="typee"></td>
                                                    <td id="shanasee"></td>
                                                    <td id="datee"></td>
                                                    <td id="namee"></td>
                                                    <td id="user_namee"></td>
                                                    <td id="pricee"></td>
                                                    <td id="actiontt"></td>
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
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success" id="saveBtn"
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


<div class="modal fade" id="ajaxModeledit" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        ویرایش مشخصات پرداخت مشتری
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

                            <form autocomplete="off" id="productFormedit" name="productFormedit">
                                <input type="hidden" name="id_detail" id="id_detail">

                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>نوع سند</label>
                                        <select class="form-control" name="tyypee" id="tyypee">
                                            <option value='2'>چکی</option>
                                            <option value='1'>فیش حواله</option>
                                        </select>

                                    </div>
                                    <div class="col-md-2">
                                        <label>شماره سند</label>
                                        <input type="number" name="shenasee" id="shenasee" class="form-control">

                                    </div>
                                    <div class="col-md-2">
                                        <label>تاریخ سند</label>
                                        <input type="text" name="daatee" id="daatee" class="form-control">

                                    </div>
                                    <div class="col-md-2">
                                        <label>نام بانک</label>
                                        <select class="form-control" name="naamee" id="naamee">
                                            <option value=''>انتخاب کنید</option>
                                            <option value='بانک ملّی ایران'>بانک ملّی ایران</option>
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
                                        <label>نام صادر کننده</label>
                                        <input type="text" name="name_userr" id="name_userr" class="form-control">

                                    </div>
                                    <div class="col-md-2">
                                        <label>مبلغ(ریال)</label>
                                        <input type="number" name="prricee" id="prricee" class="form-control">

                                    </div>


                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtnedit"
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


<div class="modal fade" id="ajaxModellistr" aria-hidden="true">
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
                                        <table class="table table-striped table-bordered factor" id="factor">
                                            <thead style="background-color: #e8ecff">
                                            <tr>
                                                <td>شماره فاکتور</td>
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
                                <hr/>
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
                    <div class="caption" id="cap">

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
                                                <li id="tt" class="active" style="width: 49%;"><a href="#t"
                                                                                                  data-toggle="tab">مشخصات
                                                        ریالی صورتحساب</a></li>
                                                <li id="ff" style="width: 50%;"><a href="#f" data-toggle="tab">مشخصات
                                                        فروش صورتحساب</a></li>
                                            </ul>
                                            <div class="tab-content">

                                                <div class="active tab-pane" id="t">
                                                    <table class="table table-striped table-bordered factooooor"
                                                           id="factooooor">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <td style="width: 1px">شماره فاکتور</td>
                                                            <td>فروشنده</td>
                                                            <td>خریدار</td>
                                                            <td>قیمت(ریال)</td>
                                                            <td>تخفیف(ریال)</td>
                                                            <td>پرداخت</td>
                                                            <td>تاریخ</td>
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
                                                    <br/>
                                                    <table class="table table-striped table-bordered factooor"
                                                           id="factooor">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <td>شماره فاکتور</td>
                                                            <td>فروشنده</td>
                                                            <td>خریدار</td>
                                                            <td>محصول</td>
                                                            <td>رنگ</td>
                                                            <td>تعداد(عدد)</td>
                                                            <td>تاریخ</td>
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
