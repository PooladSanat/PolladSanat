<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        درخواست وجه
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
                                <input type="hidden" name="p" id="p">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">

                                        <label>مشتری
                                        </label>
                                        <select class="form-control" name="customer_i" id="customer_i">
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="col-md-6">
                                            <span>حساب مشتری:<span id="hesab"></span></span>
                                        </div>

                                    </div>

                                    <div class="col-md-12">

                                        <label>مبلغ درخواستی
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="price" name="price" class="form-control"
                                               placeholder="مبلغ درخواستی مشتری"
                                               required>

                                    </div>

                                    <div class="col-md-12">

                                        <label>اولویت
                                        </label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">بسیار مهم</option>
                                            <option value="2">مهم</option>
                                            <option value="3">عادی</option>
                                        </select>

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


<div class="modal fade" id="success" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        درخواست وجه
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

                            <form autocomplete="off" id="productFo" name="productFo" class="form-horizontal">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">

                                        <label>وضعیت
                                        </label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">تایید پرداخت</option>
                                            <option value="2">عدم تایید</option>
                                        </select>

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

                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="savesuccess" value="ثبت">
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
