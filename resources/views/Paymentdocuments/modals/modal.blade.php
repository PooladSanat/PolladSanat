<div class="modal fade" id="ajaxadmin" aria-hidden="true">
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

                            <form autocomplete="off" id="productFoerm" name="productFoerm">
                                <input type="hidden" name="customer_iderr" id="customer_iderr">
                                <input type="hidden" name="cid" id="cid">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>نام مشتری</label>
                                        <input readonly type="text" name="cnamee" id="cnamee" class="form-control">

                                    </div>
                                    <div class="col-md-2">
                                        <label>مبلغ صورت حساب</label>
                                        <input readonly type="text" name="pricesumm" id="pricesumm"
                                               class="form-control">
                                        <input readonly type="hidden" name="pricessummm" id="pricessummm"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label>پرداختی مشتری بابت صورت حساب</label>
                                        <input readonly type="text" name="price_customer_payment"
                                               id="price_customer_payment"
                                               class="form-control">
                                        <input type="hidden" name="detail_customersa" id="detail_customersa"/>

                                    </div>
                                    <div class="col-md-2">
                                        <label>بدهی مشتری بابت صورت حساب</label>
                                        <input readonly type="text" name="recive_customer_payment"
                                               id="recive_customer_payment"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label> اسناد پرداختی مشتری تا به امروز</label>
                                        <input readonly type="text" name="document_customer_payment"
                                               id="document_customer_payment"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label> فاکتور های صادر شده تا به امروز</label>
                                        <input readonly type="text" name="factor_customer_payment"
                                               id="factor_customer_payment"
                                               class="form-control">
                                        <input readonly type="hidden" name="pricesummm" id="pricesummm"
                                               class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label>وضعیت</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">تایید</option>
                                            <option value="2">عدم تایید</option>
                                        </select>
                                    </div>

                                    <div class="col-md-10">
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
                                                <td>شماره فاکتور</td>
                                                <td>نام محصول</td>
                                                <td>رنگ</td>
                                                <td>تعداد(عدد)</td>
                                                <td>مبلغ(ریال)</td>
                                                <td>تاریخ</td>
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


<div class="modal fade" id="ajaxModelsatus" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        ثبت وضعیت نهایی چک
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

                            <form autocomplete="off" id="productFormstatus" name="productFormstatus">
                                <input type="hidden" name="id_status" id="id_status">

                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>وضعیت</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">تصویه نشده</option>
                                            <option value="2">تصویه شده</option>
                                            <option value="3">برگشت خورده</option>

                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label>توضیحات</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" cols="50"
                                                  placeholder="لطفا توضیحات خود را وارد کنید ">

                                        </textarea>
                                    </div>
                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success" id="saveBtnstatus"
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
