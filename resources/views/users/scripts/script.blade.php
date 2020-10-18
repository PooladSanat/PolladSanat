<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/jquery.maskedinput.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>

<meta name="_token" content="{{ csrf_token() }}"/>

<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#createNewProduct').click(function () {
            $('#ajaxModel').modal('show');
            $('#caption').text('افزودن کاربر');
            $('#id').val('');
            $('#name').val('');
            $('#email').val('');
            $('#phone').val('');
            $('#password').val('');
            $('#select2-example').val('');
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
            "order": [[7, "deesc"]],
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.user.show') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , "className": "dt-center"},
                {data: 'name', name: 'name'},
                {data: 'role_name', name: 'role_name'},
                {data: 'user_name', name: 'user_name'},
                {data: 'phone', name: 'phone'},
                {data: 'online', name: 'online'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],

        });

        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.user.u') }}" + '/' + product_id, function (data) {
                $('#ajaxModel').modal('show');
                $('#caption').text('ویرایش کاربر');
                $('#id').val(data.product.id);
                $('#name').val(data.product.name);
                $('#email').val(data.product.email);
                $('#phone').val(data.product.phone);
                for (var i in data.roles) {
                    $('#select2-example').val(data.roles[i].id);
                }


            })
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $('#saveBtn').text('در حال ثبت اطلاعات...');
            $('#saveBtn').prop("disabled", true);
            var form = $('#productForm')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{ route('admin.user.store') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
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
                        $('#ajaxModel').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات کاربر با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);

                    }

                }
            });
        });

        $('body').on('click', '.status', function () {
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "{{route('admin.user.disable')}}" + '/' + id,
                success: function (data) {
                    if (data.errors) {
                        table.draw();
                        Swal.fire({
                            title: 'موفق!',
                            text: data.errors,
                            icon: 'error',
                            confirmButtonText: 'تایید'
                        })
                    }
                    if (data.success) {
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: data.success,
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });

                    }

                }
            });
        });

        jQuery(function ($) {
            $("#phone").mask("99999999999");
        });

        $('#admin-user').addClass('active');
    });
</script>
