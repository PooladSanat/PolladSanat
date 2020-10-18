<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        مشخصات پرداخت مشتری
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
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>نام مشتری</label>
                                        <input readonly type="text" name="cname" id="cname" class="form-control">

                                    </div>
                                    <div class="col-md-4">
                                        <label>موجودی مشتری</label>
                                        <input readonly type="text" name="cprice" id="cprice" class="form-control">

                                    </div>
                                    <div class="col-md-4">
                                        <label>اخرین بروزرسانی</label>
                                        <input readonly type="text" name="cupdate" id="cupdate" class="form-control">

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
                                                <td>نوع پرداخت</td>
                                                <td>شماره چک</td>
                                                <td>نام بانک</td>
                                                <td>نام صادر کننده</td>
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
                                                    <td>نوع پرداخت</td>
                                                    <td>شماره چک</td>
                                                    <td>نام بانک</td>
                                                    <td>نام صادر کننده</td>
                                                    <td>مبلغ(ریال)</td>
                                                    <td>تاریخ</td>
                                                    <td>عملیات</td>
                                                </tr>
                                                </thead>
                                                <tbody
                                                    id="TextBoxContainerbank">

                                                <tr>
                                                    <td id="typee"></td>
                                                    <td id="shanasee"></td>
                                                    <td id="namee"></td>
                                                    <td id="user_namee"></td>
                                                    <td id="pricee"></td>
                                                    <td id="datee"></td>
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


<div class="modal fade" id="ajaxModelprice" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        صدور صورت حساب
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

                            <form autocomplete="off" id="productFormprice" name="productFormprice"
                            >
                                <input type="hidden" name="customer_idd" id="customer_idd">
                                <input type="hidden" name="pack_id" id="pack_id">
                                <input type="hidden" name="name_cusomer" id="name_cusomer">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">


                                            <div class="col-md-6">
                                                <label>جمع فاکتور های انتخابی(ریال)
                                                    <span
                                                        style="color: red"
                                                        class="required-mark"></span>
                                                </label>
                                                <input readonly type="number" id="sum_price" name="sum_price"
                                                       class="form-control"
                                                       required>
                                            </div>

                                            <div class="col-md-6">
                                                <label>مانده حساب مشتری(ریال)
                                                    <span
                                                        style="color: red"
                                                        class="required-mark"></span>
                                                </label>
                                                <input readonly type="number" id="creditor" name="creditor"
                                                       class="form-control"
                                                       required>
                                            </div>
                                            <div class="col-md-12">
                                                <label>تخفیف(ریال)
                                                    <span
                                                        style="color: red"
                                                        class="required-mark"></span>
                                                </label>
                                                <input value="0" type="number" id="takhfif" name="takhfif"
                                                       class="form-control"
                                                       required>
                                            </div>

                                            <div class="col-md-12">
                                                <label>مبلغ قابل پرداخت(ریال)
                                                    <span
                                                        style="color: red"
                                                        class="required-mark"></span>
                                                </label>
                                                <input readonly type="number" id="sum" name="sum"
                                                       class="form-control"
                                                       required>
                                            </div>


                                        </div>
                                        <br/>
                                    </div>
                                </div>

                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveprice"
                                                value="ثبت">
                                            صورت حساب
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
