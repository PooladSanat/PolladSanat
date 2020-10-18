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

                            <form autocomplete="off" id="productForme" name="productForme" class="form-horizontal">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="product_id" id="product_id">
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

<div class="modal fade" id="ajaxModelExit" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="captioon">
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

                            <form autocomplete="off" id="productFmm" name="productFmm">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="prod" id="prod">
                                <input type="hidden" name="namee" id="namee">
                                <input type="hidden" name="colorr" id="colorr">
                                <input type="hidden" name="id_exit" id="id_exit">
                                <input type="hidden" name="updatee" id="updatee">
                                <input type="hidden" name="custommmmerrrr" id="custommmmerrrr">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>شماره حواله
                                                    </label>
                                                    <input class="form-control" type="text" name="hav" id="hav"
                                                           disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>نام خریدار
                                                    </label>
                                                    <input class="form-control" type="text" name="custommmsmerrrr"
                                                           id="custommmsmerrrr" disabled></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>توضیحات
                                                    </label>
                                                    <input class="form-control" type="text" name="descriptioonn"
                                                           id="descriptioonn" disabled></div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="table table-responsive">
                                            <table
                                                class="table table-responsive table-striped table-bordered">
                                                <thead style="background-color: #989e8f">
                                                <tr>
                                                    <td style="font-size: 25px">کد فروش</td>
                                                    <td>نام محصول</td>
                                                    <td>رنگ</td>
                                                    <td>تعداد</td>
                                                    <td>تعداد خروجی</td>
                                                </tr>
                                                </thead>
                                                <tbody
                                                    id="TextBoxContainerbank">
                                                <tr>
                                                    <td id="codee"></td>
                                                    <td id="productt"></td>
                                                    <td id="colorrr"></td>
                                                    <td id="numberr"></td>
                                                    <td id="numberexitt"></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="pull-left">
                                            <button style="width: 130px" type="submit" class="btn btn-success"
                                                    id="savebarn" value="ثبت">
                                                ثبت
                                            </button>
                                            &nbsp;&nbsp;
                                            <a data-dismiss="modal" style="width: 130px" type="submit"
                                               class="btn btn-danger">
                                                بستن
                                            </a>
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

<div class="modal fade" id="ajaxModelfac" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="captioson">
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

                            <form autocomplete="off" id="productFormdf" name="productFormdf" class="form-horizontal">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="produc" id="produc">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">

                                        <label>شماره فاکتور
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="number" name="number" class="form-control"
                                               placeholder="لطفا شماره فاکتور را وارد کنید"
                                               required>

                                    </div>

                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success" id="okBtn"
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

<div class="modal fade" id="changedateModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        تغیر زمان بارگیری
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

                            <form autocomplete="off" id="changedateForm" name="changedateForm" class="form-horizontal">
                                <input type="hidden" name="id_d" id="id_d">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">

                                        <label>تاریخ
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="date" name="date" class="form-control"
                                               required>

                                    </div>

                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtndate"
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
                        انصراف فروش
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

<div class="modal fade" id="ajaxModelExitDetail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="captionEx">
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

                            <form autocomplete="off" id="productFormeeeeeee" name="productFormeeeeeee"
                                  class="form-horizontal">
                                <input type="hidden" name="id_exittt" id="id_exittt">
                                <input type="hidden" name="proder" id="proder">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">

                                        <label>تعداد خروجی
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="numberrr" name="numberrr" class="form-control"
                                               placeholder="لطفا تعداد خروج از انبار را وارد کنید"
                                               required>

                                    </div>

                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success" id="exitBtn"
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

<div class="modal fade" id="editcar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        ویرایش مشخصات ارسال بار
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

                            <form autocomplete="off" id="editcarr" name="editcarr"
                                  class="form-horizontal">
                                <input type="hidden" name="id_pp" id="id_pp">
                                @csrf
                                <div class="row">
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
                                        <textarea name="descrtiption" id="descrtiption" rows="5"
                                                  class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>
                                    </div>
                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveeditcar"
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

<div class="modal fade" id="customere" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        مشخصات مشتری
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

                            <form autocomplete="off" id="editcarr" name="editcarr"
                                  class="form-horizontal">
                                <input type="hidden" name="id_pp" id="id_pp">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="col-md-6">شماره همراه:</label>
                                        <label id="phone" class="col-md-6"></label>
                                    </div>
                                    <br/>
                                    <br/>
                                    <div class="col-md-12">
                                        <label class="col-md-6">شماره تماس:</label>
                                        <label id="tel" class="col-md-6"></label>
                                    </div>
                                    <br/>
                                    <br/>
                                    <div class="col-md-12">
                                        <label class="col-md-6">آدرس:</label>
                                        <label id="address" class="col-md-6"></label>
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



<div class="modal fade" id="changedateModele" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        تغیر زمان بارگیری
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

                            <form autocomplete="off" id="changedateFormesa" name="changedateFormesa" class="form-horizontal">
                                <input type="hidden" name="id_de" id="id_de">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">

                                        <label>تاریخ
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="daatee" name="daatee" class="form-control"
                                               required>

                                    </div>

                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtndatee"
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
