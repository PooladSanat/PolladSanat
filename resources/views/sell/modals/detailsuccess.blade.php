<div class="modal fade" id="successdetailModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        ارسال سفارش به صف برنامه ریزی
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

                            <form autocomplete="off" id="successdetailinvoices" name="successdetailinvoices"
                                  class="form-horizontal">
                                <input type="hidden" name="invoice_product" id="invoice_product">
                                @csrf
                                <div id="alertdetail" style="display: none" class="alert alert-danger" role="alert">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>زمان تحویل مورد نیاز
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="date" name="date" class="form-control example1"
                                               required>

                                    </div>
                                    {{--                                    <div class="col-md-12">--}}
                                    {{--                                        <label>شرایط مورد نیاز تولید--}}
                                    {{--                                            <span--}}
                                    {{--                                                style="color: red"--}}
                                    {{--                                                class="required-mark">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <select class="form-control" name="Productionconditions" id="Productionconditions">--}}
                                    {{--                                            <option value="1">تولید</option>--}}
                                    {{--                                        </select>--}}

                                    {{--                                    </div>--}}

                                    {{--                                    <div class="col-md-12">--}}
                                    {{--                                        <label>حساسیت مشتری--}}
                                    {{--                                            <span--}}
                                    {{--                                                style="color: red"--}}
                                    {{--                                                class="required-mark">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <select class="form-control" name="Priority" id="Priority">--}}
                                    {{--                                            <option value="1">حساس</option>--}}
                                    {{--                                            <option value="2">عادی</option>--}}
                                    {{--                                        </select>--}}

                                    {{--                                    </div>--}}
                                    {{--                                    <div class="col-md-12">--}}
                                    {{--                                        <label>سابقه تولید--}}
                                    {{--                                            <span--}}
                                    {{--                                                style="color: red"--}}
                                    {{--                                                class="required-mark">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <select class="form-control" name="history" id="history">--}}
                                    {{--                                            <option value="1">دارد</option>--}}
                                    {{--                                            <option value="2">ندارد</option>--}}
                                    {{--                                        </select>--}}

                                    {{--                                    </div>--}}
                                    {{--                                    <div class="col-md-12">--}}
                                    {{--                                        <label>نمونه تایید شده--}}
                                    {{--                                            <span--}}
                                    {{--                                                style="color: red"--}}
                                    {{--                                                class="required-mark">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <select class="form-control" name="Sample" id="Sample">--}}
                                    {{--                                            <option value="1">دارد</option>--}}
                                    {{--                                            <option value="2">ندارد</option>--}}
                                    {{--                                        </select>--}}

                                    {{--                                    </div>--}}


                                    <div class="col-md-12">
                                        <label>تعداد تولید مجاز
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="number" id="number" name="number" class="form-control"
                                               required>

                                    </div>

                                    {{--                                    <div class="col-md-12">--}}
                                    {{--                                        <label>تعداد تولید شده--}}
                                    {{--                                            <span--}}
                                    {{--                                                style="color: red"--}}
                                    {{--                                                class="required-mark">*</span>--}}
                                    {{--                                        </label>--}}
                                    {{--                                        <input type="number" id="numberr" name="numberr" class="form-control"--}}
                                    {{--                                               disabled--}}
                                    {{--                                               required>--}}

                                    {{--                                    </div>--}}


                                    <div class="col-md-12">

                                        <label>توضیحات
                                        </label>
                                        <textarea name="description" id="description" rows="5"
                                                  class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>

                                    </div>


                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveToListd" value="ثبت">
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


<div class="modal fade" id="schedulingModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        ارسال برای بارگیری
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

                            <form autocomplete="off" id="schedulingform" name="schedulingform"
                                  class="form-horizontal">
                                <input type="hidden" name="scheduling" id="scheduling">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <label>مقدار بارگیری
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="number" id="number" name="number" class="form-control"
                                               required>

                                    </div>

                                    <div class="col-md-12">
                                        <label>نوع وسیله
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="type" id="type" class="form-control">
                                            <option>سواری</option>
                                            <option>وانت</option>
                                        </select>

                                    </div>

                                    <div class="col-md-12">
                                        <label>حمل از طرف
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="Carry" id="Carry" class="form-control">
                                            <option>پولاد صنعت</option>
                                            <option>مشتری</option>
                                        </select>

                                    </div>


                                    <div class="col-md-12">
                                        <label>تاریخ حمل
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="date" name="date" class="form-control example1"
                                               required>

                                    </div>

                                    <div class="col-md-12">
                                        <label>زمان حمل
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="time" id="time" class="form-control">
                                            <option>صبح</option>
                                            <option>ظهر</option>
                                            <option>عصر</option>
                                            <option>شب</option>
                                        </select>

                                    </div>


                                    <div class="col-md-12">
                                        <label>توضیحات
                                        </label>
                                        <textarea name="description" id="description" rows="5"
                                                  class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>
                                    </div>
                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveToscheduling" value="ثبت">
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







