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

    invoice_product = [];
    invoice_color = [];
        @foreach($products as $product)

    var invoice_products = {
            'id': "{{$product->id}}",
            'label': "{{$product->label}}",
        };
    invoice_product.push(invoice_products);
        @endforeach
        @foreach($colors as $color)

    var invoice_colors = {
            'id': "{{$color->id}}",
            'name': "{{$color->name}}",
        };
    invoice_color.push(invoice_colors);
    @endforeach

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
            ajax: "{{ route('admin.returns.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                {data: 'code', name: 'code'},
                {data: 'date', name: 'date'},
                {data: 'user_id', name: 'user_id'},
                {data: 'costumer_id', name: 'costumer_id'},
                {data: 'detail_returns', name: 'detail_returns'},
                {data: 'Description_m', name: 'Description_m'},
                {data: 'Description_v', name: 'Description_v'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('body').on('click', '.chast', function () {
            var id = $(this).data('id');

            $.get("{{ route('admin.return.check.chat') }}" + '/' + id, function (data) {
                $('#chatdd').modal('show');

                if (data.time != null) {
                    $('#name_fo').text(data.user.name + " " + "(کارشناس فروش)");
                    $('#time_fo').text(data.time);
                    $('#txt_fo').text(data.data.Description_v);
                } else {
                    $('#name_fo').text('');
                    $('#time_fo').text('');
                    $('#txt_fo').text('');
                }
                if (data.timee != null) {
                    $('#time_mfo').text(data.timee);
                    $('#txt_mfo').text(data.return_manager.description);
                    $('#name_mfo').text(data.userr.name + " " + "(مدیر فروش)");
                } else {
                    $('#time_mfo').text('');
                    $('#txt_mfo').text('');
                    $('#name_mfo').text('');
                }


                if (data.timeee != null) {
                    $('#name_mo').text(data.userrr.name + " " + "(قائم مقام)");
                    $('#time_mo').text(data.timeee);
                    $('#txt_mo').text(data.return_admin.descriptionone);
                } else {
                    $('#name_mo').text('');
                    $('#time_mo').text('');
                    $('#txt_mo').text('');
                }


                if (data.timeeea != null) {
                    $('#name_aa').text(data.userrra.name + " " + "(نظر نهایی قائم مقام)");
                    $('#time_aa').text(data.timeeea);
                    $('#txt_aa').text(data.return_admina.descriptiontwo);
                } else {
                    $('#name_aa').text('');
                    $('#time_aa').text('');
                    $('#txt_aa').text('');
                }


                if (data.timeeee != null) {
                    $('#name_a').text(data.userrrr.name + " " + "(مسئول انبار)");
                    $('#time_a').text(data.timeeee);
                    $('#txt_a').text(data.return_barn.description);
                } else {
                    $('#name_a').text('');
                    $('#time_a').text('');
                    $('#txt_a').text('');
                }


                if (data.timeeeee != null) {
                    $('#name_q').text(data.userrrr.name + " " + "(مسئول کنترل کیفیت)");
                    $('#time_q').text(data.timeeeee);
                    $('#txt_q').text(data.return_qc.description);
                } else {
                    $('#name_q').text('');
                    $('#time_q').text('');
                    $('#txt_q').text('');
                }


            });
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

        $('body').on('click', '.usert', function () {
            var id = $(this).data('id');
            $('#user_').modal('show');
            $('#id_').val(id);
            $('#dateeeee').DataTable().destroy();
            $('.dateeeee').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
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
                    "processing": "در حال پردازش اطلاعات",
                },
                ajax: {
                    url: "{{ route('admin.returns.store.manager.admii') }}",
                    data: {
                        detail_factor: id,
                    },
                },
                columns: [
                    {data: 'invoices', name: 'invoices', "className": "dt-center"},

                    {data: 'user', name: 'user'},
                    {data: 'customer', name: 'customer'},
                    {data: 'product', name: 'product'},
                    {data: 'color', name: 'color'},
                    {data: 'number', name: 'number'},
                    {data: 'date', name: 'date'},
                ],
                rowsGroup:
                    [
                        1, 2, 6
                    ],
            });
        });

        $('body').on('click', '.admi', function () {
            var id = $(this).data('id');
            $('#admi_').modal('show');
            $('#id_m').val(id);
            $('#ides_').val(id);
            $('#dateeeeee').DataTable().destroy();
            $('.dateeeeee').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
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
                    "processing": "در حال پردازش اطلاعات",
                },
                ajax: {
                    url: "{{ route('admin.returns.store.manager.admii') }}",
                    data: {
                        detail_factor: id,
                    },
                },
                columns: [
                    {data: 'invoices', name: 'invoices', "className": "dt-center"},

                    {data: 'user', name: 'user'},
                    {data: 'customer', name: 'customer'},
                    {data: 'product', name: 'product'},
                    {data: 'color', name: 'color'},
                    {data: 'number', name: 'number'},
                    {data: 'date', name: 'date'},
                ],
                rowsGroup:
                    [
                        1, 2, 6
                    ],

            });
        });

        $('#saveu').click(function (e) {
            e.preventDefault();
            $('#saveu').text('در حال ثبت اطلاعات...');
            $('#saveu').prop("disabled", true);
            $.ajax({
                data: $('#userform').serialize(),
                url: "{{ route('admin.returns.store.manager') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#user_').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveu').text('ثبت');
                        $('#saveu').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#userform').trigger("reset");
                        $('#user_').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveu').text('ثبت');
                        $('#saveu').prop("disabled", false);
                    }
                }
            });
        });

        $('#saverr').click(function (e) {
            e.preventDefault();
            $('#saverr').text('در حال ثبت اطلاعات...');
            $('#saverr').prop("disabled", true);
            $.ajax({
                data: $('#userfform').serialize(),
                url: "{{ route('admin.returns.store.manager.admi') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#admi_').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saverr').text('ثبت');
                        $('#saverr').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#userfform').trigger("reset");
                        $('#admi_').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saverr').text('ثبت');
                        $('#saverr').prop("disabled", false);
                    }
                }
            });
        });

        $('body').on('click', '.qc', function () {
            var id = $(this).data('id');
            $(".invoicesa").remove();
            $(".product").remove();
            $(".color").remove();
            $(".number").remove();
            $(".m").remove();
            $(".s").remove();
            $('#id_id').val(id);
            $.ajax({
                type: 'GET',
                url: "{{route('admin.Complaints.check')}}",
                data: {
                    'id': id,
                    '_token': $('input[name=_token]').val(),
                },
                success: function (data) {
                    $('#qcmodel').modal('show');
                    $('#customerr_id').val(data.data.customer_id);
                    $('#descriptiuon').text(data.data.Description_v);
                    var test;
                    added_inputs3_array = [];

                    data.detail_returns.forEach(function (entry) {
                        var invoice_producte = {
                            'id': entry.id,
                            'invoice_id': entry.invoice_id,
                            'product_id': entry.product_id,
                            'color_id': entry.color_id,
                            'reason': entry.reason,
                            'number': entry.number,
                        };
                        added_inputs3_array.push(invoice_producte);
                    });

                    if (added_inputs3_array.length >= 1)
                        for (var a in added_inputs3_array)
                            added_inputs_array_table3(added_inputs3_array[a], a);

                    function added_inputs_array_table3(data, a) {
                        var myNode = document.createElement('div');
                        myNode.id = 'invoiceee' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<select readonly id=\'invoice" + a + "\'  name=\"invoice[]\"\n" +
                            "class=\"form-control invoicesa\"/>" +
                            "</select>" +
                            "</div></div></div>";
                        document.getElementById('invoiceee').appendChild(myNode);


                        var myNode = document.createElement('div');
                        myNode.id = 'producttt' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<select readonly id=\'product" + a + "\'  name=\"product[]\"\n" +
                            "class=\"form-control product\"/>" +
                            "</select>" +
                            "</div></div></div>";
                        document.getElementById('producttt').appendChild(myNode);


                        var myNode = document.createElement('div');
                        myNode.id = 'colorrr' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<select readonly id=\'color" + a + "\'  name=\"color[]\"\n" +
                            "class=\"form-control color\"/>" +
                            "</select>" +
                            "</div></div></div>";
                        document.getElementById('colorrr').appendChild(myNode);


                        var myNode = document.createElement('div');
                        myNode.id = 'numberrr' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input readonly type=\"text\" id=\'number" + a + "\'  name=\"number[]\"\n" +
                            "class=\"form-control number\"/>" +
                            "</div></div></div>";
                        document.getElementById('numberrr').appendChild(myNode);
                        $('#number' + a + '').val(data.number);


                        var myNode = document.createElement('div');
                        myNode.id = 'sss' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input  type=\"text\" id=\'ss" + a + "\'  name=\"ss[]\"\n" +
                            "class=\"form-control ss\"/>" +
                            "</div></div></div>";
                        document.getElementById('sss').appendChild(myNode);


                        var myNode = document.createElement('div');
                        myNode.id = 'ss' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input  type=\"text\" id=\'s" + a + "\'  name=\"s[]\"\n" +
                            "class=\"form-control s\"/>" +
                            "</div></div></div>";
                        document.getElementById('ss').appendChild(myNode);

                        var myNode = document.createElement('div');
                        myNode.id = 'mm' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input  type=\"text\" id=\'m" + a + "\'  name=\"m[]\"\n" +
                            "class=\"form-control m\"/>" +
                            "</div></div></div>";
                        document.getElementById('mm').appendChild(myNode);


                        $('#customerr_id').change(function () {
                            var invoices = [];
                            var commodityID = null;
                            commodityID = $(this).val();
                            $.ajax({
                                type: "GET",
                                url: "{{route('admin.invoice.number.return')}}?commodity_id=" + commodityID,
                                success: function (res) {
                                    if (res) {

                                        $('#invoice' + a + '').empty();
                                        $.each(res, function (key, value) {
                                            invoices.push({
                                                'id': value.id,
                                                'invoice_id': value.invoiceNumber,
                                            });
                                        });
                                        $('#invoice' + a + '').append('<option>' + "لطفا فاکتور را انتخاب کنید" + '</option>');
                                        for (var i in invoices) {

                                            $('#invoice' + a + '').append('<option value="' + invoices[i].id + '">' + invoices[i].invoice_id + '</option>');
                                            $('#invoice' + a + '').val(data.invoice_id);

                                        }
                                    } else {
                                        $('#invoice' + a + '').append('<option>' + fsfsd + '</option>');

                                    }
                                }
                            });
                        }).change();
                        $('#invoice' + a + '').change(function () {
                            var products = [];
                            var product = data.invoice_id;

                            $.ajax({
                                type: "GET",
                                url: "{{route('admin.invoice.product.return')}}?product=" + product,
                                success: function (res) {
                                    if (res) {
                                        $('#product' + a + '').empty();
                                        $('#product' + a + '').append('<option>' + "انتخاب محصول" + '</option>');
                                        $.each(res, function (key, value) {
                                            products.push({
                                                'product_id': value.product_id,
                                            });
                                        });
                                        for (var p in products) {
                                            for (var io in invoice_product) {
                                                if (invoice_product[io].id == products[p].product_id) {
                                                    $('#product' + a + '').append('<option value="' + invoice_product[io].id + '">' + invoice_product[io].label + '</option>');
                                                    $('#product' + a + '').val(data.product_id);
                                                }
                                            }
                                        }
                                    } else {
                                    }
                                }
                            });
                        }).change();


                        $('#product' + a + ',#invoice' + a + '').change(function () {
                            var colors = [];
                            var color = null;
                            var p = null;
                            color = data.invoice_id;
                            p = data.product_id;
                            $.ajax({
                                type: "GET",
                                data: {
                                    color: color,
                                    p: p
                                },
                                url: "{{route('admin.invoice.color.return')}}",
                                success: function (res) {
                                    if (res) {
                                        $('#color' + a + '').empty();
                                        $('#color' + a + '').append('<option>' + "انتخاب رنگ" + '</option>');
                                        $.each(res, function (key, value) {
                                            colors.push({
                                                'color_id': value.color_id,
                                            });
                                        });

                                        for (var c in colors) {
                                            for (var io in invoice_color) {
                                                if (invoice_color[io].id == colors[c].color_id) {
                                                    $('#color' + a + '').append('<option value="' + invoice_color[io].id + '">' + invoice_color[io].name + '</option>');
                                                    $('#color' + a + '').val(data.color_id);
                                                }
                                            }
                                        }
                                    } else {
                                    }
                                }
                            });
                        }).change();

                        $('#product' + a + ',#invoice' + a + ',#color' + a + '')
                            .change(function () {
                                var color = null;
                                var p = null;
                                var c = null;
                                color = data.invoice_id;
                                p = data.product_id;
                                c = data.color_id;
                                $.ajax({
                                    type: "GET",
                                    data: {
                                        color: color,
                                        p: p,
                                        c: c,
                                    },
                                    url: "{{route('admin.invoice.totalnumber.return')}}",
                                    success: function (res) {
                                        if (res) {

                                            $('#totalnumber' + a + '').val(res.salesNumber);
                                        } else {
                                        }
                                    }
                                });
                            }).change();


                    }
                }
            });
        });

        $('body').on('click', '.qr', function () {
            var id = $(this).data('id');
            $('#id').val(id);
            $('#ajaxqr').modal('show');


            $('#saveqr').click(function (e) {
                var user = $('#productlistFormqr').serialize();
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.returns.store.store.qr')}}?id=" + id,
                    data: user,
                    dataType: 'html',
                    success: function (res) {


                        w = window.open(window.location.href, "_blank");
                        w.document.open();
                        w.document.write(res);
                        w.document.close();
                        w.location.reload();


                    }
                });


            });


        });

        $('body').on('click', '.database', function () {
            var id = $(this).data('id');
            $(".invoicesa").remove();
            $(".product").remove();
            $(".color").remove();
            $(".number").remove();
            $(".m").remove();
            $(".s").remove();
            $('#id_d').val(id);
            $.ajax({
                type: 'GET',
                url: "{{route('admin.Complaints.check')}}",
                data: {
                    'id': id,
                    '_token': $('input[name=_token]').val(),
                },
                success: function (data) {
                    $('#databasemodel').modal('show');
                    $('#customerr_id').val(data.data.customer_id);
                    $('#descriptiuon').text(data.data.description);
                    var test;
                    added_inputs4_array = [];
                    data.detail_returns.forEach(function (entry) {
                        var invoice_producte = {
                            'id': entry.id,
                            'invoice_id': entry.invoice_id,
                            'product_id': entry.product_id,
                            'color_id': entry.color_id,
                            'reason': entry.reason,
                            'number': entry.number,
                            'Healthy': entry.Healthy,
                            'wastage': entry.wastage,
                        };
                        added_inputs4_array.push(invoice_producte);
                    });
                    if (added_inputs4_array.length >= 1)
                        for (var a in added_inputs4_array)
                            added_inputs_array_table3(added_inputs4_array[a], a);

                    function added_inputs_array_table3(data, a) {
                        var myNode = document.createElement('div');
                        myNode.id = 'invoiceeee' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<select readonly id=\'invoice" + a + "\'  name=\"invoice[]\"\n" +
                            "class=\"form-control invoicesa\"/>" +
                            "</select>" +
                            "</div></div></div>";
                        document.getElementById('invoiceeee').appendChild(myNode);


                        var myNode = document.createElement('div');
                        myNode.id = 'productttt' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<select readonly id=\'product" + a + "\'  name=\"product[]\"\n" +
                            "class=\"form-control product\"/>" +
                            "</select>" +
                            "</div></div></div>";
                        document.getElementById('productttt').appendChild(myNode);


                        var myNode = document.createElement('div');
                        myNode.id = 'colorrrr' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<select readonly id=\'coloor" + a + "\'  name=\"coloor[]\"\n" +
                            "class=\"form-control color\"/>" +
                            "</select>" +
                            "</div></div></div>";
                        document.getElementById('colorrrr').appendChild(myNode);


                        var myNode = document.createElement('div');
                        myNode.id = 'numberrrr' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input type=\"text\" id=\'number" + a + "\'  name=\"number[]\"\n" +
                            "class=\"form-control number\"/>" +
                            "</div></div></div>";
                        document.getElementById('numberrrr').appendChild(myNode);
                        $('#number' + a + '').val(data.number);


                        $('#customerr_id').change(function () {
                            var invoices = [];
                            var commodityID = null;
                            commodityID = $(this).val();
                            $.ajax({
                                type: "GET",
                                url: "{{route('admin.invoice.number.return')}}?commodity_id=" + commodityID,
                                success: function (res) {
                                    if (res) {

                                        $('#invoice' + a + '').empty();
                                        $.each(res, function (key, value) {
                                            invoices.push({
                                                'id': value.id,
                                                'invoice_id': value.invoiceNumber,
                                            });
                                        });
                                        $('#invoice' + a + '').append('<option>' + "لطفا فاکتور را انتخاب کنید" + '</option>');
                                        for (var i in invoices) {

                                            $('#invoice' + a + '').append('<option value="' + invoices[i].id + '">' + invoices[i].invoice_id + '</option>');
                                            $('#invoice' + a + '').val(data.invoice_id);

                                        }
                                    } else {
                                        $('#invoice' + a + '').append('<option>' + fsfsd + '</option>');

                                    }
                                }
                            });
                        }).change();
                        $('#invoice' + a + '').change(function () {
                            var products = [];
                            var product = data.invoice_id;

                            $.ajax({
                                type: "GET",
                                url: "{{route('admin.invoice.product.return')}}?product=" + product,
                                success: function (res) {
                                    if (res) {
                                        $('#product' + a + '').empty();
                                        $('#product' + a + '').append('<option>' + "انتخاب محصول" + '</option>');
                                        $.each(res, function (key, value) {
                                            products.push({
                                                'product_id': value.product_id,
                                            });
                                        });
                                        for (var p in products) {
                                            for (var io in invoice_product) {
                                                if (invoice_product[io].id == products[p].product_id) {
                                                    $('#product' + a + '').append('<option value="' + invoice_product[io].id + '">' + invoice_product[io].label + '</option>');
                                                    $('#product' + a + '').val(data.product_id);
                                                }
                                            }
                                        }
                                    } else {
                                    }
                                }
                            });
                        }).change();
                        $('#product' + a + ',#invoice' + a + '').change(function () {
                            var colors = [];
                            var color = null;
                            var p = null;
                            color = data.invoice_id;
                            p = data.product_id;
                            $.ajax({
                                type: "GET",
                                data: {
                                    color: color,
                                    p: p
                                },
                                url: "{{route('admin.invoice.color.return')}}",
                                success: function (res) {
                                    if (res) {
                                        $('#coloor' + a + '').empty();
                                        $('#coloor' + a + '').append('<option>' + "انتخاب رنگ" + '</option>');
                                        $.each(res, function (key, value) {
                                            colors.push({
                                                'color_id': value.color_id,
                                            });
                                        });

                                        for (var c in colors) {
                                            for (var io in invoice_color) {
                                                if (invoice_color[io].id == colors[c].color_id) {
                                                    $('#coloor' + a + '').append('<option value="' + invoice_color[io].id + '">' + invoice_color[io].name + '</option>');
                                                    $('#coloor' + a + '').val(data.color_id);
                                                }
                                            }
                                        }
                                    } else {
                                    }
                                }
                            });
                        }).change();
                        $('#product' + a + ',#invoice' + a + ',#coloor' + a + '')
                            .change(function () {
                                var color = null;
                                var p = null;
                                var c = null;
                                color = data.invoice_id;
                                p = data.product_id;
                                c = data.color_id;
                                $.ajax({
                                    type: "GET",
                                    data: {
                                        color: color,
                                        p: p,
                                        c: c,
                                    },
                                    url: "{{route('admin.invoice.totalnumber.return')}}",
                                    success: function (res) {
                                        if (res) {

                                            $('#totalnumber' + a + '').val(res.salesNumber);
                                        } else {
                                        }
                                    }
                                });
                            }).change();
                    }
                }
            });
        });

        $('body').on('click', '.dm', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.returns.check.dm') }}" + '/' + id, function (data) {
                $('#ajaxModeldm').modal('show');
                $('#dd').val(data.Description_m);
            });
        });

        $('body').on('click', '.df', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.returns.check.dm') }}" + '/' + id, function (data) {
                $('#ajaxModeldf').modal('show');
                $('#ff').val(data.Description_v);
            });
        });

        $('body').on('click', '.deletereturns', function () {
            var id = $(this).data("id");
            Swal.fire({
                title: 'حذف مرجوعی؟',
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
                        url: "{{route('admin.returns.delete')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#data-table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'موفق',
                                text: 'مشخصات مرجوعی با موفقیت از سیستم حذف شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });

        $('#createNewProduct').click(function () {
            $('#productForm').trigger("reset");
            $('#ajaxModel').modal('show');
            $('#caption').text('تعریف مرجوعی جدید');
            $('#product').val('');
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $('#saveBtn').text('در حال ثبت اطلاعات...');
            $('#saveBtn').prop("disabled", true);
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.returns.store.store') }}",
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
                    }
                }
            });
        });

        $('#savea').click(function (e) {
            e.preventDefault();
            $('#savea').text('در حال ثبت اطلاعات...');
            $('#savea').prop("disabled", true);
            $.ajax({
                data: $('#productFor').serialize(),
                url: "{{ route('admin.returns.store.store.barn') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#qcmodel').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#savea').text('ثبت');
                        $('#savea').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#productFor').trigger("reset");
                        $('#qcmodel').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#savea').text('ثبت');
                        $('#savea').prop("disabled", false);
                    }
                }
            });
        });

        $('#saveaa').click(function (e) {
            e.preventDefault();
            $('#savea').text('در حال ثبت اطلاعات...');
            $('#savea').prop("disabled", true);
            $.ajax({
                data: $('#productFoorr').serialize(),
                url: "{{ route('admin.returns.store.store.barn.admin') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#qcmodel').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#savea').text('ثبت');
                        $('#savea').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#productFoorr').trigger("reset");
                        $('#ajaxModelfdslistr').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveaa').text('ثبت');
                        $('#saveaa').prop("disabled", false);
                    }
                }
            });
        });

        $('#saved').click(function (e) {
            e.preventDefault();
            $('#saved').text('در حال ثبت اطلاعات...');
            $('#saved').prop("disabled", true);
            $.ajax({
                data: $('#databaseFor').serialize(),
                url: "{{ route('admin.returns.store.success.barn') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#databasemodel').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saved').text('ثبت');
                        $('#saved').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#databaseFor').trigger("reset");
                        $('#databasemodel').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saved').text('ثبت');
                        $('#saved').prop("disabled", false);
                    }
                }
            });
        });

        $('#savebtnupdate').click(function (e) {
            e.preventDefault();
            $('#savebtnupdate').text('در حال ثبت اطلاعات...');
            $('#savebtnupdate').prop("disabled", true);
            $.ajax({
                data: $('#productFormm').serialize(),
                url: "{{ route('admin.returns.store.store.update') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#editajaxModel').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#savebtnupdate').text('ثبت');
                        $('#savebtnupdate').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#productFormm').trigger("reset");
                        $('#editajaxModel').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#savebtnupdate').text('ثبت');
                        $('#savebtnupdate').prop("disabled", false);
                    }
                }
            });
        });

    });

    function deleteService3(id, event) {
        event.preventDefault();
        $('#invoiceee' + id).remove();
        $('#producttt' + id).remove();
        $('#colorrr' + id).remove();
        $('#totalnumberrr' + id).remove();
        $('#numberrr' + id).remove();
        $('#reasonsss' + id).remove();
        $('#actiontt' + id).remove();


    }

    function addInput11() {
        var data = {
            'title': '',
            'icon': '',
        };
        added_inputs3_array.push(data);
        added_inputs_array_table3(data, added_inputs3_array.length - 1);
    }

    function deleteService4(id, event) {
        event.preventDefault();
        $('#invoiceeee' + id).remove();
        $('#productttt' + id).remove();
        $('#colorrrr' + id).remove();
        $('#totalnumberrrr' + id).remove();
        $('#numberrrr' + id).remove();
        $('#reasonssss' + id).remove();
        $('#actionttt' + id).remove();


    }

    function addInput12() {
        var data = {
            'title': '',
            'icon': '',
        };
        added_inputs3_array.push(data);
        added_inputs_array_table3(data, added_inputs3_array.length - 1);
    }

    $('body').on('click', '.admiinc', function () {
        var detail_factor = $(this).data('id');
        $('#ajaxModelfdslistr').modal('show');
        $('#id_m').val(detail_factor);
        $('#dateeee').DataTable().destroy();
        $('.dateeee').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
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
                "processing": "در حال پردازش اطلاعات",
            },
            ajax: {
                url: "{{ route('admin.returns.store.manager.admii') }}",
                data: {
                    detail_factor: detail_factor,
                },
            },
            columns: [
                {data: 'invoices', name: 'invoices', "className": "dt-center"},
                {data: 'user', name: 'user'},
                {data: 'customer', name: 'customer'},

                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'wastage', name: 'wastage'},
                {data: 'wastagem', name: 'wastagem'},
                {data: 'Healthy', name: 'Healthy'},
                {data: 'date', name: 'date'},
            ],
            rowsGroup:
                [
                    1, 2, 9
                ],

        });
    });

    $('#retu').addClass('active');

