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
                                                       placeholder="لطفا کد قالب را وارد کنید"
                                                       required>

                                        </div>
                                        <div class="col-md-12">

                                                <label>نام قالب
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                       placeholder="لطفا نام قالب را وارد کنید"
                                                       required>

                                        </div>

                                        <div class="col-md-12">

                                                <label>قالب ساز
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <select dir="rtl" id="model_id" class="form-control"
                                                        name="model_id"
                                                        required>
                                                    @foreach($models as $model)
                                                        @if(!empty($model))
                                                            <option
                                                                value="{{$model->id}}">{{$model->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                        </div>

                                        <div class="col-md-12">

                                            <label>زمان تغیر قالب
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <input type="text" id="time" name="time" class="form-control"
                                                   placeholder="زمان تغیر قالب را وارد کنید"
                                                   required>

                                        </div>


                                        <div class="col-md-12">

                                                <label>تعداد کویته
                                                    <span
                                                        style="color: red"
                                                        class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="quetta" name="quetta" class="form-control"
                                                       placeholder="لطفا تعداد کویته را وارد کنید"
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

