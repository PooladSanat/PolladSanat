<div class="modal fade" id="add1" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title ">
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
                            <div style="display: none" id="alert_error" class="alert alert-error">
                                <strong> خطا! </strong><label id="text_error"></label>
                            </div>
                            <div style="display: none" id="alert_success" class="alert alert-success">
                                <strong> موفق! </strong><label id="text_success"></label>
                            </div>
                            <div style="display: none" id="alert_warning" class="alert alert-warning">
                                <strong> اخطار! </strong><label id="text_warning"></label>
                            </div>

                            <table class="table table-striped table-bordered detail_add" id="detail_add">
                                <thead style="background-color: #e8ecff">
                                <tr>
                                    <th>تعداد تولید قابل مصرف</th>
                                    <th>ضایعات قابل مصرف</th>
                                    <th>ضایعات غیر قابل مصرف</th>
                                    <th>سایکل تایم</th>
                                    <th>ثبت کننده</th>
                                    <th>تاریخ</th>
                                    <th>زمان</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br/>
                            <hr/>
                            <form autocomplete="off" id="productForm" name="productForm" class="form-horizontal">
                                <input type="hidden" name="order_id" id="order_id">
                                <input type="hidden" name="id" id="id">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">

                                        <label>تعداد تولید سالم
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="number" id="production" name="production" class="form-control"
                                               placeholder="لطفا تعداد تولید سالم را وارد کنید"
                                               required>
                                    </div>

                                    <div class="col-md-3">
                                        <label>ضایعات قابل مصرف
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="number" id="usable" name="usable"
                                               class="form-control"
                                               placeholder="لطفا ضایعات قابل مصرف را وارد کنید"
                                               required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>ضایعات غیر قابل مصرف
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="number" id="unusable" name="unusable" class="form-control"
                                               placeholder="لطفا ضایعات غیر قابل مصرف را وارد کنید"
                                               required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>سایکل تایم
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="number" id="cycletime" name="cycletime" class="form-control"
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
<div class="modal fade" id="stop1" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title ">
                    <div class="caption" id="caption1">
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
                            <table class="table table-striped table-bordered detail_stop1" id="detail_stop1">
                                <thead style="background-color: #e8ecff">
                                <tr>
                                    <th>زمان توقف(دقیقه)</th>
                                    <th>ثبت کننده</th>
                                    <th>نوع توقف</th>
                                    <th>دلیل توقف</th>
                                    <th>قالب نصب شده</th>
                                    <th>insert</th>
                                    <th>توضیحات</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <br/>
                            <hr/>
                            <form autocomplete="off" id="updateform" name="updateform" class="form-horizontal">
                                <input type="hidden" name="order_id_stop" id="order_id_stop">
                                <input type="hidden" name="idd" id="idd">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">

                                        <label>تاریخ شروع
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="date" name="date"
                                               class="form-control example1"
                                               placeholder="لطفا تعداد تولید سالم را وارد کنید"
                                               required>
                                    </div>

                                    <div class="col-md-3">
                                        <label>تاریخ پایان
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="todate" name="todate"
                                               class="form-control example1"
                                               placeholder="لطفا ضایعات قابل مصرف را وارد کنید"
                                               required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>از ساعت
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="time" name="time" class="form-control"
                                               placeholder="لطفا ساعت شروع توقف را وارد کنید"
                                               required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>تا ساعت
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="totime" name="totime" class="form-control"
                                               placeholder="لطفا ساعت پایان توقف را وارد کنید"
                                               required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>نوع توقف
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" id="reason" name="reason">
                                            <option value="1">توقف فروش</option>
                                            <option value="2">توقف فنی</option>
                                            <option value="3">توقف غیر فنی</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>دلیل توقف
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" id="type" name="type">

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>قالب نصب شده
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" id="format" name="format">
                                            <option value="0">-----</option>
                                            @foreach($formats as $format)
                                                <option value="{{$format->id}}">{{$format->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Insert نصب شده
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" id="insert" name="insert">
                                            <option value="0">-----</option>
                                            @foreach($inserts as $insert)
                                                <option value="{{$insert->id}}">{{$insert->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label>توضیحات
                                        </label>
                                        <textarea id="description" name="description" class="form-control"
                                                  placeholder="لطفا توضیحات خود را وارد کنید">

                                       </textarea>
                                    </div>


                                </div>

                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="updateBtn" value="ثبت">
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

