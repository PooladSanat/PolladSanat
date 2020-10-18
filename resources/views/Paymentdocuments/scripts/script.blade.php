<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/jquery.maskedinput.js')}}" type="text/javascript"></script>
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
        load_data();

        function load_data(customer_id = '', indate = '', todate = '', name = '') {

            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('td:eq(0)', nRow).css('background-color', '#e8ecff');

                    if (aData.status == "وصول نشده") {
                        $('td:eq(10)', nRow).css('background-color', '#ffffff');
                    } else if (aData.status == "وصول شده") {
                        $('td:eq(10)', nRow).css('background-color', '#ccff8d');
                    } else {
                        $('td:eq(10)', nRow).css('background-color', '#ff6a6b');
                    }
                },
                "bInfo": false,
                "paging": false,
                "bPaginate": false,
                "columnDefs": [
                    {"orderable": false, "targets": 0},
                ],
                "order": [[11, "desc"]],
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
                    ajax: "{{ route('admin.PaymentDocument.list') }}",
                    data:
                        {
                            customer_id: customer_id,
                            indate: indate,
                            todate: todate,
                            name: name,
                        }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'customer', name: 'customer'},
                    {data: 'payment_id', name: 'payment_id'},
                    {data: 'type', name: 'type'},
                    {data: 'date', name: 'date'},
                    {data: 'name', name: 'name'},
                    {data: 'name_user', name: 'name_user'},
                    {data: 'price', name: 'price'},
                    {data: 'create', name: 'create'},
                    {data: 'description', name: 'description'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });
        }

        $('#filter').click(function () {
            var customer_id = $('#customer_id').val();
            var indate = $('#indate').val();
            var todate = $('#todate').val();
            var name = $('#name').val();
            $('.data-table').DataTable().destroy();
            load_data(customer_id, indate, todate, name);
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
                $('#cpricee').val(data.pricee);
                $('#cupdate').val(data.date);
                $('#pricesum').val(data.sum);
                $('#pricesumm').val(data.summ);

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
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'pack', name: 'pack'},
                        {data: 'product', name: 'product'},
                        {data: 'color', name: 'color'},
                        {data: 'number', name: 'number'},
                        {data: 'price', name: 'price'},
                        {data: 'date', name: 'date'},
                    ],
                    rowsGroup:
                        [
                            1
                        ],
                });

            })


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
                $('#cpriicee').val(data.pricee);
                $('#cupdate').val(data.date);
                $('#pricesum').val(data.sum);
                $('#pricesuumm').val(data.summ);
                $('#customer_ideeeer').val(data.name_customer);


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
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'pack', name: 'pack'},
                        {data: 'product', name: 'product'},
                        {data: 'color', name: 'color'},
                        {data: 'number', name: 'number'},
                        {data: 'price', name: 'price'},
                        {data: 'date', name: 'date'},
                    ],
                    rowsGroup:
                        [
                            1
                        ],
                });

            })


        });

        $('body').on('click', '.detail-admin', function () {
            var id_id = $(this).data('id');
            $.get("{{ route('admin.payment.updatee') }}" + '/' + id_id, function (data) {
                $('#ajaxadmin').modal('show');
                $('#customer_iderr').val(id_id);
                $('#cnamee').val(data.name.name);
                $('#cid').val(data.name.id);
                $('#cpricee').val(data.price);
                $('#cpriceee').val(data.pricee);
                $('#cupdatee').val(data.date);
                $('#pricesumm').val(data.sum);
                $('#pricesummm').val(data.summ);
                $('#pricessummm').val(data.summ);
                $('#price_customer_payment').val(data.detail_customer);
                $('#detail_customersa').val(data.detail_customersa);
                $('#recive_customer_payment').val(data.recive_customer);
                $('#document_customer_payment').val(data.customer_payment);
                $('#factor_customer_payment').val(data.factor_customer);

            })
        });

        $('body').on('click', '.detail-payment-status', function () {
            var id = $(this).data('id');
            $('#ajaxModelsatus').modal('show');
            $('#id_status').val(id);
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

        $('#saveBtnstatus').click(function (e) {
            e.preventDefault();
            $('#saveBtnstatus').text('در حال ثبت اطلاعات...');
            $('#saveBtnstatus').prop("disabled", true);
            $.ajax({
                data: $('#productFormstatus').serialize(),
                url: "{{ route('admin.CustomerAccount.store.payment') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#ajaxModelsatus').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveBtnstatus').text('ثبت');
                        $('#saveBtnstatus').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#productFormstatus').trigger("reset");
                        $('#ajaxModelsatus').modal('hide');
                        $('.data-table').DataTable().draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtnstatus').text('ثبت');
                        $('#saveBtnstatus').prop("disabled", false);
                    }
                }
            });
        });


    });
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
    $(document).ready(function () {
        $('#name').select2({
            width: '100%',
            dir: 'rtl',
            placeholder: 'لیست بانک ها',
            language: {
                noResults: function () {
                    return 'بانکی با این نام یافت نشد';
                },
            },
        });
    });
</script>