</script>


<script>
    $('body').on('click', '.editt', function () {
        var id = $(this).data('id');
        $(".invoiceee_").remove();
        $(".producttt_").remove();
        $(".colorrr_").remove();
        $(".numberrr_").remove();
        $(".totalnumberrr_").remove();
        $(".actioo").remove();
        $(".reasonsss_").remove();
        $('#id_returns').val(id);
        $.ajax({
            type: 'GET',
            url: "{{route('admin.returns.edit.update')}}",
            data: {
                'id': id,
                '_token': $('input[name=_token]').val(),
            },
            success: function (data) {
                $('#editajaxModel').modal('show');
                $('#customer_idd').val(data.data.customer_id);
                $('#Carryy').val(data.data.Cost);
                $('#datee').val(data.data.date);
                $('#description_mm').val(data.data.Description_m);
                $('#description_ff').val(data.data.Description_v);

                var test;
                added_inputs2_array = [];

                data.detail_returns.forEach(function (entry) {
                    var invoice_producte = {
                        'id': entry.id,
                        'invoice_id': entry.invoice_id,
                        'product_id': entry.product_id,
                        'color_id': entry.color_id,
                        'reason': entry.reason,
                        'number': entry.number,
                        'Healthy': entry.Healthy,
                        'wastage': entry.wastage,
                    };
                    added_inputs2_array.push(invoice_producte);
                });

                if (added_inputs2_array.length >= 1)
                    for (var a in added_inputs2_array)
                        added_inputs_array_table2(added_inputs2_array[a], a);

                function added_inputs_array_table2(data, a) {
                    var myNode = document.createElement('div');
                    myNode.id = 'invoice_' + a;
                    myNode.innerHTML += "<div class='form-group'>" +
                        "<select id=\'invoicee_" + a + "\'  name=\"invoicee_[]\"\n" +
                        "class=\"form-control invoiceee_\"/>" +
                        "</select>" +
                        "</div></div></div>";
                    document.getElementById('invoice_').appendChild(myNode);


                    var myNode = document.createElement('div');
                    myNode.id = 'product_' + a;
                    myNode.innerHTML += "<div class='form-group'>" +
                        "<select id=\'productt_" + a + "\'  name=\"productt_[]\"\n" +
                        "class=\"form-control producttt_\"/>" +
                        "</select>" +
                        "</div></div></div>";
                    document.getElementById('product_').appendChild(myNode);


                    var myNode = document.createElement('div');
                    myNode.id = 'color_' + a;
                    myNode.innerHTML += "<div class='form-group'>" +
                        "<select id=\'colorr_" + a + "\'  name=\"colorr_[]\"\n" +
                        "class=\"form-control colorrr_\"/>" +
                        "</select>" +
                        "</div></div></div>";
                    document.getElementById('color_').appendChild(myNode);

                    var myNode = document.createElement('div');
                    myNode.id = 'totalnumber_' + a;
                    myNode.innerHTML += "<div class='form-group'>" +
                        "<input type=\"text\" id=\'totalnumberr_" + a + "\' readonly  name=\"totalnumberr_[]\"\n" +
                        "class=\"form-control totalnumberrr_\"/>" +
                        "</div></div></div>";
                    document.getElementById('totalnumber_').appendChild(myNode);

                    var myNode = document.createElement('div');
                    myNode.id = 'number_' + a;
                    myNode.innerHTML += "<div class='form-group'>" +
                        "<input type=\"text\" id=\'numberr_" + a + "\'  name=\"numberr_[]\"\n" +
                        "class=\"form-control numberrr_\"/>" +
                        "</div></div></div>";
                    document.getElementById('number_').appendChild(myNode);
                    $('#numberr_' + a + '').val(data.number);

                    var myNode = document.createElement('div');
                    myNode.id = 'reasons_' + a;
                    myNode.innerHTML += "<div class='form-group'>" +
                        "<select id=\'reasonss_" + a + "\'  name=\"reasonss_[]\"\n" +
                        "class=\"form-control reasonsss_\"/>" +
                        "<option>انتخاب کنید</option>" +
                        "<option value='ایراد کیفی'>ایراد کیفی</option>" +
                        "<option value='ارسال محصول اشتباه'>ارسال محصول اشتباه</option>" +
                        "<option value='عدم نیاز مشتری'>عدم نیاز مشتری</option>" +
                        "<option value='سایر'>سایر</option>" +
                        "</select>" +
                        "</div></div></div>";
                    document.getElementById('reasons_').appendChild(myNode);
                    $('#reasonss_' + a + '').val(data.reason);

                    var myNode = document.createElement('div');
                    myNode.id = 'actionttttt' + a;
                    myNode.innerHTML += "<div class='form-group'>" +
                        "<button onclick='deleteService5(" + a + ", event)' class=\"form-control btn btn-danger actioo\"><i class=\"fa fa-remove \"></button></div>";
                    document.getElementById('actionttttt').appendChild(myNode);

                    $('#customer_idd').change(function () {
                        var invoices = [];
                        var commodityID = null;
                        commodityID = $(this).val();
                        $.ajax({
                            type: "GET",
                            url: "{{route('admin.invoice.number.return')}}?commodity_id=" + commodityID,
                            success: function (res) {
                                if (res) {

                                    $('#invoicee_' + a + '').empty();
                                    $.each(res, function (key, value) {
                                        invoices.push({
                                            'id': value.id,
                                            'invoice_id': value.invoiceNumber,
                                        });
                                    });
                                    $('#invoicee_' + a + '').append('<option>' + "لطفا فاکتور را انتخاب کنید" + '</option>');
                                    for (var i in invoices) {

                                        $('#invoicee_' + a + '').append('<option value="' + invoices[i].id + '">' + invoices[i].invoice_id + '</option>');
                                        $('#invoicee_' + a + '').val(data.invoice_id);

                                    }
                                } else {
                                    $('#invoicee_' + a + '').append('<option>' + fsfsd + '</option>');

                                }
                            }
                        });
                    }).change();

                    $('#invoicee_' + a + '').change(function () {
                        var products = [];
                        var product = data.invoice_id;

                        $.ajax({
                            type: "GET",
                            url: "{{route('admin.invoice.product.return')}}?product=" + product,
                            success: function (res) {
                                if (res) {
                                    $('#productt_' + a + '').empty();
                                    $('#productt_' + a + '').append('<option>' + "انتخاب محصول" + '</option>');
                                    $.each(res, function (key, value) {
                                        products.push({
                                            'product_id': value.product_id,
                                        });
                                    });
                                    for (var p in products) {
                                        for (var io in invoice_product) {
                                            if (invoice_product[io].id == products[p].product_id) {
                                                $('#productt_' + a + '').append('<option value="' + invoice_product[io].id + '">' + invoice_product[io].label + '</option>');
                                                $('#productt_' + a + '').val(data.product_id);
                                            }
                                        }
                                    }
                                } else {
                                }
                            }
                        });
                    }).change();

                    $('#productt_' + a + ',#invoicee_' + a + '').change(function () {
                        var colors = [];
                        var color = null;
                        var p = null;
                        color = data.invoice_id;
                        p = data.product_id;
                        $.ajax({
                            type: "GET",
                            data: {
                                color: color,
                                p: p
                            },
                            url: "{{route('admin.invoice.color.return')}}",
                            success: function (res) {
                                if (res) {
                                    $('#colorr_' + a + '').empty();
                                    $('#colorr_' + a + '').append('<option>' + "انتخاب رنگ" + '</option>');
                                    $.each(res, function (key, value) {
                                        colors.push({
                                            'color_id': value.color_id,
                                        });
                                    });

                                    for (var c in colors) {
                                        for (var io in invoice_color) {
                                            if (invoice_color[io].id == colors[c].color_id) {
                                                $('#colorr_' + a + '').append('<option value="' + invoice_color[io].id + '">' + invoice_color[io].name + '</option>');
                                                $('#colorr_' + a + '').val(data.color_id);
                                            }
                                        }
                                    }
                                } else {
                                }
                            }
                        });
                    }).change();

                    $('#productt_' + a + ',#invoicee_' + a + ',#colorr_' + a + '')
                        .change(function () {
                            var color = null;
                            var p = null;
                            var c = null;
                            color = data.invoice_id;
                            p = data.product_id;
                            c = data.color_id;
                            $.ajax({
                                type: "GET",
                                data: {
                                    color: color,
                                    p: p,
                                    c: c,
                                },
                                url: "{{route('admin.invoice.totalnumber.return')}}",
                                success: function (res) {
                                    if (res) {

                                        $('#totalnumberr_' + a + '').val(res.salesNumber);
                                    } else {
                                    }
                                }
                            });
                        }).change();
                }

            }
        });

    });


