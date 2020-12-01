
<div class="modal fade" id="Success" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        ثبت نظر واحد کنترل کیفیت
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="form-group">

                            <form autocomplete="off" id="CustomerSuccess" name="CustomerSuccess"
                                  class="form-horizontal">
                                <input type="hidden" name="id_invoice" id="id_invoice">
                                @csrf
                                <div class="row">


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>نظر
                                            </label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="1">تایید</option>
                                                <option value="2">رد کردن</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>توضیحات
                                            </label>
                                            <textarea name="description" id="description_invoice" rows="5"
                                                      class="form-control" placeholder="لطفا توضیحات را وارد کنید">
                                                 </textarea>
                                        </div>
                                    </div>


                                </div>
                                <br/>
                                <div class="modal-footer">
                                    <div class="text-left">
                                        <button style="width: 130px" type="submit" class="btn btn-success"
                                                id="saveSuccess" value="ثبت">
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


