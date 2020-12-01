<div class="modal fade" id="ajaxcustomer" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="cappattioon">

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

                            <form autocomplete="off" id="productForm" name="productForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs" style="background-color: white">
                                                <li style="background-color: #e6e6e6" class="active"><a href="#a"
                                                                                                        data-toggle="tab">اطلاعات
                                                        پایه</a></li>
                                                <li style="background-color: #e6e6e6"><a href="#b" data-toggle="tab">لیست
                                                        تراکنش
                                                        ها</a></li>
                                                <li style="background-color: #e6e6e6"><a href="#c" data-toggle="tab">سوابق
                                                        خرید</a>
                                                </li>
                                                <li style="background-color: #e6e6e6"><a href="#d" data-toggle="tab">اسناد
                                                        پرداختی</a></li>
                                            </ul>
                                            <div class="tab-content">

                                                <div class="active tab-pane" id="a">
                                                    <br/>
                                                    <table class="table table-striped table-bordered information"
                                                           id="information">

                                                        <thead style="background-color: #e6e6e6">
                                                        <tr>
                                                            <th>نام</th>
                                                            <th width="140px">کارشناس</th>
                                                            <th>نوع مشتری</th>
                                                            <th>شماره همراه</th>
                                                            <th>شماره ثابت</th>
                                                            <th width="140px">مانده حساب(ریال)</th>
                                                        </tr>
                                                        </thead>
                                                        <tfoot>
                                                        <tr style="background-color: #e6e6e6">
                                                            <th>آدرس</th>
                                                            <th colspan="5" id="adde"></th>
                                                        </tr>
                                                        </tfoot>

                                                    </table>
                                                </div>

                                                <div class="tab-pane" id="b">
                                                    <br/>
                                                    <table class="table table-striped table-bordered traconesh"
                                                           id="traconesh">
                                                        <thead style="background-color: #e6e6e6">
                                                        <tr>
                                                            <th width="1px" style="text-align: center">ردیف
                                                            </th>
                                                            <th width="140px">تاریخ</th>
                                                            <th>شرح</th>
                                                            <th width="140px">بدهکار(ریال)</th>
                                                            <th width="140px">بستانکار(ریال)</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <td width="1px"></td>
                                                        <td width="140px"></td>
                                                        <td></td>
                                                        <td width="140px"></td>
                                                        <td width="140px"></td>
                                                        </tbody>

                                                        <tfoot style="background-color: #e6e6e6" align="right">
                                                        <tr>
                                                            <th width="1px"></th>
                                                            <th width="140px"></th>
                                                            <th></th>
                                                            <th style="color: red" width="140px"></th>
                                                            <th style="color: blue" width="140px"></th>
                                                        </tr>


                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <div class="tab-pane" id="c">
                                                    <br/>
                                                    <table class="table table-striped table-bordered kharid"
                                                           id="kharid">
                                                        <thead style="background-color: #e6e6e6">
                                                        <tr>
                                                            <th width="1px">ردیف</th>
                                                            <th>تاریخ</th>
                                                            <th>فاکتور</th>
                                                            <th>مبلغ(ریال)</th>
                                                            <th>نحوه پرداخت</th>
                                                            <th width="140px">وضعیت پرداخت</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <td width="1px"></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td width="140px"></td>
                                                        </tbody>

                                                        <tfoot align="right">
                                                        <tr style="background-color: #e6e6e6">
                                                            <th width="1px"></th>
                                                            <th colspan="2"></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th width="140px"></th>
                                                        </tr>


                                                        </tfoot>
                                                    </table>

                                                </div>

                                                <div class="tab-pane" id="d">
                                                    <br/>
                                                    <table class="table table-striped table-bordered asnad" id="asnad">
                                                        <thead style="background-color: #e6e6e6">
                                                        <tr>
                                                            <th width="1px">ردیف</th>
                                                            <th>نام مشتری</th>
                                                            <th>بابت</th>
                                                            <th>نوع سند</th>
                                                            <th>تاریخ سند</th>
                                                            <th>بانک</th>
                                                            <th>نام صادر کننده</th>
                                                            <th>مبلغ(ریال)</th>
                                                            <th>توضیحات</th>
                                                            <th>وصول</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <td width="1px"></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        </tbody>
                                                    </table>
                                                </div>

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
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
