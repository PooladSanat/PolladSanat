
<div class="modal fade" id="ajaxModell" aria-hidden="true">
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

                                                <label>موجودی فزیکی
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <input type="number" id="PhysicalInventory" name="PhysicalInventory" class="form-control"
                                                       placeholder="لطفا موجودی فزیکی را وارد کنید"
                                                       required>

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

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        رسید مستربچ
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

                            <form autocomplete="off" id="productFormv" name="productFormv">
                                <input type="hidden" name="product_id" id="product_id">
                                @csrf
                                <div class="row">


                                    <div class="col-md-12">

                                        <label>مستربچ
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>

                                        <select class="form-control" id="product" name="product">
                                            @foreach($products as $prodeuct)
                                                <option value="{{$prodeuct->id}}">{{$prodeuct->manufacturer}} - {{$prodeuct->name}}</option>
                                            @endforeach
                                        </select>


                                    </div>
                                    <div class="col-md-12">

                                        <label>تعداد
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="number" id="PhysicalInventory" name="PhysicalInventory"
                                               class="form-control"
                                               placeholder="لطفا تعداد را وارد کنید"
                                               required>

                                    </div>

                                    <div class="col-md-12">
                                        <label>انبار
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" id="barn" name="barn">
                                           <option value="1">پرند</option>
                                           <option value="2">تهرانپارس</option>
                                        </select>
                                    </div>


                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBbtn" value="ثبت">
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

