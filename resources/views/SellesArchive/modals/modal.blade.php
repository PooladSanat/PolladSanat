<div class="modal fade" id="ajaxModelPrint" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="modal-body col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            پیش نمایش و چاپ پیش فاکتور
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

                                <form autocomplete="off" id="CustomerPrint" name="CustomerPrint"
                                      class="form-horizontal">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <label>انبار:</label>
                                                    <select name="selectstores" id="selectstoressss"
                                                            class="form-control">
                                                        @foreach($selectstores as $selectstore)
                                                            <option
                                                                value="{{$selectstore->id}}">{{$selectstore->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>انتخاب بانک:</label>
                                                    <select name="name_bank" id="name_bankkk"
                                                            class="form-control">
                                                        @foreach($banks as $bank)
                                                            <option
                                                                value="{{$bank->id}}">{{$bank->NameBank}}</option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                                <div class="col-md-6">

                                                    <label>تاریخ اعتبار پیش فاکتور:</label>
                                                    <input name="date" id="dateeee" class="form-control">
                                                </div>

                                                <div class="col-md-6">

                                                    <label>زمان تحویل</label>
                                                    <input name="timee" id="timee" class="form-control">
                                                </div>
                                                <div class="col-md-12">

                                                    <label>توضیحات:</label>
                                                    <textarea id="descriptionnn"
                                                              placeholder="لطفا توضیحات خود را در مورد پیش فاکتور وارد کنید"
                                                              name="description" class="form-control">

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
                                                    id="PrintSell"
                                                    data-dismiss="modal">
                                                پیش نمایش و چاپ
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
