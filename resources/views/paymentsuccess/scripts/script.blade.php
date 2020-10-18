<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/public/js/datatab.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/row.js')}}" type="text/javascript"></script>
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

            function load_data(customer_id = '', year = '{{$month->year}}', month = '{{$month->month}}') {
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
                    "order": [[ 4, "desc" ]],
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
                        ajax: "{{ route('admin.paymentsuccess.list') }}",
                        data:
                            {
                                customer_id: customer_id,
                                year: year,
                                month: month,
                            }
                    },
                    columns: [
                        {data: 'customer', name: 'customer'},
                        {data: 'pack_id', name: 'pack_id'},
                        {data: 'total', name: 'total'},
                        {data: 'type', name: 'type'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},

                    ],

                });
            }

            $('#filter').click(function () {
                var customer_id = $('#customer_id').val();
                var year = $('#year').val();
                var month = $('#month').val();
                $('.data-table').DataTable().destroy();
                load_data(customer_id, year, month);
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
                                    text: 'لطفا فاکتور های یک مشتری را انتخاب نمایید',
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
                        text: 'فاکتوری برای پرداخت انتخاب نشده است!',
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
                var id_id = $(this).data('id');
                $.get("{{ route('admin.payment.update') }}" + '/' + id_id, function (data) {
                    $('#ajaxModel').modal('show');
                    $('#customer_id').val(id_id);
                    $('#cname').val(data.name.name);
                    $('#cprice').val(data.price);
                    $('#cupdate').val(data.date);
                })


            });

            $('body').on('click', '.detail-trash', function () {
                var id = $(this).data('id');
                $('#id_factor').val(id);
                $('#ajaxcancel').modal('show');

            });

            $('#savecancel').click(function (e) {
                e.preventDefault();
                $('#savecancel').text('در حال ثبت اطلاعات...');
                $('#savecancel').prop("disabled", true);
                $.ajax({
                    data: $('#productFormpriice').serialize(),
                    url: "{{ route('admin.payment.delete.factor') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if (data.errors) {
                            $('#ajaxcancel').modal('hide');
                            jQuery.each(data.errors, function (key, value) {
                                Swal.fire({
                                    title: 'خطا!',
                                    text: value,
                                    icon: 'error',
                                    confirmButtonText: 'تایید'
                                })
                            });
                            $('#savecancel').text('ثبت');
                            $('#savecancel').prop("disabled", false);
                        }
                        if (data.success) {
                            $('#productFormpriice').trigger("reset");
                            $('#ajaxcancel').modal('hide');
                            $('.data-table').DataTable().draw();

                            Swal.fire({
                                title: 'موفق',
                                text: 'مشخصات  با موفقیت در سیستم ثبت شد',
                                icon: 'success',
                                confirmButtonText: 'تایید',
                            });
                            $('#savecancel').text('ثبت');
                            $('#savecancel').prop("disabled", false);
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
                            $('#name').val('');
                            $('#code').val('');
                            $('#product').val('');
                        }
                    }
                });
            });

        }
    );
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
