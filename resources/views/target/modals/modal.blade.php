<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
            <div class="modal-body col-md-12">
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
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="year" id="year" value="{{$year->year}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-2">

                                                <label>تعداد فروردین
                                                </label>
                                                <input type="text" id="farvardin" name="farvardin" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
                                                       required>

                                        </div>
                                        <div class="col-md-2">

                                                <label>تعداد اردیبهشت
                                                </label>
                                                <input type="text" id="may" name="may" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
                                                       required>
                                            </div>

                                        <div class="col-md-2">

                                                <label>تعداد خرداد
                                                </label>
                                                <input type="text" id="June" name="June" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
                                                       required>
                                            </div>

                                        <div class="col-md-2">

                                                <label>تعداد تیر
                                                </label>
                                                <input type="text" id="Arrows" name="Arrows" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
                                                       required>

                                        </div>
                                        <div class="col-md-2">

                                                <label>تعداد مرداد
                                                </label>
                                                <input type="text" id="August" name="August" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
                                                       required>

                                        </div>
                                        <div class="col-md-2">

                                                <label>تعداد شهریور
                                                </label>
                                                <input type="text" id="September" name="September" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
                                                       required>

                                        </div>
                                        <div class="col-md-2">

                                                <label>تعداد مهر
                                                </label>
                                                <input type="text" id="stamp" name="stamp" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
                                                       required>

                                        </div>
                                        <div class="col-md-2">

                                                <label>تعداد آبان
                                                </label>
                                                <input type="text" id="Aban" name="Aban" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
                                                       required>

                                        </div>
                                        <div class="col-md-2">

                                                <label>تعداد آذر
                                                </label>
                                                <input type="text" id="Fire" name="Fire" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
                                                       required>

                                        </div>
                                        <div class="col-md-2">

                                                <label>تعداد دی
                                                </label>
                                                <input type="text" id="January" name="January" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
                                                       required>

                                        </div>
                                        <div class="col-md-2">

                                                <label>تعداد بهمن
                                                </label>
                                                <input type="text" id="Avalanche" name="Avalanche" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
                                                       required>

                                        </div>
                                        <div class="col-md-2">

                                                <label>تعداد اسفند

                                                </label>
                                                <input type="text" id="March" name="March" class="form-control"
                                                       placeholder="لطفا تعداد را وارد کنید"
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

