<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/jquery.maskedinput.js')}}" type="text/javascript"></script>
<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
        <?php
        $reasons = \App\ReasonsToStop::all();
        ?>
    var reasons = [];
    @foreach($reasons as $reason)
    reasons.push({'id': '{{$reason->id}}', 'type': '{{$reason->type}}'});
    @endforeach
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var device1 = $('.device1').DataTable({
            processing: true,
            serverSide: true,
            "searching": false,
            "lengthChange": false,
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e8ecff');
            },
            "bInfo": false,
            "paging": false,
            "bPaginate": false,
            "columnDefs": [
                {"orderable": false, "targets": 0},
            ],
            "order": [[ 7, "desc" ]],
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.Manufacturing.device1.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'format', name: 'format'},
                {data: 'insert', name: 'insert'},
                {data: 'numberproduced', name: 'numberproduced'},
                {data: 'action1', name: 'action1'},

            ]
        });
        var detail_stop1 = $('.detail_stop1').DataTable({
            processing: true,
            serverSide: true,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "bSort": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.devicestop.device1.list') }}",
            columns: [
                {data: 'Minutes', name: 'Minutes'},
                {data: 'user_id', name: 'user_id'},
                {data: 'reasons', name: 'reasons'},
                {data: 'reasons_id', name: 'reasons_id'},
                {data: 'format_id', name: 'format_id'},
                {data: 'insert_id', name: 'insert_id'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action'},

            ]
        });
        var device2 = $('.device2').DataTable({
            processing: true,
            serverSide: true,
            rowreorder: true,
            retrieve: true,
            aaSorting: [],
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "bSort": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.Manufacturing.device2.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'format', name: 'format'},
                {data: 'insert', name: 'insert'},
                {data: 'size', name: 'size'},
                {data: 'numberproduced', name: 'numberproduced'},
            ]
        });
        var device3 = $('.device3').DataTable({
            processing: true,
            serverSide: true,
            rowreorder: true,
            retrieve: true,
            aaSorting: [],
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "bSort": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.Manufacturing.device3.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'format', name: 'format'},
                {data: 'insert', name: 'insert'},
                {data: 'size', name: 'size'},
                {data: 'numberproduced', name: 'numberproduced'},
            ]
        });


        $('body').on('click', '.start1', function () {
            var id = $(this).data("id");
            Swal.fire({
                title: 'شروع تولید؟',
                text: "وضعیت این سفارش به در حال تولید تغیر کند!",
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
                        url: "{{route('admin.Manufacturing.device1.start')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            if (data.success) {
                                $('#device1').DataTable().ajax.reload();
                                Swal.fire({
                                    title: 'موفق',
                                    text: 'وضعیت سفارش با موفقیت به درحال تولید تغیر کرد',
                                    icon: 'success',
                                    confirmButtonText: 'تایید'
                                })
                            }
                            if (data.error) {
                                $('#device1').DataTable().ajax.reload();
                                Swal.fire({
                                    title: 'موفق',
                                    text: 'خطایی در سیستم رخ داده است لطفا روباره تلاش کنید!',
                                    icon: 'error',
                                    confirmButtonText: 'تایید'
                                })
                            }


                        }
                    });
                }
            })
        });
        $('body').on('click', '.add1', function () {
            var id = $(this).data("id");
            $('#productForm').trigger("reset");
            $('#add1').modal('show');
            $('#alert_error').hide();
            $('#saveBtn').text('ثبت');
            $('#saveBtn').prop('disabled', false);
            $('#alert_success').hide();
            $('#alert_warning').hide();
            $('#caption').text('ثبت اطلاعات تولید');
            $('#order_id').val(id);
            $('#id').val('');
            var detail_add = $('.detail_add').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                "searching": false,
                "lengthChange": false,
                "info": false,
                "bPaginate": false,
                "bSort": false,
                "language": {
                    "search": "جستجو:",
                    "lengthMenu": "نمایش _MENU_",
                    "zeroRecords": "موردی یافت نشد!",
                    "info": "نمایش _PAGE_ از _PAGES_",
                    "infoEmpty": "موردی یافت نشد",
                    "infoFiltered": "(جستجو از _MAX_ مورد)",
                    "processing": "در حال پردازش اطلاعات"
                },
                ajax: "{{ route('admin.Manufacturing.device1.detail1') }}" + "/" + id,

                columns:
                    [
                        {data: 'production', name: 'production'},
                        {data: 'usable', name: 'usable'},
                        {data: 'unusable', name: 'unusable'},
                        {data: 'cycletime', name: 'cycletime'},
                        {data: 'user_id', name: 'user_id'},
                        {data: 'data', name: 'data'},
                        {data: 'time', name: 'time'},
                        {data: 'action', name: 'action'},

                    ]
            });
        });
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $('#saveBtn').text('در حال ثبت اطلاعات...');
            $('#saveBtn').prop("disabled", true);
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.Manufacturing.device1.add') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#add1').modal('hide');
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
                        $('#add1').modal('hide');
                        device1.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'اطلاعات با موفقیا برای این سفارش ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);
                    }
                }
            });
        });
        $('body').on('click', '.edit1', function () {
            var id = $(this).data("id");
            $('#saveBtn').text('ویرایش');
            $.ajax({
                type: 'GET',
                url: "{{route('admin.Manufacturing.device1.edit')}}" + '/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function (data) {
                    $('#production').val(data.production);
                    $('#usable').val(data.usable);
                    $('#unusable').val(data.unusable);
                    $('#cycletime').val(data.cycletime);
                    $('#id').val(data.id);
                }
            });
        });
        $('body').on('click', '.delete1', function () {
            $('#add1').modal('hide');
            var id = $(this).data("id");
            Swal.fire({
                title: 'حذف مشخصات تولید!',
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
                        url: "{{route('admin.Manufacturing.device1.delete')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#device1').DataTable().ajax.reload();
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
        $('body').on('click', '.delete_stop1', function () {
            $('#stop1').modal('hide');
            var id = $(this).data("id");
            Swal.fire({
                title: 'حذف مشخصات توقف دستگاه!',
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
                        url: "{{route('admin.Manufacturing.device1.stop.delete')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#detail_stop1').DataTable().ajax.reload();
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
        $('#BtnStop').click(function () {
            var id = $(this).data("id");
            $('#updateform').trigger("reset");
            $('#updateBtn').text('ثبت');
            $('#stop1').modal('show');
            $('#saveBtn').text('ثبت');
            $('#saveBtn').prop('disabled', false);
            $('#caption1').text('ثبت توقفات ماشین');
            $('#order_id_stop').val(id);
            $('#id').val('');
        });
        $('#updateBtn').click(function (e) {
            e.preventDefault();
            $('#saveBtn').text('در حال ثبت اطلاعات...');
            $('#saveBtn').prop("disabled", true);
            $.ajax({
                data: $('#updateform').serialize(),
                url: "{{ route('admin.Manufacturing.device1.stop') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#updateform').trigger("reset");
                    $('#stop1').modal('hide');
                    detail_stop1.draw();
                    Swal.fire({
                        title: 'موفق',
                        text: 'مشخصات با موفقیت در سیستم ثبت شد',
                        icon: 'success',
                        confirmButtonText: 'تایید',
                    });
                    $('#saveBtn').text('ثبت');
                    $('#saveBtn').prop("disabled", false);
                }
            });
        });
        $('body').on('click', '.edit_stop1', function () {
            var id = $(this).data("id");
            $('#updateBtn').text('ویرایش');
            $.ajax({
                type: 'GET',
                url: "{{route('admin.Manufacturing.device1.stop.edit')}}" + '/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function (data) {
                    $('#date').val(data.indate);
                    $('#idd').val(data.id);
                    $('#todate').val(data.tordate);
                    $('#time').val(data.time);
                    $('#totime').val(data.totime);
                    $('#totime').val(data.totime);
                    $('#format').val(data.format_id);
                    $('#reason').val(data.reasons);
                    $('#insert').val(data.insert_id);
                    $('#description').val(data.description);

                    $('#type')
                        .find('option')
                        .remove();
                    for (var i in reasons) {
                        if (reasons[i].id == data.reasons_id) {
                            $("#type").append('<option value="' + reasons[i].id + '">' + reasons[i].type + '</option>');
                        }
                    }

                }
            });
        });


        $('#reason').change(function () {
            var commodityID = $(this).val();
            if (commodityID) {
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.list.Reasonstostop')}}?commodity_id=" + commodityID,
                    success: function (res) {
                        if (res) {
                            $("#type").empty();
                            $("#type").append('<option>دلیل توقف را انتخاب کنید</option>');
                            $.each(res, function (key, value) {
                                $("#type").append('<option value="' + key + '">' + value + '</option>');
                            });

                        } else {
                            $("#type").empty();
                        }
                    }
                });
            } else {
                $("#type").empty();
            }
        });
        $('#cycletime' + ',#production' + ',#usable' + ',#unusable').keyup(function () {
            var data = $("#productForm").serialize();
            $.ajax({
                url: "{{route('admin.Manufacturing.device1.check')}}",
                data: data,
                dataType: 'json',
                type: 'POST',
                async: false,
                success: function (data) {
                    if (data == 'null') {
                        $('#saveBtn').prop('disabled', false);
                        $('#alert_error').hide(500);
                        $('#text_error').text('');
                        $('#alert_warning').hide(500);
                        $('#text_warning').text('');
                        $('#alert_success').hide(500);
                        $('#text_success').text('');
                    } else if (data.error) {
                        $('#saveBtn').prop('disabled', true);
                        $('#alert_success').hide(500);
                        $('#alert_warning').hide(500);
                        $('#alert_error').show(500);
                        $('#text_error').text(data.error);
                    } else if (data.warning) {
                        $('#saveBtn').prop('disabled', false);
                        $('#alert_error').hide(500);
                        $('#alert_success').hide(500);
                        $('#alert_warning').show(500);
                        $('#text_warning').text(data.warning);
                    } else if (data.success) {
                        $('#saveBtn').prop('disabled', false);
                        $('#alert_error').hide(500);
                        $('#alert_warning').hide(500);
                        $('#alert_success').show(500);
                        $('#text_success').text(data.success);
                    }
                }
            });
        });


    });
    jQuery(function ($) {
        $("#time").mask("99:99");
        $("#totime").mask("99:99");
    });
    $('#manufacturing').addClass('active');
</script>


