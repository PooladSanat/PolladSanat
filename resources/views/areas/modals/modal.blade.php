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
                                <input type="hidden" name="product_id" id="product_id">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>کشور
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="country" id="country" class="form-control">
                                            @foreach($countrys as $country)
                                                <option value="{{$country->country_id}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-md-12">
                                        <label>استان
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <select name="city" id="city" class="form-control">
                                        </select>
                                    </div>


                                    <div class="col-md-12">
                                        <label>منطقه
                                            <span
                                                style="color: red"
                                                class="required-mark">*</span>
                                        </label>
                                        <input type="text" name="areas" id="areas" class="form-control">
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

