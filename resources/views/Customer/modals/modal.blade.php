<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            انواع مشتریان
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

                                <form id="productForm" name="productForm" class="form-horizontal">
                                    <input type="hidden" name="product" id="product">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>کد</label>
                                                <input type="text" id="code" name="code" class="form-control"
                                                       placeholder="لطفا کد را وارد کنید"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label>نام</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                       placeholder="لطفا نام را وارد کنید"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">نوع</label>
                                                <select class="form-control"
                                                        name="type"
                                                        id="type"
                                                        required>
                                                    <option value="1">شرکتی</option>
                                                    <option value="2">شخصی</option>
                                                </select>
                                            </div>
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

