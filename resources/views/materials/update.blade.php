@extends('layouts.master')
@section('content')
    @include('message.msg')

    <form autocomplete="off" id="productForm"
          name="productForm"
          enctype="multipart/form-data"
          method="post"
    >
        @csrf
        <input type="hidden" name="id" id="id" value="{{$product->id}}">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption" id="caption">
                            انتصاب مواد به محصول
                        </div>

                    </div>

                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>نام محصول
                                    </label>
                                    <select id="product_id" name="product_id" class="form-control"
                                            required>
                                        @foreach($products as $produc)
                                            <option value="{{$produc->id}}"
                                                    @if($product->product_id == $produc->id)
                                                    selected
                                                @endif
                                            >{{$produc->label}}</option>
                                        @endforeach
                                    </select>
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
                        <div class="modal-footer">
                            <div class="text-left">
                                <button style="width: 130px" type="submit" class="btn btn-success" id="saveBtn"
                                        value="ثبت">
                                    ثبت
                                </button>

                            </div>
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
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "language": {
                    "search": "جستجو:",
                    "lengthMenu": "نمایش _MENU_",
                    "zeroRecords": "موردی یافت نشد!",
                    "info": "نمایش _PAGE_ از _PAGES_",
                    "infoEmpty": "موردی یافت نشد",
                    "infoFiltered": "(جستجو از _MAX_ مورد)",
                    "processing": "در حال پردازش اطلاعات"
                },
                ajax: "{{ route('admin.matrial.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'product', name: 'product'},
                    {data: 'title', name: 'title'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


            $('#createNewProduct').click(function () {
                $('#productForm').trigger("reset");
                $('#ajaxModel').modal('show');
                $('#caption').text('انتصاب مواد به محصول');
                $('#id').val('');
            });


            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('admin.matrial.edit') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if (data.errors) {
                            $('#ajaxModel').modal('hide');
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
                            $('#productForm').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            table.draw();
                            Swal.fire({
                                title: 'موفق',
                                text: 'مشخصات با موفقیت در سیستم ثبت شد',
                                icon: 'success',
                                confirmButtonText: 'تایید',
                            }).then((result) => {

                                location.reload();

                            });
                        }
                    }
                });
            });


        });


        added_inputs2_array = [];

            @foreach($productTitles as $productTitle)

        var productTitle = {
                'polymeric_id': "{{$productTitle->polymeric_id}}",
                'percentage': "{{$productTitle->percentage}}",
            };
        added_inputs2_array.push(productTitle);
        @endforeach

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
            $('#polymeric_id' + a + '').val(data.polymeric_id);


            var myNode = document.createElement('div');
            myNode.id = 'percentageee' + a;
            myNode.innerHTML += "<div class='form-group'>" +
                "<input type=\"text\" id=\'percentage" + a + "\'  name=\"percentage[]\"\n" +
                "class=\"form-control sell\"/>" +
                "</div></div></div>";
            document.getElementById('percentageee').appendChild(myNode);
            $('#percentage' + a + '').val(data.percentage);

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


        $('#foundation').addClass('active');
        $('#foundation_a').addClass('active');

    </script>



@endsection