</script>

<script language="javascript">

    added_inputs2_array = [];
    if (added_inputs2_array.length >= 1)
        for (var a in added_inputs2_array)
            added_inputs_array_table2(added_inputs2_array[a], a);

    function added_inputs_array_table2(data, a) {
        var myNode = document.createElement('div');
        myNode.id = 'invoicee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'invoice" + a + "\'  name=\"invoice[]\"\n" +
            "class=\"form-control\"/>" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('invoicee').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'productt' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'product" + a + "\'  name=\"product[]\"\n" +
            "class=\"form-control\"/>" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('productt').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'colorr' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'color" + a + "\'  name=\"color[]\"\n" +
            "class=\"form-control\"/>" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('colorr').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'totalnumberr' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'totalnumber" + a + "\' readonly  name=\"totalnumber[]\"\n" +
            "class=\"form-control totalnumber\"/>" +
            "</div></div></div>";
        document.getElementById('totalnumberr').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'numberr' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'number" + a + "\'  name=\"number[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('numberr').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'reasonss' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'reasons" + a + "\'  name=\"reasons[]\"\n" +
            "class=\"form-control\"/>" +
            "<option>انتخاب کنید</option>" +
            "<option value='ایراد کیفی'>ایراد کیفی</option>" +
            "<option value='ارسال محصول اشتباه'>ارسال محصول اشتباه</option>" +
            "<option value='عدم نیاز مشتری'>عدم نیاز مشتری</option>" +
            "<option value='سایر'>سایر</option>" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('reasonss').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'actiont' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<button onclick='deleteService2(" + a + ", event)' class=\"form-control btn btn-danger\"><i class=\"fa fa-remove\"></button></div>";
        document.getElementById('actiont').appendChild(myNode);


        $('#customer_id').change(function () {
            var invoices = [];
            var commodityID = null;
            commodityID = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{route('admin.invoice.number.return')}}?commodity_id=" + commodityID,
                success: function (res) {
                    if (res) {

                        $('#invoice' + a + '').empty();
                        $.each(res, function (key, value) {
                            invoices.push({
                                'id': value.id,
                                'invoice_id': value.invoiceNumber,
                            });
                        });
                        $('#invoice' + a + '').append('<option>' + "لطفا فاکتور را انتخاب کنید" + '</option>');
                        for (var i in invoices) {

                            $('#invoice' + a + '').append('<option value="' + invoices[i].id + '">' + invoices[i].invoice_id + '</option>');
                        }
                    } else {
                        $('#invoice' + a + '').append('<option>' + fsfsd + '</option>');

                    }
                }
            });
        }).change();

        $('#invoice' + a + '').change(function () {
            var products = [];
            var product = null;
            product = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{route('admin.invoice.product.return')}}?product=" + product,
                success: function (res) {
                    if (res) {
                        $('#product' + a + '').empty();
                        $('#product' + a + '').append('<option>' + "انتخاب محصول" + '</option>');
                        $.each(res, function (key, value) {
                            products.push({
                                'product_id': value.product_id,
                            });
                        });
                        for (var p in products) {
                            for (var io in invoice_product) {
                                if (invoice_product[io].id == products[p].product_id) {
                                    $('#product' + a + '').append('<option value="' + invoice_product[io].id + '">' + invoice_product[io].label + '</option>');

                                }
                            }
                        }
                    } else {
                    }
                }
            });
        }).change();

        $('#product' + a + ',#invoice' + a + '').change(function () {
            var colors = [];
            var color = null;
            var p = null;
            color = $('#invoice' + a + '').val();
            p = $('#product' + a + '').val();
            $.ajax({
                type: "GET",
                data: {
                    color: color,
                    p: p
                },
                url: "{{route('admin.invoice.color.return')}}",
                success: function (res) {
                    if (res) {
                        $('#color' + a + '').empty();
                        $('#color' + a + '').append('<option>' + "انتخاب رنگ" + '</option>');
                        $.each(res, function (key, value) {
                            colors.push({
                                'color_id': value.color_id,
                            });
                        });

                        for (var c in colors) {
                            for (var io in invoice_color) {
                                if (invoice_color[io].id == colors[c].color_id) {
                                    $('#color' + a + '').append('<option value="' + invoice_color[io].id + '">' + invoice_color[io].name + '</option>');
                                }
                            }
                        }
                    } else {
                    }
                }
            });
        }).change();


        $('#product' + a + ',#invoice' + a + ',#color' + a + '')
            .change(function () {
                var color = null;
                var p = null;
                var c = null;
                color = $('#invoice' + a + '').val();
                p = $('#product' + a + '').val();
                c = $('#color' + a + '').val();
                $.ajax({
                    type: "GET",
                    data: {
                        color: color,
                        p: p,
                        c: c,
                    },
                    url: "{{route('admin.invoice.totalnumber.return')}}",
                    success: function (res) {
                        if (res) {

                            $('#totalnumber' + a + '').val(res.salesNumber);
                        } else {
                        }
                    }
                });
            }).change();

    }

    function deleteService2(id, event) {
        event.preventDefault();
        $('#invoicee' + id).remove();
        $('#productt' + id).remove();
        $('#colorr' + id).remove();
        $('#numberr' + id).remove();
        $('#datee' + id).remove();
        $('#reasonss' + id).remove();
        $('#totalnumberr' + id).remove();
        $('#actiont' + id).remove();

    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    function addInput10() {
        var data = {
            'title': '',
            'icon': '',
        };
        added_inputs2_array.push(data);
        added_inputs_array_table2(data, added_inputs2_array.length - 1);

    }

    function deleteService5(id, event) {
        event.preventDefault();
        $('#invoice_' + id).remove();
        $('#product_' + id).remove();
        $('#color_' + id).remove();
        $('#totalnumber_' + id).remove();
        $('#number_' + id).remove();
        $('#reasons_' + id).remove();
        $('#actionttttt' + id).remove();
    }

    function addInput13() {
        var data = {
            'title': '',
            'icon': '',
        };
        added_inputs1_array.push(data);
        added_inputs_array_table1(data, added_inputs1_array.length - 1);
    }

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

</script>


