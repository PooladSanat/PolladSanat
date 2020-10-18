<div class="modal fade" id="showDevice1" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        افزودن محصول به دستگاه
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
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#productdevice1" data-toggle="tab">محصولات
                                                        ماشین</a></li>
                                                <li><a href="#product1" data-toggle="tab">محصولات</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="productdevice1">
                                                    <table class="table table-striped table-bordered device1"
                                                           id="device1">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>اولویت</th>
                                                            <th>محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد</th>
                                                            <th>قالب</th>
                                                            <th>Insert</th>
                                                            <th>سایکل تایم</th>
                                                            <th>وزن</th>
                                                            <th>وضعیت</th>
                                                            <th>زمان تولید</th>
                                                            <th>زمان تولید در صف</th>
                                                            <th>تعداد تولید شده</th>
                                                            <th>مانده تولید</th>
                                                            <th>زمان باقی مانده</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="tab-pane" id="product1">
                                                    <table class="table table-striped table-bordered listdevice1"
                                                           id="listdevice1">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>کد سفارش</th>
                                                            <th>نام محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد تولید</th>
                                                            <th>تاریخ سفارش</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
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

<div class="modal fade" id="showFalseDevice1" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        افزودن محصول به دستگاه
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
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#productdevicefalse1" data-toggle="tab">محصولات
                                                        ماشین</a></li>
                                                <li><a href="#productfalse1" data-toggle="tab">محصولات</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="productdevicefalse1">
                                                    <table class="table table-striped table-bordered devicefalse1"
                                                           id="devicefalse1">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>اولویت</th>
                                                            <th>محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد</th>
                                                            <th>قالب</th>
                                                            <th>Insert</th>
                                                            <th>سایکل تایم</th>
                                                            <th>وزن</th>
                                                            <th>زمان تولید</th>
                                                            <th>زمان تولید در صف</th>
                                                            <th>تعداد تولید شده</th>
                                                            <th>مانده تولید</th>
                                                            <th>زمان باقی مانده</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="tab-pane" id="productfalse1">
                                                    <table class="table table-striped table-bordered listfalsedevice1"
                                                           id="listfalsedevice1">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>کد سفارش</th>
                                                            <th>نام محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد تولید</th>
                                                            <th>تاریخ سفارش</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
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

<div class="modal fade" id="showDevice2" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        افزودن محصول به دستگاه
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
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#deviceproduct2" data-toggle="tab">محصولات
                                                        ماشین</a></li>
                                                <li><a href="#product2" data-toggle="tab">محصولات</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="deviceproduct2">
                                                    <table class="table table-striped table-bordered device2"
                                                           id="device2">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>اولویت</th>
                                                            <th>محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد</th>
                                                            <th>قالب</th>
                                                            <th>Insert</th>
                                                            <th>سایکل تایم</th>
                                                            <th>وزن</th>
                                                            <th>زمان تولید</th>
                                                            <th>زمان تولید در صف</th>
                                                            <th>تعداد تولید شده</th>
                                                            <th>مانده تولید</th>
                                                            <th>زمان باقی مانده</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="tab-pane" id="product2">
                                                    <table class="table table-striped table-bordered listdevice2"
                                                           id="listdevice2">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>کد سفارش</th>
                                                            <th>نام محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد تولید</th>
                                                            <th>تاریخ سفارش</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
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

<div class="modal fade" id="showFalseDevice2" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        افزودن محصول به دستگاه
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
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#deviceproductfalse2" data-toggle="tab">محصولات
                                                        ماشین</a></li>
                                                <li><a href="#productfalse2" data-toggle="tab">محصولات</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="deviceproductfalse2">
                                                    <table class="table table-striped table-bordered devicefalse2"
                                                           id="devicefalse2">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>اولویت</th>
                                                            <th>محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد</th>
                                                            <th>قالب</th>
                                                            <th>Insert</th>
                                                            <th>سایکل تایم</th>
                                                            <th>وزن</th>
                                                            <th>زمان تولید</th>
                                                            <th>زمان تولید در صف</th>
                                                            <th>تعداد تولید شده</th>
                                                            <th>مانده تولید</th>
                                                            <th>زمان باقی مانده</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="tab-pane" id="productfalse2">
                                                    <table class="table table-striped table-bordered listdevicefalse2"
                                                           id="listdevicefalse2">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>کد سفارش</th>
                                                            <th>نام محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد تولید</th>
                                                            <th>تاریخ سفارش</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
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

