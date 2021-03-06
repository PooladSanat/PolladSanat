<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                    </div>
                    <div class="caption pull-left">
                        <a data-dismiss="modal">
                            <i style="color: white" class="pull-left fa fa-closee"></i>
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

                                        <label>کد مستربچ
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="masterbatchc" name="masterbatchc"
                                               class="form-control"
                                               placeholder="لطفا کد مستربچ را وارد کنید"
                                               required>

                                    </div>

                                    <div class="col-md-12">

                                        <label>نام سازنده
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="masterbatchn" name="masterbatchn"
                                               class="form-control"
                                               placeholder="لطفا نام سازنده را وارد کنید"
                                               required>

                                    </div>


                                    <div class="col-md-12">

                                        <label>درصد ترکیب
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="combination" name="combination"
                                               class="form-control"
                                               placeholder="لطفا درصد ترکیب را وارد کنید"
                                               required>

                                    </div>

                                    <div class="col-md-12">

                                        <label>قیمت
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="price" name="price"
                                               class="form-control price"
                                               placeholder="لطفا قیمت را وارد کنید"
                                               required>

                                    </div>


                                    <div class="col-md-6">

                                        <label>حداقل
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="minimum" name="minimum" class="form-control"
                                               placeholder="لطفا حداقل را وارد کنید"
                                               required>

                                    </div>
                                    <div class="col-md-6">
                                        <label>حداکثر
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="maximum" name="maximum" class="form-control"
                                               placeholder="لطفا حداکثر را وارد کنید"
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


<div class="modal fade" id="ajax" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="modal-body col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            تعریف اطلاعات تولید
                        </div>
                        <div class="caption pull-left">
                            <a data-dismiss="modal">
                                <i style="color: white" class="pull-left fa fa-closee"></i>
                            </a>
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group">

                                <form autocomplete="off" id="productFormmmm" name="productFormmmm">

                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <label>نام:</label>
                                                    <input type="text" name="name" id="name" class="form-control">
                                                </div>

                                                <div class="col-md-4">
                                                    <label>مستربچ:</label>
                                                    <select name="mastarbach" id="mastarbach" class="form-control">
                                                        <option>انتخاب کنید...</option>
                                                        @foreach($colors as $color)

                                                            <option
                                                                value="{{$color->id}}">{{$color->manufacturer}} {{$color->masterbatch}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <div class="col-md-4">
                                                    <label>درصد ترکیب مستربچ:</label>
                                                    <input type="number" id="Percentmasterbatch" name="Percentmasterbatch" class="form-control">
                                                </div>


                                            </div>

                                            <br/>
                                            <div class="table table-responsive">
                                                <table
                                                    class="table table-responsive table-striped table-bordered">
                                                    <thead style="background-color: #e8ecff">
                                                    <tr>
                                                        <td>نام مواد</td>
                                                        <td>درصد ترکیب</td>
                                                        <td>عملیات</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody
                                                        id="TextBoxContainerbank">

                                                    <tr>
                                                        <td id="namee"></td>
                                                        <td id="darsad"></td>
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
                                            <button style="width: 130px" type="button" class="btn btn-success"
                                                    id="saveBtnn"
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
