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
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e8ecff');
            },
            "bInfo": false,
            "paging": false,
            "bPaginate": false,
            "columnDefs": [
                {"orderable": false, "targets": 0},
            ],
            "order": [[ 6, "deesc" ]],
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.receiptreturn.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                {data: 'product_id', name: 'product_id'},
                {data: 'color_id', name: 'color_id'},
                {data: 'number', name: 'number'},
                {data: 'created', name: 'created'},
                {data: 'time', name: 'time'},
                {data: 'barn', name: 'barn'},
                {data: 'action', name: 'action'},
            ]
        });

        $('body').on('click', '.checkProduct', function () {
            var id = $(this).data("id");
            Swal.fire({
                title: 'تایید ورودی تولید به انبار!',
                text: "مقدار ضایعات شده با تایید شما به انبار اضافه حواهد شد",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'تایید',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.receiptreturn.wizard')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#data-table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'موفق',
                                text: 'تعداد ضایعات شده با موفقیت به انبار اضافه شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });

        $('#createNewProduct').click(function () {
            $('#productForm').trigger("reset");
            $('#ajaxModel').modal('show');
            $('#caption').text('افزودن رنگ');
            $('#product_id').val('');
        });

        $('#saveBbtn').click(function (e) {
            e.preventDefault();
            $('#saveBbtn').text('در حال ثبت اطلاعات...');
            $('#saveBbtn').prop("disabled", true);
            $.ajax({
                data: $('#productFormv').serialize(),
                url: "{{ route('admin.receiptreturn.restore') }}",
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
                        $('#saveBbtn').text('ثبت');
                        $('#saveBbtn').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#productFormv').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBbtn').text('ثبت');
                        $('#saveBbtn').prop("disabled", false);
                    }
                }
            });
        });


    });
    $('#barn').addClass('active');
    $('#rbarn').addClass('active');

</script>
