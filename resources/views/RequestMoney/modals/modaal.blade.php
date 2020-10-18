<div class="modal fade" id="success" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption" id="caption">
                        تایین وضعیت درخواست وجه
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

                            <form autocomplete="off" id="productFo" name="productFo" class="form-horizontal">
                                <input type="hidden" id="edit_id" name="edit_id" value="{{$id}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">

                                        <label>وضعیت
                                        </label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">تایید پرداخت</option>
                                            <option value="2">عدم تایید</option>
                                        </select>

                                    </div>

                                    <div class="col-md-12">
                                        <label>توضیحات</label>
                                        <textarea id="description" name="description" class="form-control" rows="4"
                                                  cols="50" placeholder="متن خود را وارد کنید">
                                                </textarea>
                                    </div>

                                </div>
                                <br/>
                                <hr/>
                                <div class="modal-footer">
                                    <div class="text-left">

                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="savesuccess" value="ثبت">
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
