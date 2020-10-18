@extends('layouts.master')
@section('content')
    <form autocomplete="off" id="productForm"
          name="productForm"
          method="post"
    >
        @csrf
        <input type="hidden" id="id" name="id" value="{{$setting->id}}">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            مشخصات عمومی سیستم
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="row">


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>درصد مالیات
                                    </label>
                                    <input id="Tax" name="Tax" class="form-control"
                                           value="{{$setting->Tax}}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>سال جاری
                                    </label>
                                    <input id="year" name="year" class="form-control"
                                           value="{{$setting->year}}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>حداکثر زمان برای هدف گذاری
                                    </label>
                                    <input id="targeting" name="targeting" class="form-control"
                                           value="{{$setting->targeting}}">
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="text-left">
                        <input style="width: 130px" type="submit" class="btn btn-success" id="saveBtn"
                               value="ثبت">
                    </div>
                </div>

            </div>


        </div>
    </form>
    @include('setting.scripts.script')

@endsection
