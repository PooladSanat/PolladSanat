<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/jquery.maskedinput.js')}}" type="text/javascript"></script>

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
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e8ecff');
            },
            "bInfo": false,
            "paging": false,
            "bPaginate": false,
            "columnDefs": [
                {"orderable": false, "targets": 0},
            ],
            "order": [[5, "dessc"]],
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.RequestMoney.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                {data: 'customer', name: 'customer'},
                {data: 'price', name: 'price'},
                {data: 'status', name: 'status'},
                {data: 'description', name: 'description'},
                {data: 'date', name: 'date'},
                {data: 'state', name: 'state'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#createNewProduct').click(function () {
            $('#productForm').trigger("reset");
            $('#ajaxModel').modal('show');
            $('#caption').text('درخواست وجه');
            $('#id').val('');
        });

        $('body').on('click', '.editProduct', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.RequestMoney.update') }}" + '/' + id, function (data) {
                $('#ajaxModel').modal('show');
                $('#caption').text('ویرایش درخواست وجه');
                $('#id').val(data.id);
                $('#description').val(data.description);
                $('#status').val(data.status);
                $('#price').val(data.price);
                $('#customer_i').val(data.customer_id);
            })
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.RequestMoney.store') }}",
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
                            text: 'مشخصات  با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                    }
                }
            });
        });

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }

        $('#customer_i').change(function () {
            var id = $(this).val();

            if (id) {
                $.ajax({
                        type: "GET",
                        url: "{{route('admin.RequestMoney.filter')}}?id=" + id,
                        success: function (res) {
                            $('#p').val(res);
                            if (res != null) {
                                if (parseInt(res) < "0") {
                                    $('#hesab').css('background-color', 'rgba(255,0,0,0.39)').text(formatNumber(Math.abs(res)));
                                } else if (parseInt(res) > "0") {
                                    $('#hesab').css('background-color', 'rgba(0,0,255,0.39)').text(formatNumber(Math.abs(res)));
                                } else {
                                    $('#hesab').css('background-color', 'rgb(248,255,253)').text(res);
                                }
                            } else {
                                $('#hesab').css('background-color', 'rgb(246,255,250)').text('0');
                            }

                            var number = $('#price').val();
                            if (res < 0) {
                                $('#saveBtn').prop("disabled", true);
                            } else {
                                if (parseInt(number) < parseInt(res)) {
                                    $('#saveBtn').prop("disabled", false);
                                } else {
                                    $('#saveBtn').prop("disabled", true);
                                }
                            }


                        }
                    }
                );
            }

        });

        $('#price').keyup(function () {
            var ress = $('#p').val();
            var numberr = $('#price').val();
            if (ress < 0) {
                $('#saveBtn').prop("disabled", true);
            } else {
                if (parseInt(numberr) < parseInt(ress)) {
                    $('#saveBtn').prop("disabled", false);
                } else {
                    $('#saveBtn').prop("disabled", true);
                }
            }


        }).keyup();

        $('#createNt').click(function () {
            $('#success').modal('show');
        });


        $('#savesuccess').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#productFo').serialize(),
                url: "{{ route('admin.RequestMoney.store.status') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#success').modal('hide');
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
                        $('#productFo').trigger("reset");
                        $('#success').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات  با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                    }
                }
            });
        });


    });

    $('body').on('click', '.deleteProduct', function () {
        var id = $(this).data("id");
        Swal.fire({
            title: 'حذف درخواست وجه؟',
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
                    url: "{{route('admin.RequestMoney.delete')}}" + '/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت از سیستم حذف شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        })
                    }
                });
            }
        })
    });

    jQuery(function ($) {
        $("#CardNumber").mask("9999-9999-9999-9999");
    });

    $('#payment').addClass('active');

</script>
