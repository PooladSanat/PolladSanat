<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        انتصاب محصول به قالب
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
                                <input type="hidden" name="product" id="product">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">


                                        <label for="title">قالب
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="format_id" id="format_id"
                                                class="form-control">
                                            @foreach($formats as $format)
                                                <option value="{{$format->id}}">{{$format->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="title">insert
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="insert_id" id="insert_id"
                                                class="form-control">
                                            @foreach($inserts as $insert)
                                                <option value="{{$insert->id}}">{{$insert->name}}</option>
                                            @endforeach
                                            <option value="{{null}}">فاقد اینسرت</option>
                                        </select>
                                    </div>


                                    <div class="col-md-12">
                                        <label for="title">محصول
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="product_id" id="product_id"
                                                class="form-control">
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->label}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-md-12">
                                        <label>وزن
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="size" name="size" class="form-control"
                                               placeholder="لطفا وزن را وارد کنید"
                                               required>
                                    </div>

                                    <div class="col-md-12">
                                        <label>سایکل تایم
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="cycletime" name="cycletime" class="form-control"
                                               placeholder="لطفا سایکل تایم را وارد کنید"
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
