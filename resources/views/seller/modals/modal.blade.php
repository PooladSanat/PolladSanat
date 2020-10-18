<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog  col-md-12">
            <div class="modal-body  col-md-12">
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
                                    <input type="hidden" name="product_id" id="product_id">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">

                                                <label>کد
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="code" name="code" class="form-control"
                                                       placeholder="لطفا کد فروشنده را وارد کنید"
                                                       required>

                                        </div>
                                        <div class="col-md-3">

                                                <label>نام شرکت
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="company" name="company" class="form-control"
                                                       placeholder="لطفا نام شرکت را وارد کنید"
                                                       required>

                                        </div>


                                        <div class="col-md-3">

                                                <label>نام شخص رابط
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="connector" name="connector" class="form-control"
                                                       placeholder="لطفا نام شخص رابط را وارد کنید"
                                                       required>

                                        </div>

                                        <div class="col-md-3">

                                                <label>سمت</label>
                                                <input type="text" id="side" name="side" class="form-control"
                                                       placeholder="لطفا سمت را وارد کنید"
                                                       required>

                                        </div>

                                        <div class="col-md-3">

                                                <label>شماره تلفن</label>
                                                <input type="text" id="tel" name="tel" class="form-control"
                                                       placeholder="لطفا شماره تلفن را وارد کنید"
                                                       required>

                                        </div>


                                        <div class="col-md-3">

                                                <label>شماره داخلی</label>
                                                <input type="text" id="inside" name="inside" class="form-control"
                                                       placeholder="لطفا شماره داخلی را وارد کنید"
                                                       required>

                                        </div>


                                        <div class="col-md-3">

                                                <label>شماره همراه
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="phone" name="phone" class="form-control"
                                                       placeholder="لطفا شماره همراه را وارد کنید"
                                                       required>

                                        </div>


                                    </div>
                                    <br/>
                                    <hr/>
                                    <div class="modal-footer">
                                        <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success" id="saveBtn" value="ثبت">
                                            ثبت
                                        </button>

                                        <button style="width: 130px" type="button" class="btn btn-danger" data-dismiss="modal">
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

