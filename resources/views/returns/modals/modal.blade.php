<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="modal-body col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            تعریف مرجوعی جدید
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
                                <form autocomplete="off" id="productForm" name="productForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <label>مشتری:</label>
                                                    <select name="customer_id" id="customer_id"
                                                            class="form-control">
                                                        <option>انتخاب کنید...</option>
                                                        @foreach($customers as $customer)
                                                            <option
                                                                value="{{$customer->id}}">{{$customer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>هزینه حمل:</label>
                                                    <select name="Carry" id="Carry"
                                                            class="form-control">
                                                        <option value="پولاد پویش">پولاد پویش</option>
                                                        <option value="مشتری">مشتری</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>تاریخ مرجوع:</label>
                                                    <input type="text" name="date" id="date" class="form-control">
                                                </div>


                                                <div class="col-md-6">
                                                    <label> دلایل مشتری جهت عودت محصول:</label>
                                                    <textarea name="description_m" id="description_m"
                                                              placeholder="لطفا  دلایل مشتری جهت عودت محصول را وارد کنید"
                                                              class="form-control"
                                                              rows="2" cols="50">
                                                    </textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label>دلایل واحد فروش جهت پذیرش:</label>
                                                    <textarea name="description_f" id="description_f"
                                                              placeholder="لطفا دلایل واحد فروش جهت پذیرش خود را وارد کنید"
                                                              class="form-control"
                                                              rows="2" cols="50">
                                                    </textarea>
                                                </div>


                                            </div>

                                            <br/>
                                            <div class="table table-responsive">
                                                <table
                                                    class="table table-responsive table-striped table-bordered">
                                                    <thead style="background-color: #e8ecff">
                                                    <tr>
                                                        <td>فاکتور</td>
                                                        <td>محصول</td>
                                                        <td>رنگ</td>
                                                        <td>تعداد کل</td>
                                                        <td>تعداد مرجوع شده</td>
                                                        <td>دلیل مشتری</td>
                                                        <td>عملیات</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody
                                                        id="TextBoxContainerbank">

                                                    <tr>
                                                        <td id="invoicee"></td>
                                                        <td id="productt"></td>
                                                        <td id="colorr"></td>
                                                        <td id="totalnumberr"></td>
                                                        <td id="numberr"></td>
                                                        <td id="reasonss"></td>
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
                                                    id="saveBtn"
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

<div class="modal fade" id="editajaxModel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="modal-body col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            ویرایش مرجوعی
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

                                <form autocomplete="off" id="productFormm" name="productFormm">
                                    <input type="hidden" id="id_returns" name="id_returns">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">


                                                <div class="col-md-4">
                                                    <label>مشتری:</label>
                                                    <select name="customer_idd" id="customer_idd"
                                                            class="form-control">
                                                        <option>انتخاب کنید...</option>
                                                        @foreach($customers as $customer)
                                                            <option
                                                                value="{{$customer->id}}">{{$customer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>هزینه حمل:</label>
                                                    <select name="Carryy" id="Carryy"
                                                            class="form-control">
                                                        <option value="پولاد پویش">پولاد پویش</option>
                                                        <option value="مشتری">مشتری</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>تاریخ مرجوع:</label>
                                                    <input type="text" name="datee" id="datee" class="form-control">
                                                </div>


                                                <div class="col-md-6">
                                                    <label> دلایل مشتری جهت عودت محصول:</label>
                                                    <textarea name="description_mm" id="description_mm"
                                                              placeholder="لطفا  دلایل مشتری جهت عودت محصول را وارد کنید"
                                                              class="form-control"
                                                              rows="2" cols="50">
                                                    </textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label>دلایل واحد فروش جهت پذیرش:</label>
                                                    <textarea name="description_ff" id="description_ff"
                                                              placeholder="لطفا دلایل واحد فروش جهت پذیرش خود را وارد کنید"
                                                              class="form-control"
                                                              rows="2" cols="50">
                                                    </textarea>
                                                </div>


                                            </div>

                                            <br/>
                                            <div class="table table-responsive">
                                                <table
                                                    class="table table-responsive table-striped table-bordered">
                                                    <thead style="background-color: #e8ecff">
                                                    <tr>
                                                        <td>فاکتور</td>
                                                        <td>محصول</td>
                                                        <td>رنگ</td>
                                                        <td>تعداد کل</td>
                                                        <td>تعداد مرجوع شده</td>
                                                        <td>دلیل مشتری</td>
                                                        <td>عملیات</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody
                                                        id="TextBoxContainerbank">

                                                    <tr>
                                                        <td id="invoice_"></td>
                                                        <td id="product_"></td>
                                                        <td id="color_"></td>
                                                        <td id="totalnumber_"></td>
                                                        <td id="number_"></td>
                                                        <td id="reasons_"></td>
                                                        <td id="actionttttt"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <hr/>
                                    <div class="modal-footer">
                                        <div class="text-left">
                                            <button style="width: 130px" type="button" class="btn btn-success"
                                                    id="savebtnupdate"
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

<div class="modal fade" id="qcmodel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="modal-body col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            نظر QC
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

                                <form autocomplete="off" id="productFor" name="productFor">
                                    <input type="hidden" id="id_id" name="id_id">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>مشتری:</label>
                                                    <select readonly name="customer_id" id="customerr_id"
                                                            class="form-control">
                                                        <option>انتخاب کنید...</option>
                                                        @foreach($customers as $customer)
                                                            <option
                                                                value="{{$customer->id}}">{{$customer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-9">
                                                    <label>توضیحات:</label>
                                                    <textarea readonly name="description" id="descriptiuon"
                                                              placeholder="لطفا توضیحات خود را وارد کنید"
                                                              class="form-control"
                                                              rows="1" cols="50">
                                                    </textarea>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="table table-responsive">
                                                <table
                                                    class="table table-responsive table-striped table-bordered">
                                                    <thead style="background-color: #e8ecff">
                                                    <tr style="background-color: rgba(0,183,255,0.16)">
                                                        <td>فاکتور</td>
                                                        <td>محصول</td>
                                                        <td>رنگ</td>
                                                        <td>تعداد کل مرجوعی</td>
                                                        <td>تعداد معیوب(مشتری)</td>
                                                        <td>تعداد معیوب(پولاد)</td>
                                                        <td>تعداد سالم</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody
                                                        id="TextBoxContainer">

                                                    <tr>
                                                        <td id="invoiceee"></td>
                                                        <td id="producttt"></td>
                                                        <td id="colorrr"></td>
                                                        <td id="numberrr"></td>
                                                        <td id="mm"></td>
                                                        <td id="sss"></td>
                                                        <td id="ss"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>توضیحات:</label>
                                                    <textarea name="descriptionq" id="descriptionq"
                                                              placeholder="لطفا توضیحات خود را وارد کنید"
                                                              class="form-control"
                                                              rows="5" cols="20">
                                                    </textarea>
                                                </div>


                                            </div>


                                        </div>
                                    </div>
                                    <br/>
                                    <hr/>
                                    <div class="modal-footer">
                                        <div class="text-left">
                                            <button style="width: 130px" type="button" class="btn btn-success"
                                                    id="savea"
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

<div class="modal fade" id="chatdd" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        سابقه گفتگو
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

                            <form autocomplete="off" id="productFor" name="productFor">
                                <input type="hidden" id="id_id" name="id_id">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="box-body">
                                            <!-- Conversations are loaded here -->
                                            <div class="direct-chat-messages">
                                                <!-- Message. Default to the left -->
                                                <div class="direct-chat-msg">
                                                    <div class="direct-chat-info clearfix">
                                                        <span id="name_fo" class="direct-chat-name pull-right"></span>
                                                        <span id="time_fo"
                                                              class="direct-chat-timestamp pull-left"></span>
                                                    </div>
                                                    <!-- /.direct-chat-info -->
                                                    <img class="direct-chat-img"
                                                         src="{{url('/public/icon/Blank-Avatar-Man-in-Suit.jpg')}}"
                                                         alt="message user image">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text">
                                                        <span id="txt_fo"></span>
                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>
                                                <!-- /.direct-chat-msg -->

                                                <!-- Message to the right -->
                                                <div class="direct-chat-msg right">
                                                    <div class="direct-chat-info clearfix">
                                                        <span id="name_mfo"
                                                              class="direct-chat-name pull-right"></span>
                                                        <span id="time_mfo"
                                                              class="direct-chat-timestamp pull-left"></span>
                                                    </div>
                                                    <!-- /.direct-chat-info -->
                                                    <img class="direct-chat-img"
                                                         src="{{url('/public/icon/Blank-Avatar-Man-in-Suit.jpg')}}"
                                                         alt="message user image">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text">
                                                        <span id="txt_mfo"></span>
                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>

                                                <div class="direct-chat-msg">
                                                    <div class="direct-chat-info clearfix">
                                                        <span id="name_mo" class="direct-chat-name pull-right"></span>
                                                        <span id="time_mo"
                                                              class="direct-chat-timestamp pull-left"></span>
                                                    </div>
                                                    <!-- /.direct-chat-info -->
                                                    <img class="direct-chat-img"
                                                         src="{{url('/public/icon/Blank-Avatar-Man-in-Suit.jpg')}}"
                                                         alt="message user image">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text">
                                                        <span id="txt_mo"></span>
                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>

                                                <div class="direct-chat-msg">
                                                    <div class="direct-chat-info clearfix">
                                                        <span id="name_a" class="direct-chat-name pull-right"></span>
                                                        <span id="time_a"
                                                              class="direct-chat-timestamp pull-left"></span>
                                                    </div>
                                                    <!-- /.direct-chat-info -->
                                                    <img class="direct-chat-img"
                                                         src="{{url('/public/icon/Blank-Avatar-Man-in-Suit.jpg')}}"
                                                         alt="message user image">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text">
                                                        <span id="txt_a"></span>
                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>

                                                <div class="direct-chat-msg">
                                                    <div class="direct-chat-info clearfix">
                                                        <span id="name_q" class="direct-chat-name pull-right"></span>
                                                        <span id="time_q"
                                                              class="direct-chat-timestamp pull-left"></span>
                                                    </div>
                                                    <!-- /.direct-chat-info -->
                                                    <img class="direct-chat-img"
                                                         src="{{url('/public/icon/Blank-Avatar-Man-in-Suit.jpg')}}"
                                                         alt="message user image">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text">
                                                        <span id="txt_q"></span>
                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>

                                                <div class="direct-chat-msg">
                                                    <div class="direct-chat-info clearfix">
                                                        <span id="name_aa" class="direct-chat-name pull-right"></span>
                                                        <span id="time_aa"
                                                              class="direct-chat-timestamp pull-left"></span>
                                                    </div>
                                                    <!-- /.direct-chat-info -->
                                                    <img class="direct-chat-img"
                                                         src="{{url('/public/icon/Blank-Avatar-Man-in-Suit.jpg')}}"
                                                         alt="message user image">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text">
                                                        <span id="txt_aa"></span>
                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>


                                            </div>
                                            <!--/.direct-chat-messages-->


                                        </div>


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

<div class="modal fade" id="user_" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        نظر مدیر فروش
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

                            <form autocomplete="off" id="userform" name="userform">
                                <input type="hidden" id="id_" name="id_">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">

                                        <table class="table table-striped table-bordered dateeeee" id="dateeeee">
                                            <thead style="background-color: #e8ecff">
                                            <tr>
                                                <td style="width: 1px">شماره فاکتور</td>
                                                <td>فروشنده</td>
                                                <td>خریدار</td>
                                                <td>محصول</td>
                                                <td>رنگ</td>
                                                <td>تعداد مرجوعی</td>
                                                <td>تاریخ</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>وضعیت:</label>
                                                <select name="statusu" id="statusu" class="form-control">
                                                    <option value="1">تایید</option>
                                                    <option value="2">عدم تایید</option>
                                                </select>
                                            </div>

                                            <div class="col-md-10">
                                                <label>توضیحات:</label>
                                                <textarea name="descriptionu" id="descriptionu"
                                                          placeholder="لطفا توضیحات خود را وارد کنید"
                                                          class="form-control"
                                                          rows="5" cols="20">
                                                    </textarea>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="button" class="btn btn-success"
                                                id="saveu"
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

<div class="modal fade" id="admi_" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        نظر مدیر عامل
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

                            <form autocomplete="off" id="userfform" name="userfform">
                                <input type="hidden" id="ides_" name="ides_">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered dateeeeee" id="dateeeeee">
                                            <thead style="background-color: #e8ecff">
                                            <tr>
                                                <td style="width: 1px">شماره فاکتور</td>
                                                <td>فروشنده</td>
                                                <td>خریدار</td>
                                                <td>محصول</td>
                                                <td>رنگ</td>
                                                <td>تعداد مرجوعی</td>
                                                <td>تاریخ</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>وضعیت:</label>
                                                <select name="statusur" id="statusur" class="form-control">
                                                    <option value="1">تایید</option>
                                                    <option value="2">عدم تایید</option>
                                                </select>
                                            </div>

                                            <div class="col-md-10">
                                                <label>توضیحات:</label>
                                                <textarea name="descriptionur" id="descriptionur"
                                                          placeholder="لطفا توضیحات خود را وارد کنید"
                                                          class="form-control"
                                                          rows="5" cols="20">
                                                    </textarea>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="button" class="btn btn-success"
                                                id="saverr"
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

<div class="modal fade" id="databasemodel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="modal-body col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            نظر انبار
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

                                <form autocomplete="off" id="databaseFor" name="databaseFor">
                                    <input type="hidden" id="id_d" name="id_d">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table table-responsive">
                                                <table
                                                    class="table table-responsive table-striped table-bordered">
                                                    <thead style="background-color: #e8ecff">
                                                    <tr>
                                                        <td>فاکتور</td>
                                                        <td>محصول</td>
                                                        <td>رنگ</td>
                                                        <td>تعداد</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody
                                                        id="TextBoxContainer">

                                                    <tr>
                                                        <td id="invoiceeee"></td>
                                                        <td id="productttt"></td>
                                                        <td id="colorrrr"></td>
                                                        <td id="numberrrr"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>وضعیت:</label>
                                                    <select name="statusd" id="statusd" class="form-control">
                                                        <option value="1">تایید</option>
                                                        <option value="2">عدم تایید</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-10">
                                                    <label>توضیحات:</label>
                                                    <textarea name="descriptiond" id="descriptiond"
                                                              placeholder="لطفا توضیحات خود را وارد کنید"
                                                              class="form-control"
                                                              rows="5" cols="20">
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <hr/>
                                    <div class="modal-footer">
                                        <div class="text-left">
                                            <button style="width: 130px" type="button" class="btn btn-success"
                                                    id="saved"
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

<div class="modal fade" id="ajaxModeldm" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        توضیحات مشتری
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
                                                    <textarea disabled name="dd" id="dd"
                                                              class="form-control"
                                                              rows="5" cols="20">
                                                    </textarea>


                                    </div>
                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
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

<div class="modal fade" id="ajaxModeldf" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        توضیحات فروش
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
                                                    <textarea disabled name="ff" id="ff"
                                                              class="form-control"
                                                              rows="5" cols="20">
                                                    </textarea>


                                    </div>
                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
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

<div class="modal fade" id="ajaxModelfdslistr" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="capsort">
                        ثبت نظر نهایی مدیر عامل
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

                            <form autocomplete="off" id="productFoorr" name="productFoorr">
                                <input type="hidden" id="id_m" name="id_m">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered dateeee" id="dateeee">
                                            <thead style="background-color: #e8ecff">
                                            <tr>
                                                <td style="width: 1px">شماره فاکتور</td>
                                                <td>فروشنده</td>
                                                <td>خریدار</td>
                                                <td>محصول</td>
                                                <td>رنگ</td>
                                                <td>تعداد کل</td>
                                                <td>تعداد معیوب(مشتری)</td>
                                                <td>تعداد معیوب(پولاد)</td>
                                                <td>تعداد سالم</td>
                                                <td>تاریخ</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="col-md-2">
                                        <label>وضعیت:</label>
                                        <select name="statusq" id="statusq" class="form-control">
                                            <option value="1">تایید</option>
                                            <option value="2">بازگشت به واحد فروش</option>
                                        </select>
                                    </div>

                                    <div class="col-md-10">
                                        <label>توضیحات:</label>
                                        <textarea name="descriptionq" id="descriptionq"
                                                  placeholder="لطفا توضیحات خود را وارد کنید"
                                                  class="form-control"
                                                  rows="5" cols="20">
                                                    </textarea>
                                    </div>


                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="button" class="btn btn-success"
                                                id="saveaa"
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

<div class="modal fade" id="ajaxModell" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        ارسال برای زمانبندی بارگیری
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

                            <form autocomplete="off" id="productlistForm" name="productlistForm"
                                  class="form-horizontal">
                                <input type="hidden" name="product_id" id="product_id">
                                <input type="hidden" name="commodity_id" id="commodity_id">
                                @csrf
                                <div class="row">

                                    <div class="hello" id='TextBoxesGroup'>
                                        <div id="TextBoxDiv1">
                                        </div>
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
                                            <option>نیسان</option>
                                            <option>خاور</option>
                                            <option>تک</option>
                                            <option>جفت</option>
                                            <option>ترانزیت</option>
                                        </select>

                                    </div>

                                    <div class="col-md-12">
                                        <label>حمل از طرف
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="Carry" id="Carry" class="form-control">
                                            <option>پولاد پویش</option>
                                            <option>مشتری</option>
                                        </select>

                                    </div>


                                    <div class="col-md-12">
                                        <label>تاریخ حمل
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="dateu" name="date" class="form-control"
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
                                                id="saveBtnListS"
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

<div class="modal fade" id="ajaxqr" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        چاپ QR
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

                            <form autocomplete="off" id="productlistFormqr" name="productlistFormqr"
                                  class="form-horizontal"
                                  method="get" action="{{route('admin.returns.store.store.qr')}}" target="_blank">
                                <input type="hidden" name="product_id" id="product_id">
                                <input type="hidden" name="commodity_id" id="commodity_id">
                                <input type="hidden" name="id" id="id">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <label>تعداد را وارد کنید
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" name="print" id="print" class="form-control">
                                    </div>


                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">

                                        <input type="submit" class="btn btn-success col-md-3"
                                               value="چاپ">

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