<div class="modal fade" id="showDevice3" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        افزودن محصول به دستگاه
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
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#deviceproduct3" data-toggle="tab">محصولات
                                                        ماشین</a></li>
                                                <li><a href="#product3" data-toggle="tab">محصولات</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="deviceproduct3">
                                                    <table class="table table-striped table-bordered device3"
                                                           id="device3">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>اولویت</th>
                                                            <th>محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد</th>
                                                            <th>قالب</th>
                                                            <th>Insert</th>
                                                            <th>سایکل تایم</th>
                                                            <th>وزن</th>
                                                            <th>زمان تولید</th>
                                                            <th>زمان تولید در صف</th>
                                                            <th>تعداد تولید شده</th>
                                                            <th>مانده تولید</th>
                                                            <th>زمان باقی مانده</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="tab-pane" id="product3">
                                                    <table class="table table-striped table-bordered listdevice3"
                                                           id="listdevice3">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>کد سفارش</th>
                                                            <th>نام محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد تولید</th>
                                                            <th>تاریخ سفارش</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
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

<div class="modal fade" id="showFalseDevice3" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        افزودن محصول به دستگاه
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
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#deviceproductfalse3" data-toggle="tab">محصولات
                                                        ماشین</a></li>
                                                <li><a href="#productfalse3" data-toggle="tab">محصولات</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="deviceproductfalse3">
                                                    <table class="table table-striped table-bordered devicefalse3"
                                                           id="devicefalse3">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>اولویت</th>
                                                            <th>محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد</th>
                                                            <th>قالب</th>
                                                            <th>Insert</th>
                                                            <th>سایکل تایم</th>
                                                            <th>وزن</th>
                                                            <th>زمان تولید</th>
                                                            <th>زمان تولید در صف</th>
                                                            <th>تعداد تولید شده</th>
                                                            <th>مانده تولید</th>
                                                            <th>زمان باقی مانده</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="tab-pane" id="productfalse3">
                                                    <table class="table table-striped table-bordered listdevicefalse3"
                                                           id="listdevicefalse3">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>کد سفارش</th>
                                                            <th>نام محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد تولید</th>
                                                            <th>تاریخ سفارش</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
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

<div class="modal fade" id="showDevice4" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        افزودن محصول به دستگاه
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
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#deviceproduct4" data-toggle="tab">محصولات
                                                        ماشین</a></li>
                                                <li><a href="#product4" data-toggle="tab">محصولات</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="deviceproduct4">
                                                    <table class="table table-striped table-bordered device4"
                                                           id="device4">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>اولویت</th>
                                                            <th>محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد</th>
                                                            <th>قالب</th>
                                                            <th>Insert</th>
                                                            <th>سایکل تایم</th>
                                                            <th>وزن</th>
                                                            <th>زمان تولید</th>
                                                            <th>زمان تولید در صف</th>
                                                            <th>تعداد تولید شده</th>
                                                            <th>مانده تولید</th>
                                                            <th>زمان باقی مانده</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="tab-pane" id="product4">
                                                    <table class="table table-striped table-bordered listdevice4"
                                                           id="listdevice4">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>کد سفارش</th>
                                                            <th>نام محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد تولید</th>
                                                            <th>تاریخ سفارش</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
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

<div class="modal fade" id="showDevice5" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        افزودن محصول به دستگاه
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
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#deviceproduct5" data-toggle="tab">محصولات
                                                        ماشین</a></li>
                                                <li><a href="#product5" data-toggle="tab">محصولات</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="deviceproduct5">
                                                    <table class="table table-striped table-bordered device5"
                                                           id="device5">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>اولویت</th>
                                                            <th>محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد</th>
                                                            <th>قالب</th>
                                                            <th>Insert</th>
                                                            <th>سایکل تایم</th>
                                                            <th>وزن</th>
                                                            <th>زمان تولید</th>
                                                            <th>زمان تولید در صف</th>
                                                            <th>تعداد تولید شده</th>
                                                            <th>مانده تولید</th>
                                                            <th>زمان باقی مانده</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="tab-pane" id="product5">
                                                    <table class="table table-striped table-bordered listdevice5"
                                                           id="listdevice5">
                                                        <thead style="background-color: #e8ecff">
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>کد سفارش</th>
                                                            <th>نام محصول</th>
                                                            <th>رنگ</th>
                                                            <th>تعداد تولید</th>
                                                            <th>تاریخ سفارش</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
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




