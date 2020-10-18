<div class="modal fade" id="newmodel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        ثبت اقدام جدید برای شکایت
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

                            <form autocomplete="off" id="newform" name="newform"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="id_com" id="id_com">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <label>مخاطب
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>

                                                <select dir="rtl" id="Audience" class="form-control"
                                                        name="Audience[]" multiple
                                                        required>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label>رونوشت گیرنده
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>


                                                <select dir="rtl" id="Copy" class="form-control"
                                                        name="Copy[]" multiple
                                                        required>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label>عملیات
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select class="form-control" name="operation" id="operation">
                                                    <option>انتخاب کنید</option>
                                                    <option value="ثبت درخواست">ثبت درخواست</option>
                                                    <option value="پاسخ به درخواست">پاسخ به درخواست</option>
                                                    <option value="درخواست جلسه">درخواست جلسه</option>
                                                    <option value="جلسه حضوری">جلسه حضوری</option>
                                                    <option value="اعلام نتایج جلسه">اعلام نتایج جلسه</option>
                                                    <option value="اعلام نتایج اقدامات">اعلام نتایج اقدامات</option>
                                                    <option value="اعلام به مشتری">اعلام به مشتری</option>
                                                    <option value="دریافت پاسخ مشتری">دریافت پاسخ مشتری</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label>میزان فوریت
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select class="form-control" name="Urgency" id="Urgency">
                                                    <option>انتخاب کنید</option>
                                                    <option value="معمولی">معمولی</option>
                                                    <option value="فوری">فوری</option>
                                                    <option value="بسیار فوری">بسیار فوری</option>
                                                </select>
                                            </div>

                                            <div class="col-md-12">

                                                <label>توضیحات
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <textarea id="descriptiond"
                                                          placeholder="لطفا توضیحات خود را وارد کنید"
                                                          name="descriptiond" class="form-control">

                                                    </textarea>


                                            </div>

                                        </div>
                                        <br/>
                                        <br/>
                                        <div class="table table-responsive">
                                            <table
                                                class="table table-responsive table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <td>عنوان</td>
                                                    <td>فایل پیوست</td>
                                                    <td>عملیات</td>
                                                </tr>
                                                </thead>
                                                <tbody
                                                    id="TextBoxContainerbank">

                                                <tr>
                                                    <td id="titlee"></td>
                                                    <td id="filee"></td>
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
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="newbtn"
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

<div class="modal fade" id="newmoddel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        فایلهای پیوست
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
                            <div class="row">
                                <div class="hello" id='TextBoxesGroup'>
                                    <div id="TextBoxDiv1">

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="newmoddell" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        توضحیات
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
                            <div class="row">
                                 <textarea id="description"
                                           disabled
                                           name="description" class="form-control"
                                           rows="12" cols="150">
                                 </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
