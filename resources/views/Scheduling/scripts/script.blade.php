<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/public/js/datatab.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/row.js')}}" type="text/javascript"></script>
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
<style>
    .as-console-wrapper {
        display: none !important;
    }

</style>

<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
    @php
        $dat = \Carbon\Carbon::now();
    $date = \Morilog\Jalali\Jalalian::forge($dat)->format('Y/m/d');
    $invoice_products = \DB::table('invoice_product')->get();
    $products = \App\Product::all();
    $colors = \App\Color::all();
    $invoices = \App\Invoice::all();
    $barnproducts = \App\BarnsProduct::all();
    @endphp
    $('#from_date').val('{{$date}}');
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        load_data();

        function load_data(from_check = '', from_date = '{{$date}}', to = '{{$date}}') {
            $('#data-table').DataTable({

                processing: true,
                serverSide: true,
                "bInfo": false,
                "paging": false,
                "bPaginate": false,
                "columnDefs": [
                    {"orderable": false, "targets": 0},
                ],
                "order": [[ 13, "desc" ]],
                "ordering": false,
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('td:eq(0)', nRow).css('background-color', '#e8ecff');
                    if (aData.status == 'عدم خروج') {
                        $('td:eq(12)', nRow).css('background-color', 'rgba(255,106,107,0.65)');
                    } else if (aData.status == 'خروج کامل') {
                        $('td:eq(12)', nRow).css('background-color', 'rgba(204,255,141,0.65)');
                    } else if (aData.status == 'خروج ناقص') {
                        $('td:eq(12)', nRow).css('background-color', 'rgba(255,250,130,0.65)');
                    } else if (aData.status == 'اتمام یافته') {
                        $('td:eq(12)', nRow).css('background-color', 'rgba(255,163,239,0.65)');
                    } else if (aData.status == 'تایید حواله') {
                        $('td:eq(12)', nRow).css('background-color', 'rgba(0,183,255,0.66)');
                    } else {
                        $('td', nRow).css('background-color', 'white');
                    }

                    if (parseInt(aData.total) == parseInt(aData.number)) {
                        $('td:eq(7)', nRow).css('background-color', 'rgba(204,255,141,0.65)');
                    } else if (parseInt(aData.total) == parseInt("0")) {
                        $('td:eq(7)', nRow).css('background-color', 'rgba(255,106,107,0.64)');
                    } else if (parseInt(aData.total) < parseInt(aData.number)) {
                        $('td:eq(7)', nRow).css('background-color', 'rgba(255,250,130,0.65)');
                    } else {
                        $('td:eq(7)', nRow).css('background-color', 'white');
                    }
                }
                ,
                "language":
                    {
                        "search":
                            "جستجو:",
                        "lengthMenu":
                            "نمایش _MENU_",
                        "zeroRecords":
                            "موردی یافت نشد!",
                        "info":
                            "نمایش _PAGE_ از _PAGES_",
                        "infoEmpty":
                            "موردی یافت نشد",
                        "infoFiltered":
                            "(جستجو از _MAX_ مورد)",
                        "processing":
                            "در حال پردازش اطلاعات"
                    },
                ajax: {
                    ajax: "{{ route('admin.scheduling.list') }}",
                    data:
                        {
                            from_check: from_check,
                            from_date: from_date,
                            to: to,

                        }
                },
                "deferRender": true,
                columns: [
                    {data: 'detail_id', name: 'detail_id', "className": "dt-center"},
                    {data: 'pack', name: 'pack'},
                    {data: 'user', name: 'user'},
                    {data: 'customer_name', name: 'customer_name'},
                    {data: 'product', name: 'product'},
                    {data: 'color', name: 'color'},
                    {data: 'number', name: 'number'},
                    {data: 'total', name: 'total'},
                    {data: 'type', name: 'type'},
                    {data: 'Carry', name: 'Carry'},
                    {data: 'time', name: 'time'},
                    {data: 'description', name: 'description'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                rowsGroup:
                    [
                        1, 2, 3, 8, 9, 10, 11, 12, 13,
                    ],

            });

        }

        $('#filter').click(function () {
            var from_check = $('#list').val();
            var from_date = $('#from_date').val();
            var to = '';
            $('#data-table').DataTable().destroy();
            load_data(from_check, from_date, to);
        });

        $('body').on('click', '.change-date', function () {
            var id = $(this).data('id');
            $('#changedateModel').modal('show');
            $('#id_d').val(id);
        });

        $('body').on('click', '.change-datee', function () {
            var id = $(this).data('id');
            $('#changedateModele').modal('show');
            $('#id_de').val(id);
        });

        $('body').on('click', '.EditCar', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.scheduling.update.ubargiri') }}" + '/' + id, function (data) {
                $('#editcar').modal('show');
                $('#id_pp').val(id);
                $('#type').val(data.type);
                $('#time').val(data.time);
                $('#descrtiption').val(data.description);
            })


        });

        $('body').on('click', '.customer', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.scheduling.update.customer') }}" + '/' + id, function (data) {
                $('#customere').modal('show');
                if (data.customer_personal != null) {
                    $('#phone').text(data.customer_personal.phone_personel);
                    $('#tel').text(data.customer_personal.tel_personel);
                    $('#address').text(data.customer_personal.adders_personel);
                } else {
                    $('#phone').text(data.customer_company.phone_company);
                    $('#tel').text(data.customer_company.tel_company);
                    $('#address').text(data.customer_company.adders_company);
                }

            })


        });

        $('#saveeditcar').click(function (e) {
            e.preventDefault();
            $('#saveeditcar').text('در حال ثبت اطلاعات...');
            $('#saveeditcar').prop("disabled", true);
            $.ajax({
                data: $('#editcarr').serialize(),
                url: "{{ route('admin.scheduling.update.bargiri') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#editcar').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveeditcar').text('ثبت');
                        $('#saveeditcar').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#editcarr').trigger("reset");
                        $('#editcar').modal('hide');
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت دشد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveeditcar').text('ثبت');
                        $('#saveeditcar').prop("disabled", false);
                    }
                }
            });
        });

        $('#saveBtndate').click(function (e) {
            e.preventDefault();
            $('#saveBtndate').text('در حال ثبت اطلاعات...');
            $('#saveBtndate').prop("disabled", true);
            $.ajax({
                data: $('#changedateForm').serialize(),
                url: "{{ route('admin.scheduling.update.date') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#changedateModel').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveBtndate').text('ثبت');
                        $('#saveBtndate').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#changedateForm').trigger("reset");
                        $('#changedateModel').modal('hide');
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت دشد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtndate').text('ثبت');
                        $('#saveBtndate').prop("disabled", false);
                    }
                }
            });
        });

        $('#saveBtndatee').click(function (e) {
            e.preventDefault();
            $('#saveBtndatee').text('در حال ثبت اطلاعات...');
            $('#saveBtndatee').prop("disabled", true);
            $.ajax({
                data: $('#changedateFormesa').serialize(),
                url: "{{ route('admin.scheduling.update.datee') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#changedateModele').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveBtndatee').text('ثبت');
                        $('#saveBtndatee').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#changedateFormesa').trigger("reset");
                        $('#changedateModele').modal('hide');
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtndatee').text('ثبت');
                        $('#saveBtndatee').prop("disabled", false);
                    }
                }
            });
        });

        $('body').on('click', '.plus-number', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.scheduling.update') }}" + '/' + product_id, function (data) {
                $('#ajaxModel').modal('show');
                $('#caption').text('ثبت شماره حواله حسابداری');
                $('#number').val(data.number);
                $('#product_id').val(product_id);
                $('#id').val(data.id);
            })
        });

        $('body').on('click', '.plus-exit', function () {
            var product_id = $(this).data('id');
            $(".product").remove();
            $(".color").remove();
            $(".number").remove();
            $(".numberexit").remove();
            $.get("{{ route('admin.scheduling.exit') }}" + '/' + product_id, function (data) {
                $('#ajaxModelExit').modal('show');
                $('#captioon').text('ثبت خروج از انبار');
                $('#updatee').val(data.update);
                $('#descriptioonn').val(data.invoice.description);
                $('#custommmmerrrr').val(data.customer.name);
                $('#custommmsmerrrr').val(data.customer.name);
                $('#hav').val(data.hav.number);

                added_inputs2_array = [];
                invoices = [];
                products = [];
                colors = [];
                sells = [];
                barnproducts = [];

                data.data.forEach(function (entry) {
                    var invoice_product = {
                        'detail_id': entry.detail_id,
                        'id': entry.id,
                        'total': entry.total,
                        'pack': entry.pack,
                    };
                    added_inputs2_array.push(invoice_product);
                });
                    @foreach($invoices as $invoice)
                var sell = {
                        'id': "{{$invoice->id}}",
                        'customer_id': "{{$invoice->customer_id}}",
                        'description': "{{$invoice->description}}",
                    };
                sells.push(sell);
                    @endforeach
                    @foreach($invoice_products as $invoice_product)
                var invoice = {
                        'id': "{{$invoice_product->id}}",
                        'product_id': "{{$invoice_product->product_id}}",
                        'color_id': "{{$invoice_product->color_id}}",
                        'salesNumber': "{{$invoice_product->salesNumber}}",
                        'salesPrice': "{{$invoice_product->salesPrice}}",
                        'sumTotal': "{{$invoice_product->sumTotal}}",
                        'invoice_id': "{{$invoice_product->invoice_id}}",
                    };
                invoices.push(invoice);
                    @endforeach
                    @foreach($products as $product)
                var product = {
                        'id': "{{$product->id}}",
                        'label': "{{$product->label}}",
                    };
                products.push(product);
                    @endforeach
                    @foreach($colors as $color)
                var color = {
                        'id': "{{$color->id}}",
                        'name': "{{$color->name}}",
                    };
                colors.push(color);
                    @endforeach
                    @foreach($barnproducts as $barnproduct)
                var barnproduct = {
                        'product_id': "{{$barnproduct->product_id}}",
                        'color_id': "{{$barnproduct->color_id}}",
                        'Inventory': "{{$barnproduct->Inventory}}",
                    };
                barnproducts.push(barnproduct);
                @endforeach



                if (added_inputs2_array.length >= 1)
                    for (var a in added_inputs2_array)
                        added_inputs_array_table2(added_inputs2_array[a], a);

                function added_inputs_array_table2(data, a) {
                    for (var f in invoices) {
                        if (invoices[f].id == data.detail_id) {
                            var myNode = document.createElement('div');
                            myNode.id = 'codee' + a;
                            myNode.innerHTML += "<div class='form-group'>" +
                                "<input type=\"text\" id=\'code" + a + "\' readonly value=" + invoices[f].id + "  name=\"code[]\"\n" +
                                "class=\"form-control color\" />" +
                                "</div></div></div>";
                            document.getElementById('codee').appendChild(myNode);
                            for (var p in products) {
                                if (products[p].id == invoices[f].product_id) {
                                    var myNode = document.createElement('div');
                                    myNode.id = 'productt' + a;
                                    myNode.innerHTML += "<div class='form-group'>" +
                                        "<input type=\"text\" id=\'product" + a + "\' readonly  name=\"product[]\"\n" +
                                        "class=\"form-control product\" />" +
                                        "<input type='hidden' id=\'producte" + a + "\' name='producte[]'>" +
                                        "</div></div></div>";
                                    document.getElementById('productt').appendChild(myNode);
                                    $('#product' + a + '').val(products[p].label);
                                    $('#producte' + a + '').val(products[p].id);
                                }
                            }
                            for (var c in colors) {
                                if (invoices[f].color_id == colors[c].id) {
                                    var myNode = document.createElement('div');
                                    myNode.id = 'colorrr' + a;
                                    myNode.innerHTML += "<div class='form-group'>" +
                                        "<input type=\"text\" id=\'color" + a + "\' readonly  name=\"color[]\"\n" +
                                        "class=\"form-control color\" />" +
                                        "</div></div></div>";
                                    document.getElementById('colorrr').appendChild(myNode);
                                    $('#color' + a + '').val(colors[c].name);

                                }
                            }
                            var myNode = document.createElement('div');
                            myNode.id = 'numberr' + a;
                            myNode.innerHTML += "<div class='form-group'>" +
                                "<input type=\"text\" id=\'number" + a + "\' readonly value=" + invoices[f].salesNumber + "  name=\"number[]\"\n" +
                                "class=\"form-control number\" />" +
                                "</div></div></div>";
                            document.getElementById('numberr').appendChild(myNode);

                            if ($('#updatee').val() == 1) {


                                for (var p in products) {
                                    if (products[p].id == invoices[f].product_id) {
                                        for (var c in colors) {
                                            if (invoices[f].color_id == colors[c].id) {
                                                for (var b in barnproducts) {
                                                    if (barnproducts[b].color_id == invoices[f].color_id
                                                        && barnproducts[b].product_id == invoices[f].product_id) {
                                                        var myNode = document.createElement('div');
                                                        myNode.id = 'numberexitt' + a;
                                                        myNode.innerHTML += "<div class='form-group'>" +
                                                            "<input type=\"number\" value=" + data.total + " id=\'numberexit" + a + "\' placeholder='موجودی انبار " + barnproducts[b].Inventory + "'  name=\"numberexit[]\"\n" +
                                                            "class=\"form-control numberexit\" />" +
                                                            "</div></div></div>";
                                                        document.getElementById('numberexitt').appendChild(myNode);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }


                            } else {

                                for (var p in products) {
                                    if (products[p].id == invoices[f].product_id) {
                                        for (var c in colors) {
                                            if (invoices[f].color_id == colors[c].id) {
                                                for (var b in barnproducts) {
                                                    if (barnproducts[b].color_id == invoices[f].color_id
                                                        && barnproducts[b].product_id == invoices[f].product_id) {
                                                        var myNode = document.createElement('div');
                                                        myNode.id = 'numberexitt' + a;
                                                        myNode.innerHTML += "<div class='form-group'>" +
                                                            "<input type=\"number\" id=\'numberexit" + a + "\' placeholder='موجودی انبار " + barnproducts[b].Inventory + "'  name=\"numberexit[]\"\n" +
                                                            "class=\"form-control numberexit\" />" +
                                                            "</div></div></div>";
                                                        document.getElementById('numberexitt').appendChild(myNode);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }


                            }


                            myNode.id = 'numberr' + a;
                            myNode.innerHTML += "<div class='form-group'>" +
                                "<input type=\"hidden\" id=\'id_invoi" + a + "\' readonly value=" + data.id + "  name=\"id_invoi[]\"\n" +
                                "class=\"form-control number\" />" +
                                "</div></div></div>";


                            myNode.id = 'packk' + a;
                            myNode.innerHTML += "<div class='form-group'>" +
                                "<input type=\"hidden\" id=\'pack" + a + "\' readonly value=" + data.pack + "  name=\"pack[]\"\n" +
                                "class=\"form-control number\" />" +
                                "</div></div></div>";


                        }
                    }


                }
            })
        });

        $('body').on('click', '.plus-number-exit', function () {
            var product_id = $(this).data('id');
            $('#ajaxModelExitDetail').modal('show');
            $('#captionEx').text('خروج از انبار');
            $('#proder').val(product_id);
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $('#saveBtn').text('در حال ثبت اطلاعات...');
            $('#saveBtn').prop("disabled", true);
            $.ajax({
                data: $('#productForme').serialize(),
                url: "{{ route('admin.scheduling.store') }}",
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
                        $('#productForme').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات سفارش با موفقیت در سیستم ثبت دشد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);
                    }
                }
            });
        });

        $('#savebarn').click(function (e) {
            e.preventDefault();
            $('#savebarn').text('در حال ثبت اطلاعات...');
            $('#savebarn').prop("disabled", true);
            $.ajax({
                data: $('#productFmm').serialize(),
                url: "{{ route('admin.scheduling.store.exit') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#ajaxModelExit').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#savebarn').text('ثبت');
                        $('#savebarn').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#productFmm').trigger("reset");
                        $('#ajaxModelExit').modal('hide');
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق!',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        });
                        $('#savebarn').text('ثبت');
                        $('#savebarn').prop("disabled", false);
                    }
                }
            });
        });

        $('#okBtn').click(function (e) {
            e.preventDefault();
            $('#okBtn').text('در حال ثبت اطلاعات...');
            $('#okBtn').prop("disabled", true);
            $.ajax({
                data: $('#productFormdf').serialize(),
                url: "{{ route('admin.scheduling.store.exit.fac') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#ajaxModelfac').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#okBtn').text('ثبت');
                        $('#okBtn').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#productFormdf').trigger("reset");
                        $('#ajaxModelfac').modal('hide');
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات سفارش با موفقیت در سیستم ثبت دشد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#okBtn').text('ثبت');
                        $('#okBtn').prop("disabled", false);
                    }
                }
            });
        });

        $('body').on('click', '.send-fac', function () {
            var product_id = $(this).data('id');
            $('#ajaxModelfac').modal('show');
            $('#captioson').text('ثبت شماره فاکتور');
            $('#produc').val(product_id);
        });

        $('body').on('click', '.cancel', function () {
            var id = $(this).data('id');
            $('#cancelModel').modal('show');
            $('#id_p').val(id);
        });

        $('#saveBtncancel').click(function (e) {
            e.preventDefault();
            $('#saveBtncancel').text('در حال ثبت اطلاعات...');
            $('#saveBtncancel').prop("disabled", true);
            $.ajax({
                data: $('#cancelForm').serialize(),
                url: "{{ route('admin.scheduling.cancel.detail') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errorr) {
                        $('#schedulingModal').modal('hide');
                        jQuery.each(data.errorr, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveBtncancel').text('ثبت');
                        $('#saveBtncancel').prop("disabled", false);
                    }

                    if (data.error) {
                        $('#cancelForm').trigger("reset");
                        $('#cancelModel').modal('hide');
                        Swal.fire({
                            title: 'خطا!',
                            text: 'تعداد ارسالی برای بارگیری نمیتواند بیشتر از تعداد درخواستی مشتری باشد!',
                            icon: 'error',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtncancel').text('ثبت');
                        $('#saveBtncancel').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#cancelForm').trigger("reset");
                        $('#cancelModel').modal('hide');
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtncancel').text('ثبت');
                        $('#saveBtncancel').prop("disabled", false);
                    }
                }
            });
        });

    });

    $('body').on('click', '.success-plus', function () {
        var id = $(this).data("id");
        Swal.fire({
            title: 'تایید و ثبت سفارش!',
            text: "سفارش تایید شده برای ثبت شماره حواله ارسال خواهد شد!",
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
                    url: "{{route('admin.scheduling.success')}}" + '/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات سفارش با موفقیت در سیستم تایید و ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        })
                    }
                });
            }
        })
    });

    function deleteService2(id, event) {
        event.preventDefault();
        $('#productt' + id).remove();
        $('#colorrr' + id).remove();
        $('#numberr' + id).remove();
        $('#numberexitt' + id).remove();
    }

    $('#sell').addClass('active');

</script>


<script>
    kamaDatepicker('from_date',
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
    kamaDatepicker('daatee',
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
