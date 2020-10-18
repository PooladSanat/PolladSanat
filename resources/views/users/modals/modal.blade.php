<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog col-md-12">
        <div class="modal-content">
            <div class="modal-body col-md-12">
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
                                <div class="alert alert-danger" style="display:none"></div>
                                <form autocomplete="off" id="productForm"
                                      name="productForm"
                                      enctype="multipart/form-data"
                                      method="post"
                                >
                                    @csrf
                                    <input type="hidden" id="id" name="id">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>نام و نام خانوادگی
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                   required>
                                        </div>
                                        <div class="col-md-3">
                                            <label>نام کاربری
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <input type="text" id="email" name="email" class="form-control"
                                                   required>
                                        </div>
                                        <div class="col-md-3">
                                            <label>شماره تماس
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                   required>
                                        </div>
                                        <div class="col-md-3">
                                            <label>امضا

                                            </label>
                                            <input type="file" name="sign" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label>تصویر پروفایل

                                            </label>
                                            <input type="file" name="avatar" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label>نقش

                                            </label>
                                            <br/>
                                            <select dir="rtl" id="select2-example" class="form-control"
                                                    name="roles[]" multiple
                                                    required>
                                                @foreach($roles as $role)
                                                    @if(!empty($role))
                                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label>کلمه عبور
                                                <span
                                                    style="color: red"
                                                    class="required-mark">*</span>
                                            </label>
                                            <input type="password" id="password" name="password"
                                                   class="form-control"
                                                   required>
                                        </div>

                                    </div>
                                    <br/>
                                    <hr/>
                                    <div class="modal-footer">


                                        <div class="text-left">
                                            <button style="width: 130px" type="submit" class="btn btn-success"
                                                    id="saveBtn" value="ثبـــــــت">
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

