<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            Bom
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
                                    <input type="hidden" name="pr" id="pr">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">

                                                <label for="title">محصول
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select class="form-control"
                                                        name="product_id"
                                                        id="produ"
                                                        required>
                                                    <option>لطفا نام محصول را انتخاب کنید</option>
                                                    @foreach($products as $product)
                                                        <option value="{{$product->id}}">{{$product->label}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="title">زیر مجموعه
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select name="bom_id" id="bo"
                                                        class="form-control">
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label>تعداد
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="pnumber" name="number" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
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

<div class="modal fade" id="ajax" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-body">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            Bom
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

                                <form id="product" name="product" class="form-horizontal">
                                    <input type="hidden" name="id_product" id="id_product">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">

                                                <label for="title">زیر مجموعه
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select name="bom_id" id="bom_id"
                                                        class="form-control">

                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label>تعداد
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="number" name="number" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
                                                       required>
                                            </div>
                                        </div>

                                    <br/>
                                    <hr/>
                                    <div class="modal-footer">
                                        <div class="text-left">
                                            <button style="width: 130px" type="submit" class="btn btn-success" id="bom" value="ثبت">
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


