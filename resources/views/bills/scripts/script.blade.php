<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/jquery.maskedinput.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/datatab.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/row.js')}}" type="text/javascript"></script>
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
    var id_id = null;
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_data();

        function load_data(customer_id = '', indate = '', todate = '') {
            $('.data-table').DataTable({
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
                "order": [[6, "desc"]],
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

                ajax: {
                    ajax: "{{ route('admin.bills.list') }}",
                    data:
                        {
                            customer_id: customer_id,
                            indate: indate,
                            todate: todate,
                        }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'customer', name: 'customer'},
                    {data: 'price', name: 'price'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        }

        $('#filter').click(function () {
            var customer_id = $('#customer_id').val();
            var indate = $('#indate').val();
            var todate = $('#todate').val();
            $('.data-table').DataTable().destroy();
            load_data(customer_id, indate, todate);
        });

        $('body').on('click', '.detail-eye', function () {

            $('.type').remove();
            $('.shenase').remove();
            $('.price').remove();
            $('.date').remove();
            $('.actiont').remove();
            $('.user_name').remove();
            $('.name').remove();
            id_id = $(this).data('id');
            $.get("{{ route('admin.payment.update') }}" + '/' + id_id, function (data) {
                $('#gfgf').DataTable().destroy();
                $('#ajaxModel').modal('show');
                $('#customer_ider').val(id_id);
                $('#cname').val(data.name.name);
                $('#cprice').val(data.price);
                $('#cpriicee').val(data.pricee);
                $('#cupdate').val(data.date);
                $('#pricesum').val(data.sum);
                $('#pricesuumm').val(data.summ);
                $('#customer_ideeeer').val(data.name_customer);
                $('#fac').val(data.pack);


                var table1 = $('.gfgf').DataTable({
                    processing: true,
                    serverSide: true,
                    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        $('td:eq(0)', nRow).css('background-color', '#e8ecff');
                        $('#sortsort').text('جزییات صورتحساب' + " " + aData.sort);
                    },
                    "bInfo": false,
                    "paging": false,
                    "bPaginate": false,
                    "columnDefs": [
                        {"orderable": false, "targets": 0},
                    ],
                    "order": [[6, "desc"]],
                    "scrollY": "150px",
                    "scrollCollapse": true,

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
                        url: "{{ route('admin.payment.list.list') }}",
                        data: {
                            id_id: id_id,
                        },
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                        {data: 'type', name: 'type'},
                        {data: 'shenase', name: 'shenase'},
                        {data: 'date', name: 'date'},
                        {data: 'name', name: 'name'},
                        {data: 'name_user', name: 'name_user'},
                        {data: 'price', name: 'price'},
                        {data: 'descriptionn', name: 'descriptionn'},
                        {data: 'actioon', name: 'actioon'},
                    ]
                });

            })


        });

        $('body').on('click', '.detail-admin', function () {
            id_id = $(this).data('id');
            $.get("{{ route('admin.payment.updatee') }}" + '/' + id_id, function (data) {
                $('#ajaxadmin').modal('show');
                $('#customer_iderr').val(id_id);
                $('#cnamee').val(data.name.name);
                $('#cid').val(data.name.id);
                $('#cpricee').val(data.price);
                $('#cpriceee').val(data.pricee);
                $('#cupdatee').val(data.date);
                $('#des').val(data.clearing.description);
                $('#pricesumm').val(data.sum);
                $('#pricesummm').val(data.summ);
                $('#pricessummm').val(data.summ);
                $('#price_customer_payment').val(data.detail_customer);
                $('#detail_customersa').val(data.detail_customersa);
                $('#recive_customer_payment').val(data.recive_customer);
                $('#document_customer_payment').val(data.customer_payment);
                $('#factor_customer_payment').val(data.factor_customer);
                $('#b1').text(data.sum);
                $('#p1').text(data.detail_customer);
                $('#p11').val(data.detail_customersa);
                $('#m1').text(data.baghi);
                $('#f1').text(data.final);

            });

            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            }

            $('#statussort').DataTable().destroy();
            $('.statussort').DataTable({
                processing: true,
                serverSide: true,
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    if (parseInt(aData.s) > 0) {
                        $('td:eq(5)', nRow).css('background-color', 'rgba(0,183,255,0.37)');
                    } else if (parseInt(aData.s) < 0) {
                        $('td:eq(5)', nRow).css('background-color', 'rgba(255,0,0,0.4)');
                    } else {
                        $('td:eq(5)', nRow).css('background-color', '#f8f4ff');
                    }

                    $("#aaaaa").text(formatNumber(aData.a)).css('background-color', 'rgba(255,0,0,0.4)');
                    $("#bbbbb").text(formatNumber(aData.b)).css('background-color', 'rgba(0,183,255,0.37)');
                    ;
                    var ff = aData.b - aData.a;
                    if (ff > 0) {
                        $("#cccc").text(formatNumber(Math.abs(ff))).css('background-color', 'rgba(0,183,255,0.37)');

                    } else if (ff < 0) {
                        $("#cccc").text(formatNumber(Math.abs(ff))).css('background-color', 'rgba(255,0,0,0.4)');

                    } else if (ff == 0) {
                        $("#cccc").text(formatNumber(Math.abs(ff))).css('background-color', '#f8f4ff');

                    }
                    if (aData.sort == 0) {
                        $('#sssss').text(formatNumber(aData.sort)).css('background-color', '#f8f4ff');

                    } else {
                        $('#sssss').text(formatNumber(aData.sort)).css('background-color', 'rgba(255,0,0,0.4)');

                    }
                    if (ff - aData.sort < 0) {
                        $('#sdsdsdsds').text(formatNumber(Math.abs(ff - aData.sort))).css('background-color', 'rgba(255,0,0,0.4)');

                    } else if (ff - aData.sort > 0) {
                        $('#sdsdsdsds').text(formatNumber(Math.abs(ff - aData.sort))).css('background-color', 'rgba(0,183,255,0.37)');

                    } else if (ff - aData.sort == 0) {
                        $('#sdsdsdsds').text(formatNumber(Math.abs(ff - aData.sort))).css('background-color', '#f8f4ff');
                    }

                },
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
                    url: "{{ route('admin.payment.list.detail.statussort') }}",
                    data: {
                        detail_factor: id_id,
                    },
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'price', name: 'price'},
                    {data: 'payment', name: 'payment'},
                    {data: 'ss', name: 'ss'},
                ]
            });

        });

        $('#admin').click(function (e) {
            e.preventDefault();
            $('#admin').text('در حال ثبت اطلاعات...');
            $('#admin').prop("disabled", true);
            $.ajax({
                data: $('#productFoerm').serialize(),
                url: "{{ route('admin.payment.store.admin') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#ajaxadmin').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#admin').text('ثبت');
                        $('#admin').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#productFoerm').trigger("reset");
                        $('#ajaxadmin').modal('hide');
                        $('.data-table').DataTable().draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#admin').text('ثبت');
                        $('#admin').prop("disabled", false);
                    }
                }
            });
        });

        $('#createNewProduct').click(function () {
            $('#productForm').trigger("reset");
            $('#ajaxModel').modal('show');
            $('#caption').text('افزودن حساب بانکی');
            $('#id').val('');
        });

        $('body').on('click', '.editProduct', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.bank.update') }}" + '/' + id, function (data) {
                $('#ajaxModel').modal('show');
                $('#caption').text('ویرایش حساب بانکی');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#NameBank').val(data.NameBank);
                $('#CardNumber').val(data.CardNumber);
                $('#AccountNumber').val(data.AccountNumber);
                $('#ShabaNumber').val(data.ShabaNumber);
                $('#status').val(data.status);
            })
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $('#saveBtn').text('در حال ثبت اطلاعات...');
            $('#saveBtn').prop("disabled", true);
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.CustomerAccount.store') }}",
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
                        $('.data-table').DataTable().draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);
                    }
                }
            });
        });

        $('#saveBtnedit').click(function (e) {
            e.preventDefault();
            $('#ajaxModel').modal('hide');
            $('#saveBtnedit').text('در حال ثبت اطلاعات...');
            $('#saveBtnedit').prop("disabled", true);
            $.ajax({
                data: $('#productFormedit').serialize(),
                url: "{{ route('admin.payment.edit.update') }}",
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
                        $('#saveBtnedit').text('ثبت');
                        $('#saveBtnedit').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#productFormedit').trigger("reset");
                        $('#ajaxModeledit').modal('hide');
                        $('#gfgf').DataTable().draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        }).then((result) => {
                            $('#gfgf').DataTable().draw();
                            $.get("{{ route('admin.payment.update') }}" + '/' + id_id, function (data) {
                                $('#gfgf').DataTable().destroy();
                                $('#ajaxModel').modal('show');
                                $('#customer_ider').val(id_id);
                                $('#cname').val(data.name.name);
                                $('#cprice').val(data.price);
                                $('#cpriicee').val(data.pricee);
                                $('#cupdate').val(data.date);
                                $('#pricesum').val(data.sum);
                                $('#pricesuumm').val(data.summ);
                                $('#customer_ideeeer').val(data.name_customer);
                            })
                        });
                        $('#saveBtnedit').text('ثبت');
                        $('#saveBtnedit').prop("disabled", false);
                    }
                }
            });
        });

    });

    $('body').on('click', '.detail-gate-admin', function () {
        var id = $(this).data("id");
        Swal.fire({
            title: 'ارجاع به مدیریت برای تایید نهایی!',
            text: "صورت حساب برای تایید نهایی به مدیریت ارسال میشود!",
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
                    url: "{{route('admin.payment.success.admin')}}" + '/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        $('.data-table').DataTable().draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'صورت حساب با موفقیت به مدیریت ارسال شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        })
                    }
                });
            }
        })
    });

    $('body').on('click', '.detail-trash', function () {
        $('#ajaxModel').modal('hide');
        var id = $(this).data("id");
        Swal.fire({
            title: 'حذف پرداخت مشتری!',
            text: "پرداخت مشتری از حسابش کم خواهد شد!",
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
                    url: "{{route('admin.payment.trash')}}" + '/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        Swal.fire({
                            title: 'موفق',
                            text: 'پرداخت مشتری با موفقیت از سیستم حذف شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        }).then((result) => {
                            $('#gfgf').DataTable().draw();
                            $.get("{{ route('admin.payment.update') }}" + '/' + id_id, function (data) {
                                $('#gfgf').DataTable().destroy();
                                $('#ajaxModel').modal('show');
                                $('#customer_ider').val(id_id);
                                $('#cname').val(data.name.name);
                                $('#cprice').val(data.price);
                                $('#cpriicee').val(data.pricee);
                                $('#cupdate').val(data.date);
                                $('#pricesum').val(data.sum);
                                $('#pricesuumm').val(data.summ);
                                $('#customer_ideeeer').val(data.name_customer);
                            })
                        });
                    }
                });
            } else {
                $('#gfgf').DataTable().draw();
                $.get("{{ route('admin.payment.update') }}" + '/' + id_id, function (data) {
                    $('#gfgf').DataTable().destroy();
                    $('#ajaxModel').modal('show');
                    $('#customer_ider').val(id_id);
                    $('#cname').val(data.name.name);
                    $('#cprice').val(data.price);
                    $('#cpriicee').val(data.pricee);
                    $('#cupdate').val(data.date);
                    $('#pricesum').val(data.sum);
                    $('#pricesuumm').val(data.summ);
                    $('#customer_ideeeer').val(data.name_customer);
                })
            }
        })
    });

    $('body').on('click', '.detail-edit', function () {
        var id = $(this).data('id');
        $.get("{{ route('admin.payment.edit') }}" + '/' + id, function (data) {
            $('#ajaxModeledit').modal('show');
            $('#id_detail').val(id);
            $('#tyypee').val(data.type);
            $('#shenasee').val(data.shenase);
            $('#naamee').val(data.name);
            $('#daatee').val(data.date);
            $('#name_userr').val(data.name_user);
            $('#prricee').val(data.price);
            $('#descriptionnnmnmn').val(data.descriptionn);
        })
    });

    $('body').on('click', '.detail-factor', function () {

        var detail_factor = $(this).data('id');
        $('#ajaxModellistr').modal('show');
        $('#factor').DataTable().destroy();
        $('.factor').DataTable({
            processing: true,
            serverSide: true,
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('#capsort').text('جزییات صورتحساب' + " " + aData.sort);
            },
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
                url: "{{ route('admin.payment.list.detail.factor') }}",
                data: {
                    detail_factor: detail_factor,
                },
            },
            columns: [
                {data: 'pack', name: 'pack', "className": "dt-center"},
                {data: 'customer', name: 'customer'},
                {data: 'user', name: 'user'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'total', name: 'total'},
                {data: 'created_at', name: 'created_at'},
            ],
            rowsGroup:
                [
                    0, 1, 2, 6
                ],

        });


    });

    jQuery(function ($) {
        $("#CardNumber").mask("9999-9999-9999-9999");
    });

    $('#payment').addClass('active');

