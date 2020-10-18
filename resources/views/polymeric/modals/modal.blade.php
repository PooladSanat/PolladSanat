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
                                <input type="hidden" name="product" id="product">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">

                                        <label>کد
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="code" name="code" class="form-control"
                                               placeholder="لطفا کد مواد را وارد کنید"
                                               required>

                                    </div>
                                    <div class="col-md-12">

                                        <label>نوع مواد
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="type" name="type" class="form-control"
                                               placeholder="لطفا نوع مواد را وارد کنید"
                                               required>

                                    </div>
                                    <div class="col-md-12">

                                        <label>نام گرید مواد
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="grid" name="grid" class="form-control"
                                               placeholder="لطفا نام گرید مواد را وارد کنید"
                                               required>

                                    </div>
                                    <div class="col-md-12">

                                        <label>نام سازنده
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>

                                        <select class="form-control" name="name" id="name">
                                            @foreach($sellers as $seller)
                                                <option value="{{$seller->id}}">{{$seller->company}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-12">

                                        <label>قیمت
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="price" name="price" class="form-control price"
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


                                    <div class="col-md-12">

                                        <label>توضیحات</label>
                                        <textarea id="description" name="description" class="form-control" rows="4"
                                                  cols="50" placeholder="متن خود را وارد کنید">
                                                </textarea>

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

