<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>

<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_data();

        function load_data(from_date = '', to_date = '')
        {
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
                "order": [[ 11, "deesc" ]],
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
                    ajax: "{{ route('admin.invoice.trash') }}",
                    data:{from_date:from_date, to_date:to_date}
                },
                columns: [
                    {data: 'checkbox', orderable: false, searchable: false, "className": "dt-center"},
                    {data: 'invoiceNumber', name: 'invoiceNumber'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'customer_id', name: 'customer_id'},
                    {data: 'number_sell', name: 'number_sell'},
                    {data: 'sum_sell', name: 'sum_sell'},
                    {data: 'paymentMethod', name: 'paymentMethod'},
                    {data: 'invoiceType', name: 'invoiceType'},
                    {data: 'status', name: 'status'},
                    {data: 'price_sell', name: 'price_sell'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });
        }
        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != '')
            {
                $('#data-table').DataTable().destroy();
                load_data(from_date, to_date);
            }
            else
            {
                Swal.fire({
                    title: 'توجه',
                    text: 'بازه تاریخ مورد نظر را انتخاب کنید!',
                    icon: 'info',
                    confirmButtonText: 'تایید'
                });

            }
        });
        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#data-table').DataTable().destroy();
            load_data();
        });

        $(document).on('click', '#bulk_delete', function () {
            var id = [];
            Swal.fire({
                title: 'حذف؟',
                text: "مشخصات حذف شده قابل بازیابی نیستند!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $('.student_checkbox:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: "{{ route('ajaxdata.massremove')}}",
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                $('#data-table').DataTable().ajax.reload();
                                Swal.fire({
                                    title: 'موفق',
                                    text: 'مشخصات با موفقیت از سیستم حذف شد',
                                    icon: 'success',
                                    confirmButtonText: 'تایید'
                                });


                            }
                        });

                    } else {
                        Swal.fire({
                            title: 'توجه',
                            text: 'پیش فاکتوری برای حذف انتخاب نشده است!',
                            icon: 'info',
                            confirmButtonText: 'تایید'
                        });


                    }
                }
            });


        });

        $('body').on('click', '.question', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.invoice.update.trash') }}" + '/' + id, function (data) {
                $('#ajaxModelQuestion').modal('show');
                $('#description_c').val(data.description);
                $('#id_trash').val(id);
                $('#cancellation').val(data.cancellation);

            });
            $('#saveRestore').click(function (e) {
                e.preventDefault();
                $('#saveRestore').text('در حال بازگردانی اطلاعات...');
                $('#saveRestore').prop("disabled", true);
                var form = $('#CustomerCanceled')[0];
                var data = new FormData(form);

                $('#ajaxModelDelete').modal('hide');
                Swal.fire({
                    title: 'بازگشت پیش فاکتور به لیست؟',
                    text: "آیا از بازگشت پیش فاکتور به لیست اطمینان دارید!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'بازگردانی',
                    cancelButtonText: 'انصراف',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "GET",
                            url: "{{route('admin.invoice.RestoreDelete')}}" + '/' + id,
                            success: function (data) {
                                $('#data-table').DataTable().ajax.reload();
                                Swal.fire({
                                    title: 'موفق',
                                    text: 'مشخصات پیش فاکتور با موفقیت به لیست پیش فاکتورها برگشت',
                                    icon: 'success',
                                    confirmButtonText: 'تایید'
                                });


                            }
                        });
                        $('#id_delete').val('');
                        $('#cancellation').val('');
                        $('#description').val('');
                    }

                });
                $('#saveRestore').text('بازگردانی');
                $('#saveRestore').prop("disabled", false);

            });
            $('#saveDelete').click(function (e) {
                e.preventDefault();
                $('#saveDelete').text('در حال حذف اطلاعات...');
                $('#saveDelete').prop("disabled", true);
                var form = $('#CustomerCanceled')[0];
                var data = new FormData(form);

                $('#ajaxModelDelete').modal('hide');
                Swal.fire({
                    title: 'حذف پیش فاکتور؟',
                    text: "مشخصات پیش فاکتور حذف شده قابل بازیابی نخواهد بود!",
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
                            url: "{{route('admin.invoice.AdminDelete')}}" + '/' + id,
                            data: {
                                '_token': $('input[name=_token]').val(),
                            },
                            success: function (data) {
                                $('#data-table').DataTable().ajax.reload();
                                Swal.fire({
                                    title: 'موفق',
                                    text: 'مشخصات پیش فاکتور با موفقیت از سیستم حذف شد',
                                    icon: 'success',
                                    confirmButtonText: 'تایید'
                                });

                            }
                        });
                        $('#id_delete').val('');
                        $('#cancellation').val('');
                        $('#description').val('');
                    }

                });
                $('#saveDelete').text('حذف');
                $('#saveDelete').prop("disabled", false);

            });


        });


        $("#select_all").change(function () {
            $(".student_checkbox").prop('checked', $(this).prop('checked'));
        });


        $("#show").click(function () {

            if ($('input:checkbox').prop("checked", true)) {
                alert(selectedIds)
            }
            var ids = '';
            $('input:checked:checked').each(function () {
                ids = selectedIds + ','
            });
            alert(ids);

        });


    });


    $('#sell').addClass('active');


</script>

