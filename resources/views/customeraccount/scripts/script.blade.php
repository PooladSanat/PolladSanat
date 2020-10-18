<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/public/js/12.js')}}" type="text/javascript"></script>

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
            "bInfo": false,
            "paging": false,
            "bPaginate": false,
            "columnDefs": [
                {"orderable": false, "targets": 0},
            ],
            "order": [[3, "deesc"]],
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e8ecff');
                if (parseInt(aData.creditor) < 0) {
                    $('td:eq(2)', nRow).css('background-color', 'rgba(255,43,28,0.62)');
                } else if (parseInt(aData.creditor) > 0) {
                    $('td:eq(2)', nRow).css('background-color', 'rgba(144,221,251,0.99)');
                } else {
                    $('td:eq(2)', nRow).css('background-color', 'white');
                }
            },
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.CustomerAccount.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                {data: 'name', name: 'name'},
                {data: 'creditor', name: 'creditor'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('body').on('click', '.payment-customer', function () {
            var id = $(this).data('id');
            $('#customer_id').val(id);


        });

        $('body').on('click', '.editpaymentcustomer', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.CustomerAccount.check.payment') }}" + '/' + id, function (data) {
                $('#editpaymentcustomer').modal('show');
                $('#priced').val(data.creditor);
                $('#cusomer_id_payment').val(id);
            })

        });

        $('body').on('click', '.editpayment', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.CustomerAccount.update') }}" + '/' + id, function (data) {
                $('#editpayment').modal('show');
                $('#type').val(data.type);
                $('#id_payment').val(id);
                $('#shanase').val(data.shenase);
                $('#name').val(data.name);
                $('#name_user').val(data.name_user);
                $('#price').val(data.price);
                $('#date').val(data.date);
                $('#id_customer').val(data.customer_id);
                $('#shahr').val(data.descriptionn);
            })

        });

        $('#saveeditpament').click(function (e) {
            e.preventDefault();
            $('#saveeditpament').text('در حال ثبت اطلاعات...');
            $('#saveeditpament').prop("disabled", true);
            $.ajax({
                data: $('#form_editpament').serialize(),
                url: "{{ route('admin.CustomerAccount.edit') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#editpayment').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveeditpament').text('ثبت');
                        $('#saveeditpament').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#form_editpament').trigger("reset");
                        $('#editpayment').modal('hide');
                        table1.draw();
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveeditpament').text('ثبت');
                        $('#saveeditpament').prop("disabled", false);
                    }
                }
            });
        });

        $('#saveBtnpayment').click(function (e) {
            e.preventDefault();
            $('#saveBtnpayment').text('در حال ثبت اطلاعات...');
            $('#saveBtnpayment').prop("disabled", true);
            $.ajax({
                data: $('#editpaymentcustomerForm').serialize(),
                url: "{{ route('admin.CustomerAccount.payment.update') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#editpaymentcustomer').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveBtnpayment').text('ثبت');
                        $('#saveBtnpayment').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#editpaymentcustomerForm').trigger("reset");
                        $('#editpaymentcustomer').modal('hide');
                        table1.draw();
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtnpayment').text('ثبت');
                        $('#saveBtnpayment').prop("disabled", false);
                    }
                }
            });
        });

        $('body').on('click', '.deletepayment', function () {
            var id = $(this).data("id");
            Swal.fire({
                title: 'حذف پرداختی؟',
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
                        url: "{{route('admin.CustomerAccount.delete')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            table1.draw();
                            table.draw();
                            Swal.fire({
                                title: 'موفق',
                                text: 'مشخصات پرداختی با موفقیت از سیستم حذف شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });

        $('body').on('click', '.sharj', function () {
            var id = $(this).data('id');

            $.get("{{ route('admin.CustomerAccount.check.payment.list') }}" + '/' + id, function (data) {

                $('#customer_id').val(id);
                $('.type').remove();
                $('.shenase').remove();
                $('.name').remove();
                $('.user_name').remove();
                $('.price').remove();
                $('.date').remove();
                $('.descriptionnn').remove();
                $('.actiont').remove();
                $('#ajaxModel').modal('show');
                $('#name_userrr').val(data.dataa.name);
                $('#userrr_payment').val(data.data.creditor);
            })
        });

        var table1 = $('.ee').DataTable({
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
            "order": [[9, "desc"]],
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
                url: "{{ route('admin.CustomerAccount.list.detail') }}",
                data: {
                    id_id: $('#iiii').val(),
                },
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'customer_id', name: 'customer_id'},
                {data: 'type', name: 'type'},
                {data: 'shenase', name: 'shenase'},
                {data: 'name', name: 'name'},
                {data: 'name_user', name: 'name_user'},
                {data: 'price', name: 'price'},
                {data: 'date', name: 'date'},
                {data: 'created', name: 'created'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $('#saveBtn').text('در حال ثبت اطلاعات...');
            $('#saveBtn').prop("disabled", true);
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.CustomerAccount.storee') }}",
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
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);
                        $('#name').val('');
                        $('#code').val('');
                        $('#product').val('');
                    }
                }
            });
        });

    });

    $('#payment').addClass('active');</script>

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

    $('.price').mask("#,##0", {
        reverse: true
    });
    $('.priced').mask("#,##0", {
        reverse: true
    });

</script>
<script>
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
</script>
