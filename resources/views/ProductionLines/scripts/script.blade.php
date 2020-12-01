<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/jquery.maskedinput.js')}}" type="text/javascript"></script>
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
                if (aData.status == 'بدون وضعیت') {
                    $('td:eq(0)', nRow).css('background-color', 'rgba(255,0,0,0.3)');
                } else if (aData.status == 'در حال تولید') {
                    $('td:eq(0)', nRow).css('background-color', 'rgba(0,255,45,0.27)');
                }
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
            ajax: "{{ route('admin.ProductionLines.list') }}",
            columns: [
                {data: 'name', name: 'name', "className": "dt-center"},
                {data: 'status', name: 'status'},
                {data: 'format', name: 'format'},
                {data: 'insert', name: 'insert'},
                {data: 'final', name: 'final'},
                {data: 'finaltime', name: 'finaltime'},
            ]
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

        $('body').on('click', '.device_list', function () {

            var id = $(this).data('id');
            $('#ajaxModel_device').modal('show');


            $("#information_datee").DataTable().destroy();
            $('.information_datee').DataTable({
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
                ajax: {
                    url: "{{ route('admin.ProductionLines.device.list') }}",
                    data: {
                        device_id: id,
                    },
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'id', name: 'id'},
                    {data: 'product', name: 'product'},
                    {data: 'color', name: 'color'},
                    {data: 'number', name: 'number'},
                    {data: 'hnumber', name: 'hnumber'},
                    {data: 'final', name: 'final'},
                    {data: 'qc', name: 'qc'},
                    {data: 'status', name: 'status'},
                    {data: 'actions', name: 'actions'},

                ]
            });

            $("#stop_datee").DataTable().destroy();
            $('.stop_datee').DataTable({
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
                ajax: {
                    url: "{{ route('admin.ProductionLines.stop.list') }}",
                    data: {
                        device_id: id,
                    },
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'date', name: 'date'},
                    {data: 'user', name: 'user'},
                    {data: 'inndate', name: 'inndate'},
                    {data: 'toodate', name: 'toodate'},
                    {data: 'ago', name: 'ago'},
                    {data: 'for', name: 'for'},
                    {data: 'desstop', name: 'desstop'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action'},
                ]
            });

            $('#createstop').click(function () {

                $('#ajaxModelStop').modal('show');
                $('#id_device').val(id);

            });

        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.bank.store') }}",
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
                            text: 'مشخصات حساب بانکی با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                    }
                }
            });
        });

        $('body').on('click', '.store_information', function () {
            var id = $(this).data('id');
            $('#id_id').val(id);
            $(".productsss").remove();
            $(".totalnumberrr").remove();
            $(".numberproducedss").remove();
            $(".hnumberrr").remove();
            $(".gnumberrr").remove();
            $(".wnumberrr").remove();
            $(".stimeee").remove();
            $.ajax({
                type: 'GET',
                url: "{{route('admin.ProductionLines.check')}}",
                data: {
                    'id': id,
                    '_token': $('input[name=_token]').val(),
                },
                success: function (data) {
                    $('#dateu').val(data.date);
                    $('#ajaxStore_information').modal('show');
                    added_inputs3_array = [];

                    var invoice_producte = {
                        'id': data.data.id,
                        'number': data.data.number,
                        'name_product': data.product,
                        'hnumber': data.production_store,
                        'stimee': data.stime.cycletime,
                    };
                    added_inputs3_array.push(invoice_producte);

                    if (added_inputs3_array.length >= 1)
                        for (var a in added_inputs3_array)
                            added_inputs_array_table3(added_inputs3_array[a], a);

                    function added_inputs_array_table3(data, a) {

                        var myNode = document.createElement('div');
                        myNode.id = 'products' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input readonly type=\"text\" id=\'productss" + a + "\'  name=\"productss[]\"\n" +
                            "class=\"form-control productsss\"/>" +
                            "</div></div></div>";
                        document.getElementById('products').appendChild(myNode);
                        $('#productss' + a + '').val(data.name_product);


                        var myNode = document.createElement('div');
                        myNode.id = 'totalnumber' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input readonly type=\"text\" id=\'totalnumberr" + a + "\'  name=\"totalnumberr[]\"\n" +
                            "class=\"form-control totalnumberrr\"/>" +
                            "</div></div></div>";
                        document.getElementById('totalnumber').appendChild(myNode);
                        $('#totalnumberr' + a + '').val(data.number);

                        var myNode = document.createElement('div');
                        myNode.id = 'numberproduced' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input readonly type=\"text\" id=\'numberproduceds" + a + "\'  name=\"numberproduceds[]\"\n" +
                            "class=\"form-control numberproducedss\"/>" +
                            "</div></div></div>";
                        document.getElementById('numberproduced').appendChild(myNode);
                        $('#numberproduceds' + a + '').val(data.hnumber);

                        var myNode = document.createElement('div');
                        myNode.id = 'hnumber' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input value='0' type=\"number\" id=\'hnumberr" + a + "\'  name=\"hnumberr[]\"\n" +
                            "class=\"form-control hnumberrr\"/>" +
                            "</div></div></div>";
                        document.getElementById('hnumber').appendChild(myNode);

                        var myNode = document.createElement('div');
                        myNode.id = 'gnumber' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input value='0' type=\"number\" id=\'gnumberr" + a + "\'  name=\"gnumberr[]\"\n" +
                            "class=\"form-control gnumberrr\"/>" +
                            "</div></div></div>";
                        document.getElementById('gnumber').appendChild(myNode);

                        var myNode = document.createElement('div');
                        myNode.id = 'wnumber' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input value='0' type=\"number\" id=\'wnumberr" + a + "\'  name=\"wnumberr[]\"\n" +
                            "class=\"form-control wnumberrr\"/>" +
                            "</div></div></div>";
                        document.getElementById('wnumber').appendChild(myNode);

                        var myNode = document.createElement('div');
                        myNode.id = 'stime' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input value='0' type=\"number\" id=\'stimee" + a + "\'  name=\"stimee[]\"\n" +
                            "class=\"form-control stimeee\"/>" +
                            "</div></div></div>";
                        document.getElementById('stime').appendChild(myNode);
                        $('#stimee' + a + '').val(data.stimee);

                    }
                }
            });


            $("#information_datee_list").DataTable().destroy();
            $('.information_datee_list').DataTable({
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
                ajax: {
                    url: "{{ route('admin.ProductionLines.device.list.production') }}",
                    data: {
                        device_id: id,
                    },
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'user', name: 'user'},
                    {data: 'date', name: 'date'},
                    {data: 'shift', name: 'shift'},
                    {data: 'hnumber', name: 'hnumber'},
                    {data: 'gnumber', name: 'gnumber'},
                    {data: 'wnumber', name: 'wnumber'},
                    {data: 'actio', name: 'actio'},

                ]
            });


        });

        $('body').on('click', '.play_product', function () {

            $('#ajaxModel_device').modal('hide');
            var id = $(this).data("id");
            Swal.fire({
                title: 'شرع به تولید برنامه!',
                text: "آیا از شروع به تولید این برنامه اطمینان دارید؟",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'شروع به تولید',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.viewproduct.start')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#data-table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'موفق',
                                text: 'برنامه مورد نظر با موفقیت شروع به تولید شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });

        $('body').on('click', '.pish_tolid', function () {
            var id = $(this).data('id');
            $('#id_pishtolid').val(id);
            $('#ajaxpishtolid').modal('show');

            $("#pish_date").DataTable().destroy();
            $('.pish_date').DataTable({
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
                ajax: {
                    url: "{{ route('admin.ProductionLines.pish.list.production') }}",
                    data: {
                        device_id: id,
                    },
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'number', name: 'number'},
                    {data: 'date', name: 'date'},
                    {data: 'user', name: 'user'},
                    {data: 'qc', name: 'qc'},
                    {data: 'actioonn', name: 'actioonn'},


                ]
            });

        });

        $('#saveBtntolid').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#productFormpish').serialize(),
                url: "{{ route('admin.ProductionLines.pishtlid') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        $('#productFormpish').trigger("reset");
                        $('#ajaxpishtolid').modal('hide');
                        $('#ajaxModel_device').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                    }
                }
            });
        });

        $('#saveBtnstore').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#productFor').serialize(),
                url: "{{ route('admin.ProductionLines.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#ajaxStore_information').modal('hide');
                        $('#ajaxModel_device').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                    }
                    if (data.rrrrerror) {
                        $('#ajaxStore_information').modal('hide');
                        $('#ajaxModel_device').modal('hide');
                        Swal.fire({
                            title: 'خطا!',
                            text: 'تعداد کل تولید نمیتوانید بیشتر از تعداد خواسته شده باشد',
                            icon: 'error',
                            confirmButtonText: 'تایید'
                        })
                    }
                    if (data.success) {
                        $('#productFor').trigger("reset");
                        $('#ajaxStore_information').modal('hide');
                        $('#ajaxModel_device').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                    }
                }
            });
        });

        $('#saveBtnstop').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#productForsam').serialize(),
                url: "{{ route('admin.ProductionLines.store.stop') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#ajaxModelStop').modal('hide');
                        $('#ajaxModel_device').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                    }
                    if (data.rrrrerror) {
                        $('#ajaxModelStop').modal('hide');
                        $('#ajaxModel_device').modal('hide');
                        Swal.fire({
                            title: 'خطا!',
                            text: 'تعداد کل تولید نمیتوانید بیشتر از تعداد خواسته شده باشد',
                            icon: 'error',
                            confirmButtonText: 'تایید'
                        })
                    }
                    if (data.success) {
                        $('#productForsam').trigger("reset");
                        $('#ajaxModelStop').modal('hide');
                        $('#ajaxModel_device').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                    }
                }
            });
        });

        $('#typestop')
            .change(function () {

                $('#desstop')
                    .find('option')
                    .remove();
                var id = $('#typestop').val();
                if (id == 1) {
                    $('#desstop')
                        .append('<option value="عدم سفارش تولید">عدم سفارش تولید</option>')
                        .append('<option value="کمبود سفارش تولید">کمبود سفارش تولید</option>')
                        .append('<option value="عدم خروج سفارشات تولید شده">عدم خروج سفارشات تولید شده</option>')
                        .append('<option value="کمبود پالت خالی">کمبود پالت خالی</option>');
                } else if (id == 2) {
                    $('#desstop')
                        .append('<option value="ایراد فنی دستگاه">ایراد فنی دستگاه</option>')
                        .append('<option value="ایراد فنی قالب">ایراد فنی قالب</option>')
                        .append('<option value="ایراد فنی گازگیر">ایراد فنی گازگیر</option>')
                        .append('<option value="ایراد فنی چیله">ایراد فنی چیله</option>')
                        .append('<option value="ایراد فنی تجیهزات جانبی">ایراد فنی تجیهزات جانبی</option>')
                        .append('<option value="ایراد فنی تاسسیات کارخونه">ایراد فنی تاسسیات کارخونه</option>')
                        .append('<option value="تعویض قالب">تعویض قالب</option>')
                        .append('<option value="تغیر رنگ">تغیر رنگ</option>')
                        .append('<option value="تنظیمات و راه اندازی سایر موارد فنی">تنظیمات و راه اندازی سایر موارد فنی</option>');
                } else if (id == 3) {
                    $('#desstop')

                        .append('<option value="قطع سراسری برق">قطع سراسری برق</option>')
                        .append('<option value="کمبود مواد اولیه">کمبود مواد اولیه</option>')
                        .append('<option value="ایراد کیفی مواد اولیه">ایراد کیفی مواد اولیه</option>')
                        .append('<option value="کمبود نیروی انسانی">کمبود نیروی انسانی</option>')
                        .append('<option value="دستور مدیریت">دستور مدیریت</option>')
                        .append('<option value="دستور QC">دستور QC</option>')
                        .append('<option value="تعطیلات رسمی">تعطیلات رسمی</option>')
                        .append('<option value="تولید آزمایشی">تولید آزمایشی</option>')
                        .append('<option value="سایر موارد غیرفنی">سایر موارد غیرفنی</option>')
                }
            }).change();

    });

    function addInput11() {
        var data = {
            'title': '',
            'icon': '',
        };
        added_inputs3_array.push(data);
        added_inputs_array_table3(data, added_inputs3_array.length - 1);
    }

    $('body').on('click', '.deleteProduct', function () {
        var id = $(this).data("id");
        Swal.fire({
            title: 'حذف حساب بانکی؟',
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
                    url: "{{route('admin.bank.delete')}}" + '/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات حساب بانکی با موفقیت از سیستم حذف شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        })
                    }
                });
            }
        })
    });

    jQuery(function ($) {
        $("#inti").mask("99:99");
        $("#toti").mask("99:99");
    });

    $('#manufacturing').addClass('active');

</script>

<script>

    kamaDatepicker('dateu',
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
    kamaDatepicker('inda',
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
    kamaDatepicker('toda',
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
