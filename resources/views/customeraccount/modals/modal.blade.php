<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        شارژ حساب مشتری
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
                                <input type="hidden" name="customer_id" id="customer_id">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>نام مشتری</label>
                                                <input type="text" class="form-control" name="name_userrr" id="name_userrr" disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label>مانده حساب</label>
                                                <input type="text" class="form-control" id="userrr_payment" name="userrr_payment" disabled>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="table table-responsive">
                                            <table
                                                class="table table-responsive table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <td>نوع سند</td>
                                                    <td>شماره سند</td>
                                                    <td>تاریخ سر رسید</td>
                                                    <td>نام بانک</td>
                                                    <td>نام صادر کننده</td>
                                                    <td>مبلغ(ریال)</td>
                                                    <td>شرح</td>
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
                                                    <td id="descriptionn"></td>
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


<div class="modal fade" id="editpayment" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        ویرایش پرداختی مشتری
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

                            <form autocomplete="off" id="form_editpament" name="form_editpament">
                                <input type="hidden" name="id_payment" id="id_payment">
                                <input type="hidden" name="id_customer" id="id_customer">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <label>نوع پرداخت</label>
                                            <select class="form-control" name="type" id="type">
                                                <option value="1">نقدی</option>
                                                <option value="2">چک</option>
                                            </select>

                                        </div>


                                        <div class="col-md-2">
                                            <label>شماره چک</label>
                                            <input type="number" class="form-control" id="shanase" name="shanase">
                                        </div>

                                        <div class="col-md-2">
                                            <label>نام بانک</label>
                                            <select class="form-control" name="name" id="name">
                                                <option value="بانک ملّی ایران">بانک ملّی ایران</option>
                                                <option value="بانک سپه">بانک سپه</option>
                                                <option value="بانک صنعت و معدن">بانک صنعت و معدن</option>
                                                <option value="بانک کشاورزی">بانک کشاورزی</option>
                                                <option value="بانک مسکن">بانک مسکن</option>
                                                <option value="بانک آینده">بانک آینده</option>
                                                <option value="بانک توسعه صادرات ایران">بانک توسعه صادرات ایران</option>
                                                <option value="بانک توسعه تعاون">بانک توسعه تعاون</option>
                                                <option value="پست بانک ایران">پست بانک ایران</option>
                                                <option value="بانک اقتصاد نوین">بانک اقتصاد نوین</option>
                                                <option value="بانک پارسیان">بانک پارسیان</option>
                                                <option value="بانک کارآفرین">بانک کارآفرین</option>
                                                <option value="بانک سامان">بانک سامان</option>
                                                <option value="بانک سینا">بانک سینا</option>
                                                <option value="بانک خاور میانه">بانک خاور میانه</option>
                                                <option value="بانک شهر">بانک شهر</option>
                                                <option value="بانک دی">بانک دی</option>
                                                <option value="بانک صادرات">بانک صادرات</option>
                                                <option value="بانک ملت">بانک ملت</option>
                                                <option value="بانک تجارت">بانک تجارت</option>
                                                <option value="بانک رفاه">بانک رفاه</option>
                                                <option value="بانک حکمت ایرانیان">بانک حکمت ایرانیان</option>
                                                <option value="بانک گردشگری">بانک گردشگری</option>
                                                <option value="بانک ایران زمین">بانک ایران زمین</option>
                                                <option value="بانک قوامین">بانک قوامین</option>
                                                <option value="بانک انصار">بانک انصار</option>
                                                <option value="بانک سرمایه">بانک سرمایه</option>
                                                <option value="بانک پاسارگاد">بانک پاسارگاد</option>
                                                <option value="بانک مشترک ایران-ونزوئلا

">بانک مشترک ایران-ونزوئلا

                                                </option>
                                                <option value="
بانک قرض‌الحسنه مهر ایران">
                                                    بانک قرض‌الحسنه مهر ایران
                                                </option>
                                                <option value="
بانک قرض‌الحسنه رسالت">
                                                    بانک قرض‌الحسنه رسالت
                                                </option>

                                            </select>

                                        </div>
                                        <div class="col-md-2">
                                            <label>نام صادر کننده</label>
                                            <input type="text" class="form-control" id="name_user" name="name_user">
                                        </div>
                                        <div class="col-md-2">
                                            <label>مبلغ(ریال)</label>
                                            <input type="number" class="form-control" id="price" name="price">
                                        </div>

                                        <div class="col-md-2">
                                            <label>تاریخ وصول</label>
                                            <input type="text" class="form-control" id="date" name="date">
                                        </div>

                                        <div class="col-md-12">
                                            <label>شرح</label>
                                            <input type="text" class="form-control" id="shahr" name="shahr">
                                        </div>

                                    </div>

                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveeditpament"
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


<div class="modal fade" id="editpaymentcustomer" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        موجودی مشتری
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

                            <form autocomplete="off" id="editpaymentcustomerForm" name="editpaymentcustomerForm">
                                <input type="hidden" name="cusomer_id_payment" id="cusomer_id_payment">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>موجودی مشتری:</label>
                                        <input type="text" name="priced" id="priced" class="form-control">
                                    </div>

                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtnpayment"
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
