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

                                    <div class="col-md-12">

                                        <label>رنگ
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" name="color" id="color">
                                            @foreach($colors as $color)
                                                <option value="{{$color->id}}">{{$color->name}}</option>
                                            @endforeach
                                        </select>

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

