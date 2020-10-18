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
                                <input type="hidden" name="commodity_id" id="commodity_id">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">

                                        <label>کد محصول
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="code" name="code" class="form-control"
                                               placeholder="لطفا کد محصول را وارد کنید"
                                               required>

                                    </div>
                                    <div class="col-md-12">

                                        <label>گروه کالا
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control"
                                                name="commodity_id"
                                                id="commodity"
                                                required>
                                            <option>لطفا گروه کالا را انتخاب کنید</option>
                                            @foreach($commoditys as $commodity)
                                                @if(!empty($commodity))
                                                    <option
                                                        value="{{$commodity->id}}">{{$commodity->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-12">

                                        <label for="title">مشخصه محصول
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="characteristic" id="characteristic"
                                                class="form-control">
                                        </select>

                                    </div>
                                    <div class="col-md-12">

                                        <label>نام محصول
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder="لطفا نام محصول را وارد کنید"
                                               required>

                                    </div>
                                    <div class="col-md-12">

                                        <label for="title">نوع تهیه
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="manufacturing" id="manufacturing"
                                                class="form-control">
                                            <option value="1">داخلی</option>
                                            <option value="2">خارجی</option>
                                        </select>

                                    </div>
                                    <div class="col-md-12">

                                        <label>قیمت محصول
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="price" name="price" class="form-control price"
                                               placeholder="لطفا قیمت محصول را وارد کنید"
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

