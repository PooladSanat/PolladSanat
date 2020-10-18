<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <form autocomplete="off" id="productForm"
                  name="productForm"
                  enctype="multipart/form-data"
                  method="post"
            >
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
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

                            <div class="portlet-body">
                                <div class="row">


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>نام محصول
                                            </label>
                                            <select id="product_id" name="product_id" class="form-control"
                                                    required>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}">{{$product->label}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="table table-responsive">
                                    <table
                                        class="table table-responsive table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <td>نام مواد</td>
                                            <td>درصد</td>
                                            <td>عملیات</td>
                                        </tr>
                                        </thead>
                                        <tbody
                                            id="TextBoxContainerbank">

                                        <tr>
                                            <td id="productt"></td>
                                            <td id="percentageee"></td>
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
                            </div>

                        </div>


                    </div>


                </div>

            </form>
        </div>

    </div>
</div>

