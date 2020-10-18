<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/public/assets/select2.js')}}"></script>
<script src="{{asset('/public/js/datatab.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/row.js')}}" type="text/javascript"></script>

<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
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
            retrieve: true,
            aaSorting: [],
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e8ecff');
            },
            "bInfo": false,
            "paging": false,
            "bPaginate": false,
            "columnDefs": [
                {"orderable": false, "targets": 0},
            ],
            "order": [[7, "sdesc"]],
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{route('admin.product.list.sort')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                {data: 'user', name: 'user'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'Priority', name: 'Priority'},
                {data: 'date', name: 'date'},
                {data: 'datem', name: 'datem'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            rowsGroup:
                [
                    1
                ],
        });

        table.on('row-reorder', function (e, details) {
            if (details.length) {
                var rows = [];
                details.forEach(element => {
                    rows.push({
                        id: table.row(element.node).data().id,
                        position: element.newData
                    });
                });
                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.product.list.Soort') }}",
                    data: {rows, "_token": "{{ csrf_token() }}"}
                }).done(function () {
                    table.draw();
                });
            }
        });

        $('#createNewProduct').click(function () {
            $('#productForm').trigger("reset");
            $('#ajaxModel').modal('show');
            $('#caption').text('افزودن مشخصات دستگاه');
            $('#product').val('');
        });

        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.device.update') }}" + '/' + product_id, function (data) {
                $('#ajaxModel').modal('show');
                $('#caption').text('ویرایش مشخصات دستگاه');
                $('#product').val(data.id);
                $('#name').val(data.name);
                $('#code').val(data.code);
                $('#model').val(data.model);
            })
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $('#saveBtn').text('در حال ثبت اطلاعات...');
            $('#saveBtn').prop("disabled", true);
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.device.store') }}",
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
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات دستگاه با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);
                        $('#name').val('');
                        $('#code').val('');
                        $('#product').val('');
                    }
                }
            });
        });
    });

    $('body').on('click', '.notdate', function () {
        var id = $(this).data('id');
        $('#ajaxModelDate').modal('show');
        $('#idi').val(id);

    });

    $('#saveBtnd').click(function (e) {
        e.preventDefault();
        $('#saveBtnd').text('در حال ثبت اطلاعات...');
        $('#saveBtnd').prop("disabled", true);
        $.ajax({
            data: $('#productFormd').serialize(),
            url: "{{ route('admin.invoice.store.date') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if (data.errors) {
                    $('#ajaxModelDate').modal('hide');
                    jQuery.each(data.errors, function (key, value) {
                        Swal.fire({
                            title: 'خطا!',
                            text: value,
                            icon: 'error',
                            confirmButtonText: 'تایید'
                        })
                    });
                    $('#saveBtnd').text('ثبت');
                    $('#saveBtnd').prop("disabled", false);
                }
                if (data.success) {
                    $('#productFormd').trigger("reset");
                    $('#ajaxModelDate').modal('hide');
                    $('#data-table').DataTable().ajax.reload();
                    Swal.fire({
                        title: 'موفق',
                        text: 'تاریخ انتخابی شما با موفقیت در سیستم ثبت شد',
                        icon: 'success',
                        confirmButtonText: 'تایید',
                    });
                    $('#saveBtnd').text('ثبت');
                    $('#saveBtnd').prop("disabled", false);
                }
            }
        });
    });

    $('body').on('click', '.deleteProduct', function () {
        var id = $(this).data("id");
        Swal.fire({
            title: 'حذف سفارش؟',
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
                    url: "{{route('admin.device.delete')}}" + '/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات سفارش با موفقیت از سیستم حذف شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        })
                    }
                });
            }
        })
    });

    $('#barnam').addClass('active');

    $('#f').select2({
        width: '100%',
        dir: 'rtl',
        language: {
            noResults: function () {
                return 'پرسنل با این مشخصات یافت نشد';
            },
        }
    });

</script>

<script>
    kamaDatepicker('date',
        {
            buttonsColor: "red",
            forceFarsiDigits: false,
            sync: true,
            gotoToday: true,
            highlightSelectedDay: true,
            markHolidays: true,
            markToday: true,
            previousButtonIcon: "fa fa-arrow-circle-left",
            nextButtonIcon: "fa fa-arrow-circle-right",

        });
</script>



