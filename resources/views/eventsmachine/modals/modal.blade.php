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

                                        <label>دستگاه
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="device_id" id="device_id" class="form-control">
                                            @foreach($devices as $device)
                                                <option value="{{$device->id}}">{{$device->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>


                                    <div class="col-md-12">
                                        <label>تاریخ
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input  type="text" id="date" name="date" class="form-control example1"/>

                                    </div>

                                    <div class="col-md-12">
                                        <label>ساعت
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="time" name="time" class="form-control"/>

                                    </div>

                                    <div class="col-md-12">

                                        <label>شیفت
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="shift" id="shift" class="form-control">
                                           <option value="1">روز</option>
                                           <option value="2">شب</option>
                                        </select>

                                    </div>

                                    <div class="col-md-12">

                                        <label>وضعیت
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">فعال</option>
                                            <option value="2">غیرفعال</option>
                                        </select>

                                    </div>


                                    <div class="col-md-12">

                                        <label>علت</label>
                                        <textarea id="cause" name="cause" class="form-control" rows="4"
                                                  cols="50" placeholder="متن خود را وارد کنید">
                                                </textarea>

                                    </div>



                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success" id="saveBtn"
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


