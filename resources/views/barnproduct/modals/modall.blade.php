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
                                <input type="hidden" name="product_id" id="product_id">
                                @csrf
                                <div class="row">


                                    <div class="col-md-12">

                                        <label>محصول
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>

                                        <select class="form-control" id="product" name="product">
                                            @foreach($products as $prodeuct)
                                                <option value="{{$prodeuct->id}}">{{$prodeuct->label}}</option>
                                            @endforeach
                                        </select>


                                    </div>


                                    <div class="col-md-12">

                                        <label>رنگ
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>

                                        <select class="form-control" id="color" name="color">
                                            @foreach($colors as $color)
                                                <option value="{{$color->id}}">{{$color->name}}
                                                    - {{$color->manufacturer}} - {{$color->masterbatch}}</option>
                                            @endforeach
                                        </select>


                                    </div>


                                    <div class="col-md-12">

                                        <label>موجودی انبار پرند
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="number" id="PhysicalInventory" name="PhysicalInventory"
                                               class="form-control"
                                               placeholder="لطفا موجودی فیزیکی را وارد کنید"
                                               required>

                                    </div>

                                    <div class="col-md-12">

                                        <label>موجودی انبار تهرانپارس
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="number" id="PhysicalInventor" name="PhysicalInventor"
                                               class="form-control"
                                               placeholder="لطفا موجودی فیزیکی را وارد کنید"
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

<div class="modal fade" id="ajaxModellistre" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caapp">

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
                                        <table class="table table-striped table-bordered factooorrr"
                                               id="factooorrr">
                                            <thead style="background-color: #e8ecff">
                                            <tr>
                                                <td>شماره فاکتور</td>
                                                <td>فروشنده</td>
                                                <td>خریدار</td>
                                                <td>رنگ</td>
                                                <td>محصول</td>
                                                <td>تعداد</td>
                                                <td>تاریخ</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
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
