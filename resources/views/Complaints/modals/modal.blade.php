<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        افزودن شکایت جدید
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

                            <form autocomplete="off" id="productFossrm" name="productFossrm"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="product" id="product">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-2">

                                                <label>تاریخ شکایت
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="datee" name="datee" class="form-control"
                                                       placeholder="لطفا تاریخ شکایت را وارد کنید"
                                                       required>

                                            </div>

                                            <div class="col-md-2">

                                                <label>مشتری
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select class="form-control" name="customerre" id="customerre">
                                                    <option>انتخاب کنید...</option>
                                                    @foreach($customers as $customer)
                                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>


                                            <div class="col-md-4">

                                                <label>موضوع
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="title" name="title" class="form-control"
                                                       placeholder="لطفا موضوع شکایت را وارد کنید"
                                                       required>

                                            </div>

                                            <div class="col-md-2">

                                                <label>میزان اهمیت
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select class="form-control" name="importance" id="importance">
                                                    <option>انتخاب کنید...</option>
                                                    <option value="معمولی">معمولی</option>
                                                    <option value="مهم">مهم</option>
                                                    <option value="بسیار مهم">بسیار مهم</option>
                                                </select>

                                            </div>


                                            <div class="col-md-2">

                                                <label>نحوه اطلاع رسانی مشتری
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select class="form-control" name="Notices" id="Notices">
                                                    <option>انتخاب کنید...</option>
                                                    <option value="تماس تلفنی">تماس تلفنی</option>
                                                    <option value="فکس">فکس</option>
                                                    <option value="حضوری">حضوری</option>
                                                    <option value="ایمیل">ایمیل</option>
                                                </select>

                                            </div>

                                            <div class="col-md-12">

                                                <label>شرح کامل شکایت
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <textarea id="descriptionk"
                                                          placeholder="لطفا شرح کامل شکایت وارد کنید"
                                                          name="descriptionk" class="form-control">

                                                    </textarea>


                                            </div>


                                            <div class="col-md-12">

                                                <label>درحواست مشتری
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <textarea id="descriptionm"
                                                          placeholder="لطفا درحواست مشتری وارد کنید"
                                                          name="descriptionm" class="form-control">

                                                    </textarea>


                                            </div>
                                        </div>
                                        <br/>
                                        <div class="table table-responsive">
                                            <table
                                                class="table table-responsive table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <td>فاکتور</td>
                                                    <td>محصول</td>
                                                    <td>رنگ</td>
                                                    <td>تعداد کل</td>
                                                    <td>تعداد مرجوع شده</td>
                                                    <td>دلیل مشتری</td>
                                                    <td>فایل پیوست</td>
                                                    <td>عملیات</td>
                                                </tr>
                                                </thead>
                                                <tbody
                                                    id="TextBoxContainerbank">

                                                <tr>
                                                    <td id="invoicee"></td>
                                                    <td id="productt"></td>
                                                    <td id="colorr"></td>
                                                    <td id="totalnumberr"></td>
                                                    <td id="numberr"></td>
                                                    <td id="reasonss"></td>
                                                    <td id="filee"></td>
                                                    <td id="actiont"></td>
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
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtn"
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


<div class="modal fade" id="qcmodel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="modal-body col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            تعریف مرجوعی جدید
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

                                <form autocomplete="off" id="productFor" name="productFor">
                                    <input type="hidden" id="id_id" name="id_id">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">


                                                <div class="col-md-4">
                                                    <label>مشتری:</label>
                                                    <select name="customer_id" id="customer_idese"
                                                            class="form-control">
                                                        <option>انتخاب کنید...</option>
                                                        @foreach($customers as $customer)
                                                            <option
                                                                value="{{$customer->id}}">{{$customer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>هزینه حمل:</label>
                                                    <select name="Carry" id="Carry"
                                                            class="form-control">
                                                        <option value="پولاد پویش">پولاد پویش</option>
                                                        <option value="مشتری">مشتری</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>تاریخ مرجوع:</label>
                                                    <input type="text" name="dattee" id="dattee" class="form-control">
                                                </div>


                                                <div class="col-md-12">
                                                    <label> دلایل مشتری جهت عودت محصول:</label>
                                                    <textarea name="description_m" id="description_m"
                                                              placeholder="لطفا  دلایل مشتری جهت عودت محصول را وارد کنید"
                                                              class="form-control"
                                                              rows="2" cols="50">
                                                    </textarea>
                                                </div>

                                                <div class="col-md-12">
                                                    <label>دلایل واحد فروش جهت پذیرش:</label>
                                                    <textarea name="description_f" id="description_f"
                                                              placeholder="لطفا دلایل واحد فروش جهت پذیرش خود را وارد کنید"
                                                              class="form-control"
                                                              rows="2" cols="50">
                                                    </textarea>
                                                </div>

                                                <div class="col-md-12">
                                                    <label>توضیحات:</label>
                                                    <textarea name="description" id="description"
                                                              placeholder="لطفا توضیحات خود را وارد کنید"
                                                              class="form-control"
                                                              rows="2" cols="50">
                                                    </textarea>
                                                </div>


                                            </div>

                                            <br/>
                                            <div class="table table-responsive">
                                                <table
                                                    class="table table-responsive table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <td>فاکتور</td>
                                                        <td>محصول</td>
                                                        <td>رنگ</td>
                                                        <td>تعداد کل</td>
                                                        <td>تعداد مرجوعی</td>
                                                        <td>دلیل مشتری</td>
                                                        <td>عملیات</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody
                                                        id="TextBoxContainer">

                                                    <tr>
                                                        <td id="invoiceee"></td>
                                                        <td id="producttt"></td>
                                                        <td id="colorrr"></td>
                                                        <td id="totalnumberrr"></td>
                                                        <td id="numberrr"></td>
                                                        <td id="reasonsss"></td>
                                                        <td id="actiontt"></td>
                                                    </tr>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th colspan="1">
                                                            <button id="btnAddbankk"
                                                                    type="button"
                                                                    onclick="addInput11()"
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
                                            <button style="width: 130px" type="button" class="btn btn-success"
                                                    id="saveB"
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
