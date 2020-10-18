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
                                <input type="hidden" name="id" id="id">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">

                                        <label>قالب
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" name="format_id" id="format_id">
                                            @foreach($Formats as $Format)
                                                <option value="{{$Format->id}}">{{$Format->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-12">

                                        <label>از رنگ
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" name="ofColor_id" id="ofColor_id">
                                            @foreach($colors as $color)
                                                <option value="{{$color->id}}">{{$color->manufacturer}} - {{$color->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>


                                    <div class="col-md-12">

                                        <label>به رنگ
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select class="form-control" name="toColor_id" id="toColor_id">
                                            @foreach($colors as $color)
                                                <option value="{{$color->id}}">{{$color->manufacturer}} - {{$color->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>




                                    <div class="col-md-12">

                                        <label>ضایعات قابل مصرف(Kg)
                                        </label>
                                        <input type="text" id="usable" name="usable"
                                               class="form-control"
                                               required>

                                    </div>
                                    <div class="col-md-12">

                                        <label>ضایعات غیر قابل مصرف(Kg)
                                        </label>
                                        <input type="text" id="unusable" name="unusable"
                                               class="form-control"
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

