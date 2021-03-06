@extends('layouts.master')
@section('content')
    @include('message.msg')

    <form autocomplete="off" id="productForm"
          name="productForm"
          enctype="multipart/form-data"
          method="post"
    >
        @csrf
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption" id="caption">
                            برنامه ریز
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="alert alert-danger" id="alert" style="display: none">
                            <ul>
                                <li>
                                    <strong> توجه! </strong><label id="number_text"> مقدار انبار کمتر از میزان سفارش شما
                                        میباشد</label>
                                </li>

                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نام محصول
                                    </label>

                                    <select readonly name="product_id" id="product_id" class="form-control">
                                        <option value="{{$namep->id}}">{{$namep->label}}</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>رنگ
                                    </label>
                                    <select readonly name="color_id" id="color_id" class="form-control">
                                        <option value="{{$namec->id}}">{{$namec->name}} - {{$namec->manufacturer}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>تعداد
                                    </label>
                                    <input readonly type="number" name="number" id="number"
                                           value="{{$products->number}}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="table table-responsive">
                            <table
                                class="table table-responsive table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>نام مواد</td>
                                    <td>درصد</td>
                                    <td>عملیات</td>
                                </tr>
                                </thead>
                                <tbody
                                    id="TextBoxContainerbank">

                                <tr>
                                    <td id="productt"></td>
                                    <td id="percentageee"></td>
                                    <td id="actiont"></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="1">
                                        <button id="btnAddbank"
                                                type="button"
                                                onclick="addInput10()"
                                                class="btn btn-primary"
                                                data-toggle="tooltip">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="text-left">
                            <button style="width: 130px" type="submit" class="btn btn-success" id="saveBtn"
                                    value="ثبت">
                                ثبت
                            </button>
                            &nbsp;&nbsp;
                            <a style="width: 130px" type="submit" href="{{route('admin.productionorder.list')}}"
                               class="btn btn-danger">
                                برگشت
                            </a>


                        </div>

                    </div>

                </div>


            </div>


        </div>

    </form>
    <script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
    <script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('admin.productionorder.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if (data.errors) {
                            jQuery.each(data.errors, function (key, value) {
                                Swal.fire({
                                    title: 'خطا!',
                                    text: value,
                                    icon: 'error',
                                    confirmButtonText: 'تایید'
                                })
                            });
                        }
                        if (data.success) {
                            Swal.fire({
                                title: 'موفق',
                                text: 'مشخصات سفارش با موفقیت در سیستم ثبت شد',
                                icon: 'success',
                                confirmButtonText: 'تایید',
                            }).then((result) => {

                                location.reload();

                            });
                        }
                    }
                });
            });


            $('#product_id' + ',#color_id')
                .change(function () {
                    var product_id = $('#product_id').val();
                    var color_id = $('#color_id').val();
                    var p = null;
                    var data = "p=" + p + "&product_id=" + product_id + "&color_id=" + color_id;
                    $.ajax({
                        type: "GET",
                        url: "{{route('admin.productionorder.detail')}}?data=" + data,
                        success: function (res) {
                            if (res != 0) {
                                $('#alert').show(1000);
                                $('#number_text').text(res + ' ' + "سفارش از این محصول و رنگ در صف تولید موجود میباشد.");
                            } else {
                                $('#alert').hide(1000);

                            }
                        }
                    });
                })
                .change();
        });
        added_inputs2_array = [];
        if (added_inputs2_array.length >= 1)
            for (var a in added_inputs2_array)
                added_inputs_array_table2(added_inputs2_array[a], a);

        function added_inputs_array_table2(data, a) {

            var myNode = document.createElement('div');
            myNode.id = 'productt' + a;
            myNode.innerHTML += "<div class='form-group'>" +
                "<select id=\'polymeric_id" + a + "\'  name=\"polymeric_id[]\"\n" +
                "class=\"form-control\"/>" +
                "<option>انتخاب کنید</option>" +
                "+@foreach($polymerics as $polymeric)+" +
                "<option value=\"{{$polymeric->id}}\">{{$polymeric->name}}</option>" +
                "+@endforeach+" +
                "</select>" +
                "</div></div></div>";
            document.getElementById('productt').appendChild(myNode);

            var myNode = document.createElement('div');
            myNode.id = 'percentageee' + a;
            myNode.innerHTML += "<div class='form-group'>" +
                "<input type=\"number\" id=\'percentage" + a + "\'  name=\"percentage[]\"\n" +
                "class=\"form-control sell\"/>" +
                "</div></div></div>";
            document.getElementById('percentageee').appendChild(myNode);

            var myNode = document.createElement('div');
            myNode.id = 'actiont' + a;
            myNode.innerHTML += "<div class='form-group'>" +
                "<button onclick='deleteService2(" + a + ", event)' class=\"form-control btn btn-danger\"><i class=\"fa fa-remove\"></button></div>";
            document.getElementById('actiont').appendChild(myNode);

        }

        function deleteService2(id, event) {
            event.preventDefault();
            $('#productt' + id).remove();
            $('#percentageee' + id).remove();
            $('#actiont' + id).remove();
        }

        function addInput10() {
            var data = {
                'title': '',
                'icon': '',
            };
            added_inputs2_array.push(data);
            added_inputs_array_table2(data, added_inputs2_array.length - 1);
        }

        $('body').on('click', '.deleteProduct', function () {
            var id = $(this).data("id");
            Swal.fire({
                title: 'حذف حساب بانکی؟',
                text: "مشخصات حذف شده قابل بازیابی نیستند!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'DELETE',
                        url: "{{route('admin.bank.delete')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#data-table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'موفق',
                                text: 'مشخصات حساب بانکی با موفقیت از سیستم حذف شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });


        $('#manufacturing').addClass('active');

    </script>



@endsection
