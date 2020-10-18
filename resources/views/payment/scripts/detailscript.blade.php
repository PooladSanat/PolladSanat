<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/public/js/datatab.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/row.js')}}" type="text/javascript"></script>
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
<meta name="_token" content="{{ csrf_token() }}"/>
<style>
    .as-console-wrapper {
        display: none !important;
    }
</style>
<script type="text/javascript">
    <?php
    $month = verta();
    ?>
    $('#month').val({{$month->month}});
    $('#year').val({{$month->year}});
    $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            load_data();

        function load_data(user_id = '', customer_id = '', indate = '', todate = '') {
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
                    "order": [[ 1, "ASC" ]],
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
                        ajax: "{{ route('admin.payment.detaillist') }}",
                        data:
                            {
                                user_id: user_id,
                                customer_id: customer_id,
                                indate: indate,
                                todate: todate,
                            }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                        {data: 'customer_name', name: 'customer_name'},
                        {data: 'user', name: 'user'},
                        {data: 'pack_id', name: 'pack_id'},
                        {data: 'havale', name: 'havale'},
                        {data: 'rahkaran', name: 'rahkaran'},
                        {data: 'date', name: 'date'},
                        {data: 'total', name: 'total'},
                        {data: 'type', name: 'type'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},

                    ],
                    rowsGroup:
                        [
                            1
                        ],
                });
            }

            $('#filter').click(function () {
                var customer_id = $('#customer_id').val();
                var user_id = $('#user_id').val();
                var indate = $('#indate').val();
                var todate = $('#todate').val();
                $('.data-table').DataTable().destroy();
                load_data(user_id, customer_id, indate, todate);
            });


            $(document).on('click', '#bulk_delete', function () {
                var id = [];
                $('.student_checkbox:checked').each(function () {
                    id.push($(this).val());
                });
                if (id.length > 0) {
                    $.ajax({
                        url: "{{ route('admin.payment.list.payment')}}",
                        method: "get",
                        data: {id: id},
                        success: function (data) {
                            if (data.error_customer) {
                                Swal.fire({
                                    title: 'خطا!',
                                    text: 'لطفا فاکتور های یک مشتری را انتخاب نمایید!',
                                    icon: 'error',
                                    confirmButtonText: 'تایید'
                                });
                            }

                            if (data.success) {
                                $('#ajaxModelprice').modal('show');
                                $('#sum_price').val(data.price);
                                if (data.creditor == null) {
                                    $('#creditor').val(0);
                                } else {
                                    $('#creditor').val(data.creditor.creditor);
                                }

                                $('#customer_idd').val(data.customer_id);
                                $('#pack_id').val(data.pack_id);

                                $('#takhfif')
                                    .keyup(function () {
                                        var sum_price = $('#sum_price').val();
                                        var takhfif = $('#takhfif').val();
                                        $('#sum').val(sum_price - takhfif);
                                    })
                                    .keyup();
                            }


                        }
                    });

                } else {
                    Swal.fire({
                        title: 'توجه',
                        text: 'فاکتوری برای تبدیل شدن به صورتحساب انتخاب نشده است!',
                        icon: 'info',
                        confirmButtonText: 'تایید'
                    });


                }


            });


            $("#select_all").change(function () {
                $(".student_checkbox").prop('checked', $(this).prop('checked'));
            });

            $('body').on('click', '.detail-eye', function () {

                $('.type').remove();
                $('.shenase').remove();
                $('.price').remove();
                $('.date').remove();
                $('.actiont').remove();
                $('.user_name').remove();
                $('.name').remove();
                var id_id = $(this).data('id');
                $.get("{{ route('admin.payment.update') }}" + '/' + id_id, function (data) {
                    $('#gfgf').DataTable().destroy();
                    $('#ajaxModel').modal('show');
                    $('#customer_ider').val(id_id);
                    $('#cname').val(data.name.name);
                    $('#cprice').val(data.price);
                    $('#cupdate').val(data.date);

                    var table1 = $('.gfgf').DataTable({
                        processing: true,
                        serverSide: true,
                        "ordering": false,
                        "paging": false,
                        "info": false,
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
                            {data: 'name', name: 'name'},
                            {data: 'name_user', name: 'name_user'},
                            {data: 'price', name: 'price'},
                            {data: 'date', name: 'date'},
                        ],
                    });

                })


            });

            $('#saveprice').click(function (e) {
                e.preventDefault();
                $('#saveprice').text('در حال ثبت اطلاعات...');
                $('#saveprice').prop("disabled", true);
                $.ajax({
                    data: $('#productFormprice').serialize(),
                    url: "{{ route('admin.payment.store.storepament') }}",
                    type: "POST",
                    dataType: 'html',
                    success: function (data) {
                        if (data.errors) {
                            $('#ajaxModelprice').modal('hide');
                            jQuery.each(data.errors, function (key, value) {
                                Swal.fire({
                                    title: 'خطا!',
                                    text: value,
                                    icon: 'error',
                                    confirmButtonText: 'تایید'
                                })
                            });
                            $('#saveprice').text('ثبت');
                            $('#saveprice').prop("disabled", false);
                        }
                        if (data.error_creditor) {
                            $('#ajaxModelprice').modal('hide');
                            Swal.fire({
                                title: 'خطا!',
                                text: 'اعتبار مشتری از جمع مبلغ فاکتورهای انتخابی کمتر میباشد!',
                                icon: 'error',
                                confirmButtonText: 'تایید',
                            });
                            $('#saveprice').text('ثبت');
                            $('#saveprice').prop("disabled", false);
                        }
                        if (data) {
                            $('.data-table').DataTable().draw();
                            $('#ajaxModelprice').modal('hide');
                            w = window.open(window.location.href, "_blank");
                            w.document.open();
                            w.document.write(data);
                            w.document.close();
                            w.location.reload();
                            $('#saveprice').text('ثبت');
                            $('#saveprice').prop("disabled", false);
                        }
                    }
                });
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

        }
    );

    $('body').on('click', '.detail-factor', function () {

        var detail_factor = $(this).data('id');
        $('#ajaxModellistr').modal('show');
        $('#factor').DataTable().destroy();
        $('.factor').DataTable({
            processing: true,
            serverSide: true,
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
                url: "{{ route('admin.payment.list.detail.factor.pack') }}",
                data: {
                    detail_factor: detail_factor,
                },
            },
            columns: [
                {data: 'pack', name: 'pack', "className": "dt-center"},
                {data: 'user', name: 'user'},
                {data: 'customer_name', name: 'customer_name'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'total', name: 'total'},
                {data: 'date', name: 'date'},
            ],
            rowsGroup:
                [
                    0, 1, 2,6
                ],

        });


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
            "<option value='1'>نقدی</option>" +
            "<option value='2'>چک</option>" +
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
</script>
