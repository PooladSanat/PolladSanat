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
                                <input type="hidden" name="id" id="id">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">

                                        <label>موجودی فزیکی
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="number" id="PhysicalInventory" name="PhysicalInventory"
                                               class="form-control"
                                               placeholder="لطفا موجودی فزیکی را وارد کنید"
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

<div class="modal fade" id="ajax_new_product" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">

                    <div class="caption" id="caption">
                        ثبت برنامه جدید
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
                            <form autocomplete="off" id="Form_new_product" name="Form_new_product">
                                <input type="hidden" name="c" id="c">
                                <input type="hidden" name="p" id="p">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-3">

                                            <label>انتخاب محصول
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select disabled class="form-control" name="product_id" id="product_id">
                                                @foreach($products as $product)

                                                    <option value="{{$product->id}}">{{$product->label}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">

                                            <label>انتخاب رنگ
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select disabled class="form-control" name="color_id" id="color_id">
                                                @foreach($colors as $color)

                                                    <option value="{{$color->id}}">{{$color->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">

                                            <label>انتخاب ماشین
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select class="form-control" name="device_id" id="device_id">
                                                @foreach($devices as $device)

                                                    <option value="{{$device->id}}">{{$device->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">

                                            <label>انتخاب قالب
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select class="form-control" name="format_id" id="format_id">
                                                @foreach($formats as $format)

                                                    <option value="{{$format->id}}">{{$format->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">

                                            <label>انتخاب اینسرت
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select class="form-control" name="insert_id" id="insert_id">
                                                <option value="0">فاقد اینسرت</option>
                                                @foreach($inserts as $insert)
                                                    <option value="{{$insert->id}}">{{$insert->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">

                                            <label>کد مواد تولیدی
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select class="form-control" name="bach_id" id="bach_id">
                                                @foreach($informations as $information)

                                                    <option value="{{$information->id}}">{{$information->name}}</option>
                                                @endforeach
                                                <option value="0">ثبت مواد تولیدی جدید</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">

                                            <label>تعداد(عدد)
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <input value="0" class="form-control" type="number" name="number"
                                                   id="number">
                                        </div>
                                        <div class="col-md-2">

                                            <label>زمان تعویض قالب(دقیقه)
                                            </label>
                                            <input value="0" class="form-control" type="number" name="format_time"
                                                   id="format_time">
                                        </div>
                                        <div class="col-md-2">

                                            <label>زمان تعویض اینسرت(دقیقه)
                                            </label>
                                            <input value="0" class="form-control" type="number" name="insert_time"
                                                   id="insert_time">
                                        </div>
                                        <div class="col-md-2">

                                            <label>زمان تعویض رنگ(دقیقه)

                                            </label>
                                            <input value="0" class="form-control" type="number" name="color_time"
                                                   id="color_time">
                                        </div>
                                        <div class="col-md-2">

                                            <label>سایکل تایم(ثانیه)

                                            </label>
                                            <input value="0" class="form-control" type="number" name="stime"
                                                   id="stime">
                                        </div>
                                        <div class="col-md-12">
                                            <br/>
                                            <br/>
                                            <table class="table table-striped table-bordered dat-table-d"
                                                   id="dat-table-d">
                                                <thead style="background-color: #e6e6e6">
                                                <tr>
                                                    <th>ردیف</th>
                                                    <th>شماره برنامه</th>
                                                    <th>محصول</th>
                                                    <th>رنگ</th>
                                                    <th>تعداد</th>
                                                    <th>تاریخ شروع</th>
                                                    <th>تاریخ پایان</th>
                                                    <th>وضعیت</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <br/>
                                            <div style="display: none;border: 2px solid #dddddd"
                                                 class="panel panel-collapse" id="warning_mavad">
                                                <div class="panel-body">
                                                    <h5 class="panel-title">توضیحات موادهای مصرفی</h5>
                                                    <ul>
                                                        <br/>
                                                        <li style="display: none" id="warning_mavad11"><span
                                                                id="warning_mavad1"></span>
                                                        </li>
                                                        <li style="display: none" id="warning_mavad22"><span
                                                                id="warning_mavad2"></span>
                                                        </li>
                                                        <li style="display: none" id="warning_mavad33"><span
                                                                id="warning_mavad3"></span>
                                                        </li>

                                                        <li style="display: none" id="warning_mavad44"><span
                                                                id="warning_mavad4"></span>
                                                        </li>

                                                        <li style="display: none" id="warning_mavad55"><span
                                                                id="warning_mavad5"></span>
                                                        </li>

                                                        <li style="display: none" id="warning_mavad66"><span
                                                                id="warning_mavad6"></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="save_new_product" value="ثبت">
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

<div class="modal fade" id="ajax_device" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption_device">
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
                                <input type="hidden" name="id" id="id">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered data-table-device"
                                               id="data-table-device">
                                            <thead style="background-color: #e6e6e6">
                                            <tr>
                                                <th>ردیف</th>
                                                <th>شماره برنامه</th>
                                                <th>محصول</th>
                                                <th>رنگ</th>
                                                <th>تعداد</th>
                                                <th>زمان شروع</th>
                                                <th>زمان پایان</th>
                                                <th>وضعیت QC</th>
                                                <th>وضعیت</th>
                                                <th>عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tablecontents">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="button" class="btn btn-danger"
                                                data-dismiss="modal">
                                            بستن
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

<div class="modal fade" id="ajax_date" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">

                    <div class="caption" id="device">
                        ثبت تاریخ شروع
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

                            <form autocomplete="off" id="Form_date" name="Form_date" class="form-horizontal">
                                <input type="hidden" name="id_date" id="id_date">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>تاریخ شروع تولید
                                                </label>
                                                <input type="text" name="created" id="created" class="form-control">
                                            </div>

                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>زمان شروع تولید
                                                </label>
                                                <input type="text" name="time_date" id="time_date" class="form-control">
                                            </div>

                                        </div>


                                    </div>


                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveBtn_date" value="ثبت">
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
                                                    <select name="mastarbach" id="mastarbachhhh" class="form-control">
                                                        <option>انتخاب کنید...</option>
                                                        @foreach($colors as $color)

                                                            <option
                                                                value="{{$color->id}}">{{$color->manufacturer}} {{$color->masterbatch}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>درصد مستربچ:</label>
                                                    <input type="number" name="Percentmasterbatch"
                                                           id="Percentmasterbatch" class="form-control">
                                                </div>


                                            </div>

                                            <br/>
                                            <div class="table table-responsive">
                                                <table
                                                    class="table table-responsive table-striped table-bordered">
                                                    <thead style="background-color: #e6e6e6">
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

<div class="modal fade" id="product_change" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">

                    <div class="caption" id="caption">
                        ویرایش برنامه
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

                            <form autocomplete="off" id="Form_edit_product" name="Form_edit_product">

                                <input type="hidden" name="edit_id" id="edit_id">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-5">

                                        </div>
                                        <div class="col-md-2">

                                            <label>انتخاب ماشین
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select class="form-control" name="device_idd" id="device_idd">
                                                @foreach($devices as $device)

                                                    <option value="{{$device->id}}">{{$device->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-md-12">
                                            <br/>
                                            <br/>
                                            <table class="table table-striped table-bordered dat-table-change"
                                                   id="dat-table-change">
                                                <thead style="background-color: #e6e6e6">
                                                <tr>
                                                    <th>ردیف</th>
                                                    <th>شماره برنامه</th>
                                                    <th>محصول</th>
                                                    <th>رنگ</th>
                                                    <th>تعداد</th>
                                                    <th>تاریخ شروع</th>
                                                    <th>تاریخ پایان</th>
                                                    <th>وضعیت</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>

                                </div>

                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="edit_new_product" value="ثبت">
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

<div class="modal fade" id="ajax_product_edit" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">

                    <div class="caption" id="caption">
                        ویرایش برنامه
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
                            <form autocomplete="off" id="Form_ediit_product" name="Form_ediit_product">
                                <input type="hidden" name="i" id="i">
                                <input type="hidden" name="c" id="cc">
                                <input type="hidden" name="p" id="pp">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-md-3">

                                            <label>انتخاب محصول
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select disabled class="form-control" name="product_ids" id="product_ids">
                                                @foreach($products as $product)

                                                    <option value="{{$product->id}}">{{$product->label}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">

                                            <label>انتخاب رنگ
                                                <span
                                                    style=" color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select disabled class="form-control" name="color_iidd" id="color_iidd">
                                                @foreach($colors as $color)

                                                    <option value="{{$color->id}}">{{$color->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">

                                            <label>انتخاب ماشین
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select class="form-control" name="device_idds" id="device_idds">
                                                @foreach($devices as $device)

                                                    <option value="{{$device->id}}">{{$device->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">

                                            <label>انتخاب قالب
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select class="form-control" name="format_iid" id="format_iid">
                                                @foreach($formats as $format)

                                                    <option value="{{$format->id}}">{{$format->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">

                                            <label>انتخاب اینسرت
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select class="form-control" name="insert_iid" id="insert_iid">
                                                <option value="0">فاقد اینسرت</option>
                                                @foreach($inserts as $insert)
                                                    <option value="{{$insert->id}}">{{$insert->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">

                                            <label>کد مواد تولیدی
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <select class="form-control" name="bach_iid" id="bach_iid">
                                                @foreach($informations as $information)

                                                    <option value="{{$information->id}}">{{$information->name}}</option>
                                                @endforeach
                                                <option value="0">ثبت مواد تولیدی جدید</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">

                                            <label>تعداد(عدد)
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <input value="0" class="form-control" type="number" name="numbeerr"
                                                   id="numbeerr">
                                        </div>

                                        <div class="col-md-2">

                                            <label>زمان تعویض قالب(دقیقه)
                                            </label>
                                            <input value="0" class="form-control" type="number" name="format_timee"
                                                   id="format_timee">
                                        </div>

                                        <div class="col-md-2">

                                            <label>زمان تعویض اینسرت(دقیقه)
                                            </label>
                                            <input value="0" class="form-control" type="number" name="insert_timee"
                                                   id="insert_timee">
                                        </div>

                                        <div class="col-md-2">

                                            <label>زمان تعویض رنگ(دقیقه)

                                            </label>
                                            <input value="0" class="form-control" type="number" name="color_timee"
                                                   id="color_timee">
                                        </div>

                                        <div class="col-md-2">

                                            <label>سایکل تایم(ثانیه)

                                            </label>
                                            <input value="0" class="form-control" type="number" name="stimee"
                                                   id="stimee">
                                        </div>

                                        <div class="col-md-12">
                                            <br/>
                                            <br/>
                                            <table class="table table-striped table-bordered dat-table-d-e"
                                                   id="dat-table-d-e">
                                                <thead style="background-color: #e6e6e6">
                                                <tr>
                                                    <th>ردیف</th>
                                                    <th>شماره برنامه</th>
                                                    <th>محصول</th>
                                                    <th>رنگ</th>
                                                    <th>تعداد</th>
                                                    <th>تاریخ شروع</th>
                                                    <th>تاریخ پایان</th>
                                                    <th>وضعیت</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            <br/>
                                            <div style="display: none;border: 2px solid #dddddd"
                                                 class="panel panel-collapse" id="warning_mavadd">
                                                <div class="panel-body">
                                                    <h5 class="panel-title">توضیحات موادهای مصرفی</h5>
                                                    <ul>
                                                        <br/>
                                                        <li style="display: none" id="warning_mavad111"><span
                                                                id="warning_mavad1111"></span>
                                                        </li>
                                                        <li style="display: none" id="warning_mavad222"><span
                                                                id="warning_mavad2222"></span>
                                                        </li>
                                                        <li style="display: none" id="warning_mavad333"><span
                                                                id="warning_mavad3333"></span>
                                                        </li>

                                                        <li style="display: none" id="warning_mavad444"><span
                                                                id="warning_mavad4444"></span>
                                                        </li>

                                                        <li style="display: none" id="warning_mavad555"><span
                                                                id="warning_mavad5555"></span>
                                                        </li>

                                                        <li style="display: none" id="warning_mavad666"><span
                                                                id="warning_mavad6666"></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="save_edit_product" value="ثبت">
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

