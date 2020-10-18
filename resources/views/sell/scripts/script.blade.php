<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
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
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e8ecff');
            },
            "bInfo": false,
            "paging": false,
            "bPaginate": false,
            "columnDefs": [
                {"orderable": false, "targets": 0},
            ],
            "order": [[ 9, "desc" ]],
            "ordering": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.invoice.index') }}",
            "deferRender": true,
            columns: [
                {data: 'invoiceNumber', name: 'invoiceNumber', "className": "dt-center"},
                {data: 'create', name: 'create'},
                {data: 'user_id', name: 'user_id'},
                {data: 'customer_id', name: 'customer_id'},
                {data: 'number_sell', name: 'number_sell'},
                {data: 'paymentMethod', name: 'paymentMethod'},
                {data: 'invoiceType', name: 'invoiceType'},
                {data: 'status', name: 'status'},
                {data: 'price_sell', name: 'price_sell'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

        $('body').on('click', '.SuccessCustomer', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.invoice.update.confirm') }}" + '/' + id, function (data) {
                $('#ajaxModel').modal('show');
                $('#name').val(data.name);
                $('#date').val(data.date);
                $('#HowConfirm').val(data.HowConfirm);
                $('#description').val(data.description);
                $('#invoice_id').val(data.invoice_id);
                $('#id_in').val(id);

            })
        });

        $('body').on('click', '.deleteProduct', function () {
            $('#id_delete').val('');
            $('#description_c').val('');
            var id = $(this).data("id");
            $('#id_delete').val(id);
            $('#ajaxModelDelete').modal('show');

            $('#saveCancel').click(function (e) {
                e.preventDefault();

                var form = $('#CustomerCanceled')[0];
                var data = new FormData(form);

                $('#ajaxModelDelete').modal('hide');

                Swal.fire({
                    title: 'لغو پیش فاکتور؟',
                    text: "مشخصات پیش فاکتور لغو شده فقط توسط مدیریت قابل بازیابی میباشد!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'حذف',
                    cancelButtonText: 'انصراف',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            data: data,
                            url: "{{ route('admin.invoice.delete') }}",
                            cache: false,
                            contentType: false,
                            processData: false,
                            method: 'POST',
                            type: 'POST',
                            success: function (data) {
                                $('#data-table').DataTable().ajax.reload();
                                Swal.fire({
                                    title: 'موفق',
                                    text: 'مشخصات پیش فاکتور با موفقیت از لیست شما حذف شد',
                                    icon: 'success',
                                    confirmButtonText: 'تایید'
                                });

                            }
                        });
                        $('#id_delete').val('');
                        $('#description').val('');
                    }

                });


            });

        });

        $('body').on('click', '.validate', function () {
            var id = $(this).data("id");

            Swal.fire({
                title: 'تایید پیش فاکتور؟',
                text: "ارسال پیش فاکتور برای مدیریت!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'تایید',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.invoice.customers.validate')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#data-table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'موفق',
                                text: 'پیش فاکتور برای تایید به مدیریت ارسال شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })





        });







        $('body').on('click', '.many', function () {
            var id = $(this).data("id");
            $.get("{{ route('admin.invoice.customers.many') }}" + '/' + id, function (data) {
                $('#ajaxModelCustomerMany').modal('show');
                $('#description_m').val(data.description);
                $('#Checkback').val(data.Checkback);
                $('#Checkbackintheflow').val(data.Checkbackintheflow);
                $('#accountbalance').val(data.accountbalance);
                $('#Averagetimedelay').val(data.Averagetimedelay);
                $('#Futurefactors').val(data.Futurefactors);
                $('#Receiveddocuments').val(data.Receiveddocuments);
                $('#Openaccountbalance').val(data.Openaccountbalance);
                $('#paymentmethod').val(data.paymentmethod);

                $('#many_id').val(id);


            })

        });

        $('body').on('click', '.Print', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.invoice.check.print') }}" + '/' + id, function (data) {
                $('#ajaxModelPrint').modal('show');
                $('#selectstoressss').val(data.selectstores_id);
                $('#name_bankkk').val(data.bank_id);
                $('#dateeee').val(data.date);
                $('#timee').val(data.time);
                $('#descriptionnn').val(data.description);
            });
            $('#PrintSell').click(function (e) {
                var user = $('#CustomerPrint').serialize();
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.invoice.print')}}?id=" + id,
                    data: user,
                    dataType: 'html',
                    success: function (res) {
                        if (res.errors) {
                            $('#ajaxModelPrint').modal('hide');
                            jQuery.each(data.errors, function (key, value) {
                                Swal.fire({
                                    title: 'خطا!',
                                    text: value,
                                    icon: 'error',
                                    confirmButtonText: 'تایید'
                                })
                            });
                        }
                        if (res) {
                            w = window.open(window.location.href, "_blank");
                            w.document.open();
                            w.document.write(res);
                            w.document.close();
                            w.location.reload();
                            $('#CustomerPrint').trigger("reset");
                            id = null;
                        } else {
                            id = null;
                        }
                    }
                });


            });
        });

        $('body').on('click', '.Confirmpayment', function () {
            var id = $(this).data("id");
            $('#Confirmpayment').modal('show');
            $('#invoice_id_payment').val(id);
        });

        $('#savePaymentConfirm').click(function (e) {
            e.preventDefault();
            $('#savePaymentConfirm').text('در حال ثبت اطلاعات...');
            $('#savePaymentConfirm').prop("disabled", true);
            var form = $('#PaymentConfirm')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{ route('admin.invoice.payment.confrim.store') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function (data) {
                    if (data.errors) {
                        $('#Confirmpayment').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#savePaymentConfirm').text('ثبت');
                        $('#savePaymentConfirm').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#PaymentConfirm').trigger("reset");
                        $('#Confirmpayment').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#savePaymentConfirm').text('ثبت');
                        $('#savePaymentConfirm').prop("disabled", false);
                    }
                }
            });
        });

        $('#saveConfirm').click(function (e) {
            e.preventDefault();
            $('#saveConfirm').text('در حال ثبت اطلاعات...');
            $('#saveConfirm').prop("disabled", true);
            var form = $('#CustomerConfirm')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                data: data,
                url: "{{ route('admin.invoice.confirm.customer') }}",
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
                        $('#saveConfirm').text('ثبت');
                        $('#saveConfirm').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#CustomerConfirm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'تاییده مشتری برای این پیش فاکتور در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveConfirm').text('ثبت');
                        $('#saveConfirm').prop("disabled", false);
                    }
                }
            });
        });

        $('#name_bank').change(function () {
            var name_bank = $(this).val();
            $('#name_bank').val(name_bank);

        });

        $('#saveCustomerValidate').click(function (e) {
            e.preventDefault();
            $('#saveCustomerValidate').text('در حال ثبت اطلاعات...');
            $('#saveCustomerValidate').prop("disabled", true);
            var form = $('#CustomersValidate')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                data: data,
                url: "{{ route('admin.invoice.customer.validate.store') }}",
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function (data) {
                    if (data.errors) {
                        $('#ajaxModelCustomer').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveCustomerValidate').text('ثبت');
                        $('#saveCustomerValidate').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#CustomersValidate').trigger("reset");
                        $('#ajaxModelCustomer').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق!',
                            text: 'سوابق مالی مشتری بررسی و تایید شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveCustomerValidate').text('ثبت');
                        $('#saveCustomerValidate').prop("disabled", false);
                    }
                }
            });
        });

        $('#saveCustomerMany').click(function (e) {
            e.preventDefault();
            $('#saveCustomerMany').text('در حال ثبت اطلاعات...');
            $('#saveCustomerMany').prop("disabled", true);
            var form = $('#CustomersMany')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                data: data,
                url: "{{ route('admin.invoice.customer.many.store') }}",
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function (data) {
                    if (data.errors) {
                        $('#ajaxModelCustomerMany').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveCustomerMany').text('ثبت');
                        $('#saveCustomerMany').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#CustomersMany').trigger("reset");
                        $('#ajaxModelCustomerMany').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'سابقه پرداخت مشتری با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveCustomerMany').text('ثبت');
                        $('#saveCustomerMany').prop("disabled", false);
                    }
                }
            });
        });

    });

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

    $('#sell').addClass('active');

</script>
