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

