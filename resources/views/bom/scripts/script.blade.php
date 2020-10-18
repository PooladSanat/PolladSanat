<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
    var product = [];
    @foreach($products as $product)
    product.push({'id': '{{$product->id}}', 'label': '{{$product->label}}'});
        @endforeach
    var details;
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.data-table').DataTable({

            processing: true,
            serverSide: true,
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e8ecff');
            },
            "bInfo": false,
            "paging": false,
            "bPaginate": false,
            "columnDefs": [
                {"orderable": false, "targets": 0},
            ],
            "order": [[ 2, "Acs" ]],
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },


            ajax: "{{ route('admin.bom.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                {data: 'product', name: 'product'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]

        });
        var tabl = $('.detail-table').DataTable({
            processing: true,
            serverSide: true,

            destroy: true,
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e8ecff');
            },
            "bInfo": false,
            "paging": false,
            "bPaginate": false,
            "columnDefs": [
                {"orderable": false, "targets": 0},
            ],
            "order": [[ 3, "Acs" ]],
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "محصولی را انتخاب کنید",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات",
            },
            ajax: "{{ route('admin.bom.detail') }}" + '/' + details,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                {data: 'bom', name: 'bom'},
                {data: 'number', name: 'number'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        $('#createNewProduct').click(function () {
            $('#productForm').trigger("reset");
            $('#ajaxModel').modal('show');
            $('#product').val('');
        });
        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.bom.update') }}" + '/' + product_id, function (data) {
                $('#ajaxModel').modal('show');
                $('#pr').val(data.id);
                $('#produ').val(data.product_id);
                $('#pnumber').val(data.number);
                $('#bo')
                    .find('option')
                    .remove();
                for (var i in product) {
                    if (product[i].id == data.bom_id) {

                        $("#bo").append('<option value="' + product[i].id + '">' + product[i].label + '</option>');

                    }

                }
            });

        });
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $('#saveBtn').text('در حال ثبت اطلاعات...');
            $('#saveBtn').prop("disabled", true);
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.bom.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    if (data.unm) {
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        Swal.fire({
                            title: 'خطا!',
                            text: 'این زیر مجموعه برای محصول انتخاب شده است',
                            icon: 'error',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);
                    }

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
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات Bom با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#detail-table').DataTable().ajax.reload();
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);
                    }

                }
            });
        });
        $('#name').val('');
        $('#code').val('');
        $('#characteristics_id').val('');
        $('#commodity_id').val('');
        $('#manufacturing').val('');
        $('#product_id').val('');
    });
    $('body').on('click', '.deleteProduct', function () {
        var id = $(this).data("id");
        Swal.fire({
            title: 'حذف Bom؟',
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
                    url: "{{route('admin.bom.delete')}}" + '/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        $('#data-table').DataTable().ajax.reload();
                        $('#detail-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات Bom با موفقیت از سیستم حذف شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        })
                    }
                });
            }
        })
    });
    $('body').on('click', '.deletep', function () {
        var id = $(this).data("id");
        console.log(id);
        Swal.fire({
            title: 'حذف Bom؟',
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
                    url: "{{route('admin.bom.deletep')}}" + '/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        $('#data-table').DataTable().ajax.reload();
                        $('#detail-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات Bom با موفقیت از سیستم حذف شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        })
                    }
                });
            }
        })
    });
    $('body').on('click', '.details', function () {


        var details = $(this).data('id');
        if (details) {
            var tabl = $('.detail-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                "language": {
                    "search": "جستجو:",
                    "lengthMenu": "نمایش _MENU_",
                    "zeroRecords": "موردی یافت نشد!",
                    "info": "نمایش _PAGE_ از _PAGES_",
                    "infoEmpty": "موردی یافت نشد",
                    "infoFiltered": "(جستجو از _MAX_ مورد)",
                    "processing": "در حال پردازش اطلاعات",
                },
                ajax: "{{ route('admin.bom.detail') }}" + '/' + details,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'bom', name: 'bom'},
                    {data: 'number', name: 'number'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#createNew').click(function () {
                var product_id = details;
                var p = product;
                if (p) {
                    $('#ajax').modal('show');
                    $('#id_product').val(product_id);
                    $('#bom_id').val('');
                    $('#bom_id')
                        .find('option')
                        .remove();
                    for (var i in p) {
                        if (p[i].id != product_id) {
                            $("#bom_id").append('<option value="' + p[i].id + '">' + p[i].label + '</option>');
                        }
                    }
                }
            });
        }

    });
    $('#produ').change(function () {
        var product = $(this).val();
        if (product) {
            $.ajax({
                    type: "GET",
                    url: "{{route('admin.bom.filter')}}?product=" + product,
                    success: function (res) {
                        if (res) {
                            $("#bo").empty();
                            $("#bo").append('<option>لطفا زیر مجموعه را انتخاب کنید</option>');
                            $.each(res, function (key, value) {
                                $("#bo").append('<option value="' + key + '">' + value + '</option>');
                            });

                        } else {
                            $("#bo").empty();
                        }
                    }
                }
            );
        } else {
            $("#bo").empty();
        }

    });
    $('#bom').click(function (e) {
        e.preventDefault();
        $('#bom').text('در حال ثبت اطلاعات...');
        $('#bom').prop("disabled", true);
        $.ajax({
            data: $('#product').serialize(),
            url: "{{ route('admin.bom.store.bom') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if (data.errors) {
                    $('#ajax').modal('hide');
                    jQuery.each(data.errors, function (key, value) {
                        Swal.fire({
                            title: 'خطا!',
                            text: value,
                            icon: 'error',
                            confirmButtonText: 'تایید'
                        })
                    });
                    $('#bom').text('ثبت');
                    $('#bom').prop("disabled", false);
                }
                if (data.success) {
                    $('#product').trigger("reset");
                    $('#ajax').modal('hide');
                    $('#detail-table').DataTable().ajax.reload();
                    Swal.fire({
                        title: 'موفق',
                        text: 'اجزاء برای محصول با موفقیت در سیستم ثبت شد',
                        icon: 'success',
                        confirmButtonText: 'تایید',
                    });
                    $('#bom').text('ثبت');
                    $('#bom').prop("disabled", false);
                }
                if (data.unm) {
                    $('#product').trigger("reset");
                    $('#ajax').modal('hide');

                    Swal.fire({
                        title: 'خطا!',
                        text: 'این زیر مجموعه برای محصول انتخاب شده است',
                        icon: 'error',
                        confirmButtonText: 'تایید',
                    });
                    $('#bom').text('ثبت');
                    $('#bom').prop("disabled", false);
                }
            }
        });
    });
    $(document).ready(function () {
        var table = $('#data-table').DataTable();

        $('#data-table tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#button').click(function () {
            table.row('.selected').remove().draw(false);
        });
    });

    $('#foundation').addClass('active');
    $('#foundation_a').addClass('active');
</script>
