@extends('layouts.master')
@section('content')
    @include('message.msg')
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                ویرایش کاربر
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <form method="post" action="{{route('admin.user.updates')}}"
                          class="mt-repeater"
                          autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$id->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                           required @if($id) value="{{$id->name}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام کاربری</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                           required @if($id) value="{{$id->email}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>شماره تماس</label>
                                    <input type="text" id="phone" name="phone" class="form-control"
                                           required @if($id) value="{{$id->phone}}" @endif>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>تصویر پروفایل</label>
                                    <input type="file" name="avatar" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>امضا</label>
                                    <input type="file" name="sign" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نقش</label>
                                    <select dir="rtl" id="select2-example" class="form-control" name="roles[]"
                                            multiple
                                            required>
                                        @foreach($roles as $role)
                                            @if(!empty($role))
                                                <option value="{{$role->id}}"
                                                        @if($id and $rol == $role->id) selected @endif>{{$role->name}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>کلمه عبور</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>
                            </div>

                        </div>
                        <hr/>
                        <div class="form-group">
                            <input type="submit" value="تایید" class="btn btn-primary">
                            &nbsp;
                            <a href="{{route('admin.user.show')}}" class="btn btn-danger">انصراف</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
