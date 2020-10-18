<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
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

                            <form autocomplete="off" id="productForm" name="productForm">
                                <input type="hidden" name="id" id="id">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">


                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>انتقال از انبار
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select class="form-control" id="inbarn" name="inbarn">
                                                    <option value="1">پرند</option>
                                                    <option value="2">تهرانپارس</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>انتقال به انبار
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select class="form-control" id="tobarn" name="tobarn">
                                                    <option value="1">پرند</option>
                                                    <option value="2">تهرانپارس</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="table table-responsive">
                                            <table
                                                class="table table-responsive table-striped table-bordered">
                                                <thead style="background-color: #e8ecff">
                                                <tr>
                                                    <td>نوع انبار</td>
                                                    <td>محصول</td>
                                                    <td>رنگ</td>
                                                    <td>تعداد یا وزن</td>
                                                    <td>عملیات</td>
                                                </tr>
                                                </thead>
                                                <tbody
                                                    id="TextBoxContainerbank">

                                                <tr>
                                                    <td id="type_barn"></td>
                                                    <td id="product"></td>
                                                    <td id="color"></td>
                                                    <td id="number"></td>
                                                    <td id="action"></td>
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


<div class="modal fade" id="ajaxModell" aria-hidden="true">
    <div class="modal-dialog col-md-12">
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

                            <form autocomplete="off" id="productForme" name="productForme">
                                <input type="hidden" name="idsa" id="idsa">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">


                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>انتقال از انبار
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select class="form-control" id="inbarnnn" name="inbarnnn">
                                                    <option value="1">پرند</option>
                                                    <option value="2">تهرانپارس</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>انتقال به انبار
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select class="form-control" id="tobarnnnn" name="tobarnnnn">
                                                    <option value="1">پرند</option>
                                                    <option value="2">تهرانپارس</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="table table-responsive">
                                            <table
                                                class="table table-responsive table-striped table-bordered">
                                                <thead style="background-color: #e8ecff">
                                                <tr>
                                                    <td>نوع انبار</td>
                                                    <td>محصول</td>
                                                    <td>رنگ</td>
                                                    <td>تعداد یا وزن</td>
                                                    <td>عملیات</td>
                                                </tr>
                                                </thead>
                                                <tbody
                                                    id="TextBoxContainerbank">

                                                <tr>
                                                    <td id="ttype_barn"></td>
                                                    <td id="pproduct"></td>
                                                    <td id="ccolor"></td>
                                                    <td id="nnumber"></td>
                                                    <td id="aaction"></td>
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

                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtne" value="ثبت">
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