</script>
<script language="javascript">


    added_inputs2_array = [];
    if (added_inputs2_array.length >= 1)
        for (var a in added_inputs2_array)
            added_inputs_array_table2(added_inputs2_array[a], a);


    function added_inputs_array_table2(data, a) {

        var myNode = document.createElement('div');
        myNode.id = 'typee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'type" + a + "\'  name=\"type[]\"\n" +
            "class=\"form-control type\"/>" +
            "<option>انتخاب کنید</option>" +
            "<option value='2'>چک</option>" +
            "<option value='1'>فیش حواله</option>" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('typee').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'shanasee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"number\" id=\'shenase" + a + "\'  name=\"shenase[]\"\n" +
            "class=\"form-control shenase\"/>" +
            "</div></div></div>";
        document.getElementById('shanasee').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'namee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'name" + a + "\'  name=\"name[]\"\n" +
            "class=\"form-control name\"/>" +
            "<option value=''>انتخاب کنید</option>" +
            "<option value='بانک ملّی ایران'>بانک ملّی ایران\n" +
            "\n</option>" +
            "<option value='بانک سپه'>بانک سپه\n" +
            "\n</option>" +
            "<option value='بانک صنعت و معدن'>بانک صنعت و معدن\n" +
            "\n</option>" +
            "<option value='بانک کشاورزی'>بانک کشاورزی\n" +
            "\n</option>" +
            "<option value='بانک مسکن'>بانک مسکن\n" +
            "\n</option>" +
            "<option value='بانک توسعه صادرات ایران'>بانک توسعه صادرات ایران\n" +
            "\n</option>" +
            "<option value='بانک توسعه تعاون'>بانک توسعه تعاون\n" +
            "\n</option>" +
            "<option value='موسسه اعتباری توسعه تعاون'>موسسه اعتباری توسعه تعاون\n" +
            "\n</option>" +
            "<option value='پست بانک ایران'>پست بانک ایران\n" +
            "\n</option>" +
            "<option value='بانک اقتصاد نوین'>بانک اقتصاد نوین\n" +
            "\n</option>" +
            "<option value='بانک پارسیان'>بانک پارسیان\n" +
            "\n</option>" +
            "<option value='بانک کارآفرین'>بانک کارآفرین\n" +
            "\n</option>" +
            "<option value='بانک سامان'>بانک سامان\n" +
            "\n</option>" +
            "<option value='بانک سینا'>بانک سینا\n" +
            "\n</option>" +
            "<option value='بانک خاور میانه'>بانک خاور میانه\n" +
            "\n</option>" +
            "<option value='بانک شهر'>بانک شهر\n" +
            "\n</option>" +
            "<option value='بانک دی'>بانک دی\n" +
            "\n</option>" +
            "<option value='بانک صادرات'>بانک صادرات\n" +
            "\n</option>" +
            "<option value='بانک ملت'>بانک ملت\n" +
            "\n</option>" +
            "<option value='بانک تات'>بانک تات\n" +
            "\n</option>" +
            "<option value='بانک تجارت'>بانک تجارت\n" +
            "\n</option>" +
            "<option value='بانک رفاه'>بانک رفاه\n" +
            "\n</option>" +
            "<option value='بانک حکمت ایرانیان'>بانک حکمت ایرانیان\n" +
            "\n</option>" +
            "<option value='بانک گردشگری'>بانک گردشگری\n" +
            "\n</option>" +
            "<option value='بانک ایران زمین'>بانک ایران زمین\n" +
            "\n</option>" +
            "<option value='بانک قوامین'>بانک قوامین\n" +
            "\n</option>" +
            "<option value='بانک انصار'>بانک انصار\n" +
            "\n</option>" +
            "<option value='بانک آینده'>بانک آینده\n" +
            "\n</option>" +
            "<option value='بانک سرمایه'>بانک سرمایه\n" +
            "\n</option>" +
            "<option value='بانک پاسارگاد'>بانک پاسارگاد\n" +
            "\n</option>" +
            "<option value='بانک مشترک ایران-ونزوئلا'>بانک مشترک ایران-ونزوئلا\n" +
            "\n</option>" +
            "<option value='بانک قرض‌الحسنه مهر ایران'>بانک قرض‌الحسنه مهر ایران\n" +
            "\n</option>" +
            "<option value='بانک قرض‌الحسنه رسالت'>بانک قرض‌الحسنه رسالت\n" +
            "\n</option>" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('namee').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'user_namee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'user_name" + a + "\'  name=\"user_name[]\"\n" +
            "class=\"form-control user_name\"/>" +
            "</div></div></div>";
        document.getElementById('user_namee').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'pricee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"number\" id=\'price" + a + "\'  name=\"price[]\"\n" +
            "class=\"form-control price\"/>" +
            "</div></div></div>";
        document.getElementById('pricee').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'datee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'date" + a + "\'  name=\"date[]\"\n" +
            "class=\"form-control date\"/>" +
            "</div></div></div>";
        document.getElementById('datee').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'descriptionn' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'descriptionnn" + a + "\'  name=\"descriptionnn[]\"\n" +
            "class=\"form-control date\"/>" +
            "</div></div></div>";
        document.getElementById('descriptionn').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'actiontt' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<button onclick='deleteService2(" + a + ", event)' class=\"form-control btn btn-danger actiont\"><i class=\"fa fa-remove\"></button></div>";
        document.getElementById('actiontt').appendChild(myNode);


    }

    function deleteService2(id, event) {
        event.preventDefault();
        $('#typee' + id).remove();
        $('#namee' + id).remove();
        $('#user_namee' + id).remove();
        $('#shanasee' + id).remove();
        $('#pricee' + id).remove();
        $('#datee' + id).remove();
        $('#descriptionn' + id).remove();
        $('#actiontt' + id).remove();

    }

    function addInput10() {


        var data = {
            'title': '',
            'icon': '',


        };
        added_inputs2_array.push(data);
        added_inputs_array_table2(data, added_inputs2_array.length - 1);
    }


</script>
<script>


    kamaDatepicker('indate',
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
    kamaDatepicker('todate',
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
    $(document).ready(function () {
        $('#customer_id').select2({
            width: '100%',
            dir: 'rtl',
            placeholder: 'مشتریان',
            language: {
                noResults: function () {
                    return 'مشتری با این نام یافت نشد';
                },
            },
        });
    });
</script>
