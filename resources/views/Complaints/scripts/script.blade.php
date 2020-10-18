<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/public/js/jquery.maskedinput.js')}}" type="text/javascript"></script>

<meta name="_token" content="{{ csrf_token() }}"/>
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
            "bInfo": false,
            "paging": false,
            "bPaginate": false,
            "columnDefs": [
                {"orderable": false, "targets": 0},
            ],
            "order": [[8, "Acs"]],
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e8ecff');
                if (aData.status == 'اتمام یافته') {
                    $('td:eq(7)', nRow).css('background-color', 'rgba(0,183,255,0.64)');
                } else if (aData.status == 'در حال برسی') {
                    $('td:eq(7)', nRow).css('background-color', 'rgba(255,250,130,0.64)');
                } else {
                    $('td:eq(7)', nRow).css('background-color', 'rgba(255,110,2,0.65)');
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
            ajax: "{{ route('admin.Complaints.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                {data: 'code', name: 'code'},
                {data: 'date', name: 'date'},
                {data: 'customer', name: 'customer'},
                {data: 'importance', name: 'importance'},
                {data: 'invoice', name: 'invoice'},
                {data: 'title', name: 'title'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        $('#createNewProduct').click(function () {
            $('#productFossrm').trigger("reset");
            $('#ajaxModel').modal('show');
            $('#product').val('');
        });

        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.device.update') }}" + '/' + product_id, function (data) {
                $('#ajaxModel').modal('show');
                $('#caption').text('ویرایش مشخصات دستگاه');
                $('#product').val(data.id);
                $('#name').val(data.name);
                $('#code').val(data.code);
                $('#model').val(data.model);
            })
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();

            var form = $('#productFossrm')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{ route('admin.Complaints.store') }}",
                data: data,
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

        $('body').on('click', '.returns', function () {
            var id = $(this).data('id');
            $(".invoicesa").remove();
            $(".product").remove();
            $(".color").remove();
            $(".number").remove();
            $(".reasons").remove();
            $(".totalnumber").remove();
            $(".actions").remove();
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
                    $('#customer_idese').val(data.data.customer_id);
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
                            "<select id=\'invoice" + a + "\'  name=\"invoice[]\"\n" +
                            "class=\"form-control invoicesa\"/>" +
                            "</select>" +
                            "</div></div></div>";
                        document.getElementById('invoiceee').appendChild(myNode);


                        var myNode = document.createElement('div');
                        myNode.id = 'producttt' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<select id=\'product" + a + "\'  name=\"product[]\"\n" +
                            "class=\"form-control product\"/>" +
                            "</select>" +
                            "</div></div></div>";
                        document.getElementById('producttt').appendChild(myNode);


                        var myNode = document.createElement('div');
                        myNode.id = 'colorrr' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<select id=\'color" + a + "\'  name=\"color[]\"\n" +
                            "class=\"form-control color\"/>" +
                            "</select>" +
                            "</div></div></div>";
                        document.getElementById('colorrr').appendChild(myNode);

                        var myNode = document.createElement('div');
                        myNode.id = 'totalnumberrr' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input type=\"text\" id=\'totalnumber" + a + "\' readonly  name=\"totalnumber[]\"\n" +
                            "class=\"form-control totalnumber\"/>" +
                            "</div></div></div>";
                        document.getElementById('totalnumberrr').appendChild(myNode);

                        var myNode = document.createElement('div');
                        myNode.id = 'numberrr' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input type=\"text\" id=\'number" + a + "\'  name=\"number[]\"\n" +
                            "class=\"form-control number\"/>" +
                            "</div></div></div>";
                        document.getElementById('numberrr').appendChild(myNode);
                        $('#number' + a + '').val(data.number);

                        var myNode = document.createElement('div');
                        myNode.id = 'reasonsss' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<select id=\'reasons" + a + "\'  name=\"reasons[]\"\n" +
                            "class=\"form-control reasons\"/>" +
                            "<option>انتخاب کنید</option>" +
                            "<option value='ایراد کیفی'>ایراد کیفی</option>" +
                            "<option value='ارسال محصول اشتباه'>ارسال محصول اشتباه</option>" +
                            "<option value='عدم نیاز مشتری'>عدم نیاز مشتری</option>" +
                            "<option value='سایر'>سایر</option>" +
                            "</select>" +
                            "</div></div></div>";
                        document.getElementById('reasonsss').appendChild(myNode);
                        $('#reasons' + a + '').val(data.reason);

                        var myNode = document.createElement('div');
                        myNode.id = 'actiontt' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<button onclick='deleteService3(" + a + ", event)' class=\"form-control btn btn-danger actions\"><i class=\"fa fa-remove\"></button></div>";
                        document.getElementById('actiontt').appendChild(myNode);


                        $('#customer_idese').change(function () {
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

        $('#saveB').click(function (e) {
            e.preventDefault();

            var form = $('#productFor')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{ route('admin.returns.store.sttoree') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
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
                        $('#saveB').text('ثبت');
                        $('#saveB').prop("disabled", false);
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
                        $('#saveB').text('ثبت');
                        $('#saveB').prop("disabled", false);
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

    $('body').on('click', '.deleteProduct', function () {
        var id = $(this).data("id");
        Swal.fire({
            title: 'حذف دستگاه؟',
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
                    url: "{{route('admin.device.delete')}}" + '/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        $('#data-table').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات دستگاه با موفقیت از سیستم حذف شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        })
                    }
                });
            }
        })
    });

    $('#retu').addClass('active');

</script>

<script>
    kamaDatepicker('datee',
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
    kamaDatepicker('dattee',
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
        myNode.id = 'filee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"file\" id=\'fille" + a + "\'  name=\"fille[]\"\n" +
            "class=\"form-control\"/>" +
            "</div></div></div>";
        document.getElementById('filee').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'actiont' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<button onclick='deleteService2(" + a + ", event)' class=\"form-control btn btn-danger\"><i class=\"fa fa-remove\"></button></div>";
        document.getElementById('actiont').appendChild(myNode);


        $('#customerre').change(function () {
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
        $('#totalnumberr' + id).remove();
        $('#numberr' + id).remove();
        $('#reasonss' + id).remove();
        $('#filee' + id).remove();
        $('#actiont' + id).remove();
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
