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


        load_data();

        function load_data(from_check = '') {
            $('#data-table').DataTable({
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
                "order": [[6, "Accs"]],
                "language": {
                    "search": "جستجو:",
                    "lengthMenu": "نمایش _MENU_",
                    "zeroRecords": "موردی یافت نشد!",
                    "info": "نمایش _PAGE_ از _PAGES_",
                    "infoEmpty": "موردی یافت نشد",
                    "infoFiltered": "(جستجو از _MAX_ مورد)",
                    "processing": "در حال پردازش اطلاعات"
                },

                ajax: {
                    ajax: "{{ route('admin.barnproduct.list') }}",
                    data:
                        {
                            from_check: from_check,
                        }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'product_name', name: 'product_name'},
                    {data: 'color_name', name: 'color_name'},
                    {data: 'Inventory', name: 'Inventory'},
                    {data: 'Inventor', name: 'Inventor'},
                    {data: 'Number', name: 'Number'},
                    {data: 'true', name: 'true'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},


                ]
            });

        }


        $('#filter').click(function () {
            var from_check = $('#list').val();
            $('#data-table').DataTable().destroy();
            load_data(from_check);
        });

        $('#createNewProduct').click(function () {
            $('#productForm').trigger("reset");
            $('#ajaxModel').modal('show');
            $('#caption').text('افزودن موجودی');
            $('#product_id').val('');
        });


        $('body').on('click', '.editProduct', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.barnproduct.update') }}" + '/' + id, function (data) {
                $('#ajaxModel').modal('show');
                $('#caption').text('افزودن موجودی');
                $('#color').val(data.color_id);
                $('#product').val(data.product_id);
                $('#PhysicalInventory').val(data.Inventory);
                $('#PhysicalInventor').val(data.Inventor);
                $('#product_id').val(id);
            })

        });


        $('body').on('click', '.detail-factor', function () {
            $("#caapp").text("جزییات محصول تقاضا داده شده");
            var detail_factor = $(this).data('id');
            $('#ajaxModellistre').modal('show');
            $('#factooorrr').DataTable().destroy();
            $('.factooorrr').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                "ordering": false,
                "paging": false,
                "info": false,
                "language": {
                    "search": "جستجو:",
                    "lengthMenu": "نمایش _MENU_",
                    "zeroRecords": "موردی یافت نشد!",
                    "info": "نمایش _PAGE_ از _PAGES_",
                    "infoEmpty": "موردی یافت نشد",
                    "infoFiltered": "(جستجو از _MAX_ مورد)",
                    "processing": "در حال پردازش اطلاعات"
                },
                ajax: {
                    url: "{{ route('admin.receiptpolim.list.detail.factor') }}",
                    data: {
                        detail_factor: detail_factor,
                    },
                },
                columns: [
                    {data: 'pack', name: 'pack', "className": "dt-center"},
                    {data: 'user', name: 'user'},
                    {data: 'customer_name', name: 'customer_name'},
                    {data: 'color', name: 'color'},
                    {data: 'product', name: 'product'},
                    {data: 'number', name: 'number'},
                    {data: 'date', name: 'date'},
                ]

            });


        });


        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $('#saveBtn').text('در حال ثبت اطلاعات...');
            $('#saveBtn').prop("disabled", true);
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.barnproduct.store') }}",
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
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        $('#data-table').DataTable().draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'موجودی انبار با موفقیت در سیستم بروزرسانی شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);
                    }
                }
            });
        });


    });
    $('body').on('click', '.deleteProduct', function () {
        var id = $(this).data("id");
        Swal.fire({
            title: 'حذف رنگ؟',
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
                    url: "{{route('admin.color.delete')}}" + '/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات رنگ با موفقیت از سیستم حذف شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        })
                    }
                });
            }
        })
    });

    $('#barn').addClass('active');
    $('#bbarn').addClass('active');

</script>
