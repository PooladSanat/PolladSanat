<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
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
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e8ecff');
            },
            "bInfo": false,
            "paging": false,
            "bPaginate": false,
            "columnDefs": [
                {"orderable": false, "targets": 0},
            ],
            "order": [[2, "dessc"]],
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.transferbarn.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                {data: 'id', name: 'id'},
                {data: 'in_barn', name: 'in_barn'},
                {data: 'to_barn', name: 'to_barn'},
                {data: 'date', name: 'date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#createNewProduct').click(function () {
            $('#productForm').trigger("reset");
            $('#ajaxModel').modal('show');
            $('#caption').text('انتقال بین انبارها');
            $('#id').val('');
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.transferbarn.store') }}",
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
                            text: 'مشخصات  با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                    }
                }
            });
        });


        $('#saveBtne').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#productForme').serialize(),
                url: "{{ route('admin.transferbarn.update') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#ajaxModell').modal('hide');
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
                        $('#ajaxModell').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات  با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
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

    $('#barn').addClass('active');


    $('body').on('click', '.editProduct', function () {
        added_inputs3_array = [];
        var id = $(this).data('id');
        $('#idsa').val(id);
        $(".ttype_bbarnnn").remove();
        $(".pproducttt").remove();
        $(".ccolorrr").remove();
        $(".nnumberrr").remove();
        $(".aactiontt").remove();
        $.ajax({
            type: 'GET',
            url: "{{route('admin.transferbarn.edit')}}",
            data: {
                'id': id,
                '_token': $('input[name=_token]').val(),
            },
            success: function (data) {
                $('#ajaxModell').modal('show');
                data.detail_returns.forEach(function (entry) {
                    var invoice_producte = {
                        'type_barn': entry.type_barn,
                        'product': entry.product,
                        'color': entry.color,
                        'number': entry.number,
                    };
                    added_inputs3_array.push(invoice_producte);
                });
                $('#inbarnnn').val(data.data.in_barn);
                $('#tobarnnnn').val(data.data.to_barn);
                if (added_inputs3_array.length >= 1)
                    for (var a in added_inputs3_array)
                        added_inputs_array_table3(added_inputs3_array[a], a);
            }

        });

    });

    function added_inputs_array_table3(data, a) {


        var myNode = document.createElement('div');
        myNode.id = 'ttype_barn' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'ttype_barnn" + a + "\'  name=\"ttype_barnn[]\"\n" +
            "class=\"form-control ttype_bbarnnn\"/>" +
            "<option style='background-color: #aab1b4'>انتخاب کنید</option>" +
            "<option value='1'>انبار محصولات درجه 1</option>" +
            "<option value='2'>انبار محصولات درجه 2</option>" +
            "<option value='3'>انبار ضایعات</option>" +
            "<option value='4'>انبار مستربچ</option>" +
            "<option value='5'>انبار مواد پلیمیری</option>" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('ttype_barn').appendChild(myNode);
        $('#ttype_barnn' + a + '').val(data.type_barn);

        var myNode = document.createElement('div');
        myNode.id = 'pproduct' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'pproductt" + a + "\'  name=\"pproductt[]\"\n" +
            "class=\"form-control pproducttt\"/>" +
            "<option style='background-color: #aab1b4'>انتخاب کنید</option>" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('pproduct').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'ccolor' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'ccolorr" + a + "\'  name=\"ccolorr[]\"\n" +
            "class=\"form-control ccolorrr\"/>" +
            "<option style='background-color: #aab1b4'>انتخاب کنید</option>" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('ccolor').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'nnumber' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'nnumberr" + a + "\'  name=\"nnumberr[]\"\n" +
            "class=\"form-control nnumberrr\"/>" +
            "</div></div></div>";
        document.getElementById('nnumber').appendChild(myNode);
        $('#nnumberr' + a + '').val(data.number);


        var myNode = document.createElement('div');
        myNode.id = 'aaction' + a;
        myNode.innerHTML += "<div class='form-group aactiontt'>" +
            "<button onclick='deleteService3(" + a + ", event)' class=\"form-control btn btn-danger\"><i class=\"fa fa-remove\"></button></div>";
        document.getElementById('aaction').appendChild(myNode);

        $('#ttype_barnn' + a + '').change(function () {

            var type_barn;
            type_barn = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{route('admin.transferbarn.check')}}?type_barn=" + type_barn,
                success: function (res) {
                    console.log(res);
                    if (res) {
                        if (res.products) {
                            if (res.products) {

                                $('#pproductt' + a + '').empty();
                                $('#pproductt' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');

                                $('#ccolorr' + a + '').empty();
                                $('#ccolorr' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');

                                var products = [];
                                $.each(res.products, function (key, value) {
                                    products.push({
                                        'id': value.id,
                                        'label': value.label,
                                    });
                                });
                                for (var p in products) {
                                    $('#pproductt' + a + '').val(data.product);
                                    $('#pproductt' + a + '').append('<option value="' + products[p].id + '">' + products[p].label + '</option>');
                                }
                                for (var c in invoice_color) {
                                    $('#ccolorr' + a + '').val(data.color);
                                    $('#ccolorr' + a + '').append('<option value="' + invoice_color[c].id + '">' + invoice_color[c].name + '</option>');
                                }
                            } else {
                            }
                        }

                        if (res.productss) {
                            if (res.productss) {
                                $('#pproductt' + a + '').empty();
                                $('#pproductt' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');
                                $('#ccolorr' + a + '').empty();
                                $('#ccolorr' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');

                                var productss = [];
                                $.each(res.productss, function (key, value) {
                                    productss.push({
                                        'id': value.id,
                                        'label': value.label,
                                    });
                                });
                                for (var p in productss) {
                                    $('#pproductt' + a + '').val(data.product);
                                    $('#pproductt' + a + '').append('<option value="' + productss[p].id + '">' + productss[p].label + '</option>');
                                }
                                for (var c in invoice_color) {
                                    $('#ccolorr' + a + '').val(data.color);
                                    $('#ccolorr' + a + '').append('<option value="' + invoice_color[c].id + '">' + invoice_color[c].name + '</option>');
                                }
                            } else {
                            }
                        }

                        if (res.productsss) {
                            if (res.productsss) {
                                $('#pproductt' + a + '').empty();
                                $('#pproductt' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');
                                $('#ccolorr' + a + '').empty();
                                $('#ccolorr' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');

                                var productsss = [];
                                $.each(res.productsss, function (key, value) {
                                    productsss.push({
                                        'id': value.id,
                                        'label': value.label,
                                    });
                                });
                                for (var p in productsss) {
                                    $('#pproductt' + a + '').val(data.product);
                                    $('#pproductt' + a + '').append('<option value="' + productsss[p].id + '">' + productsss[p].label + '</option>');
                                }
                                for (var c in invoice_color) {
                                    $('#ccolorr' + a + '').val(data.color);
                                    $('#ccolorr' + a + '').append('<option value="' + invoice_color[c].id + '">' + invoice_color[c].name + '</option>');
                                }
                            } else {
                            }
                        }

                        if (res.masterbach) {
                            if (res.masterbach) {
                                $('#pproductt' + a + '').empty();
                                $('#pproductt' + a + '').empty();
                                $('#pproductt' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');
                                var masterbach = [];
                                $.each(res.masterbach, function (key, value) {
                                    masterbach.push({
                                        'id': value.id,
                                        'name': value.name,
                                        'manufacturer': value.manufacturer,
                                        'masterbatch': value.masterbatch,
                                    });
                                });
                                for (var p in masterbach) {
                                    $('#pproductt' + a + '').val(data.product);

                                    $('#pproductt' + a + '').append('<option value="' + masterbach[p].id + '">' + masterbach[p].name + " - " + masterbach[p].manufacturer + "-" + masterbach[p].masterbatch + '</option>');
                                }

                                $('#ccolorr' + a + '').empty().append('<option readonly="">نیازی به انتخاب رنگ نمیباشد</option>');

                            } else {
                            }
                        }

                        if (res.polymeric) {
                            if (res.polymeric) {
                                $('#pproductt' + a + '').empty();
                                $('#pproductt' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');
                                var polymeric = [];
                                $.each(res.polymeric, function (key, value) {
                                    polymeric.push({
                                        'id': value.id,
                                        'grid': value.grid,
                                        'type': value.type,
                                    });
                                });
                                for (var p in polymeric) {
                                    $('#pproductt' + a + '').val(data.product);

                                    $('#pproductt' + a + '').append('<option value="' + polymeric[p].id + '">' + polymeric[p].grid + " - " + polymeric[p].type + '</option>');
                                }
                                $('#ccolorr' + a + '').empty().append('<option readonly="">نیازی به انتخاب رنگ نمیباشد</option>');

                            } else {
                            }
                        }
                    }


                }
            });
        }).change();


    }

    function deleteService3(id, event) {
        event.preventDefault();
        $('#ttype_barnn' + id).remove();
        $('#pproductt' + id).remove();
        $('#ccolorr' + id).remove();
        $('#nnumberr' + id).remove();
        $('#aaction' + id).remove();

    }

    function addInput11() {
        var data = {
            'title': '',
            'icon': '',
        };
        added_inputs3_array.push(data);
        added_inputs_array_table3(data, added_inputs3_array.length - 1);
    }
</script>

<script language="javascript">

    added_inputs2_array = [];
    if (added_inputs2_array.length >= 1)
        for (var a in added_inputs2_array)
            added_inputs_array_table2(added_inputs2_array[a], a);

    function added_inputs_array_table2(data, a) {


        var myNode = document.createElement('div');
        myNode.id = 'type_barn' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'type_barnn" + a + "\'  name=\"type_barnn[]\"\n" +
            "class=\"form-control\"/>" +
            "<option style='background-color: #aab1b4'>انتخاب کنید</option>" +
            "<option value='1'>انبار محصولات درجه 1</option>" +
            "<option value='2'>انبار محصولات درجه 2</option>" +
            "<option value='3'>انبار ضایعات</option>" +
            "<option value='4'>انبار مستربچ</option>" +
            "<option value='5'>انبار مواد پلیمیری</option>" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('type_barn').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'product' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'productt" + a + "\'  name=\"productt[]\"\n" +
            "class=\"form-control\"/>" +
            "<option style='background-color: #aab1b4'>انتخاب کنید</option>" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('product').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'color' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'colorr" + a + "\'  name=\"colorr[]\"\n" +
            "class=\"form-control\"/>" +
            "<option style='background-color: #aab1b4'>انتخاب کنید</option>" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('color').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'number' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'numberr" + a + "\'  name=\"numberr[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('number').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'action' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<button onclick='deleteService2(" + a + ", event)' class=\"form-control btn btn-danger\"><i class=\"fa fa-remove\"></button></div>";
        document.getElementById('action').appendChild(myNode);


        $('#type_barnn' + a + '').change(function () {
            var type_barn = null;
            type_barn = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{route('admin.transferbarn.check')}}?type_barn=" + type_barn,
                success: function (res) {

                    if (res.products) {
                        if (res.products) {

                            $('#productt' + a + '').empty();
                            $('#productt' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');

                            $('#colorr' + a + '').empty();
                            $('#colorr' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');

                            var products = [];
                            $.each(res.products, function (key, value) {
                                products.push({
                                    'id': value.id,
                                    'label': value.label,
                                });
                            });
                            for (var p in products) {
                                $('#productt' + a + '').append('<option value="' + products[p].id + '">' + products[p].label + '</option>');
                            }
                            for (var c in invoice_color) {
                                $('#colorr' + a + '').append('<option value="' + invoice_color[c].id + '">' + invoice_color[c].name + '</option>');
                            }
                        } else {
                        }
                    }

                    if (res.productss) {
                        if (res.productss) {
                            $('#productt' + a + '').empty();
                            $('#productt' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');
                            $('#colorr' + a + '').empty();
                            $('#colorr' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');

                            var productss = [];
                            $.each(res.productss, function (key, value) {
                                productss.push({
                                    'id': value.id,
                                    'label': value.label,
                                });
                            });
                            for (var p in productss) {
                                $('#productt' + a + '').append('<option value="' + productss[p].id + '">' + productss[p].label + '</option>');
                            }
                            for (var c in invoice_color) {
                                $('#colorr' + a + '').append('<option value="' + invoice_color[c].id + '">' + invoice_color[c].name + '</option>');
                            }
                        } else {
                        }
                    }

                    if (res.productsss) {
                        if (res.productsss) {
                            $('#productt' + a + '').empty();
                            $('#productt' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');
                            $('#colorr' + a + '').empty();
                            $('#colorr' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');

                            var productsss = [];
                            $.each(res.productsss, function (key, value) {
                                productsss.push({
                                    'id': value.id,
                                    'label': value.label,
                                });
                            });
                            for (var p in productsss) {
                                $('#productt' + a + '').append('<option value="' + productsss[p].id + '">' + productsss[p].label + '</option>');
                            }
                            for (var c in invoice_color) {
                                $('#colorr' + a + '').append('<option value="' + invoice_color[c].id + '">' + invoice_color[c].name + '</option>');
                            }
                        } else {
                        }
                    }

                    if (res.masterbach) {
                        if (res.masterbach) {
                            $('#productt' + a + '').empty();
                            $('#productt' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');
                            var masterbach = [];
                            $.each(res.masterbach, function (key, value) {
                                masterbach.push({
                                    'id': value.id,
                                    'name': value.name,
                                    'manufacturer': value.manufacturer,
                                    'masterbatch': value.masterbatch,
                                });
                            });
                            for (var p in masterbach) {
                                $('#productt' + a + '').append('<option value="' + masterbach[p].id + '">' + masterbach[p].name + " - " + masterbach[p].manufacturer + "-" + masterbach[p].masterbatch + '</option>');
                            }

                            $('#colorr' + a + '').empty().append('<option readonly="">نیازی به انتخاب رنگ نمیباشد</option>');

                        } else {
                        }
                    }

                    if (res.polymeric) {
                        if (res.polymeric) {
                            $('#productt' + a + '').empty();
                            $('#productt' + a + '').append('<option style=\'background-color: #aab1b4\'>' + "انتخاب محصول" + '</option>');
                            var polymeric = [];
                            $.each(res.polymeric, function (key, value) {
                                polymeric.push({
                                    'id': value.id,
                                    'grid': value.grid,
                                    'type': value.type,
                                });
                            });
                            for (var p in polymeric) {
                                $('#productt' + a + '').append('<option value="' + polymeric[p].id + '">' + polymeric[p].grid + " - " + polymeric[p].type + '</option>');
                            }
                            $('#colorr' + a + '').empty().append('<option readonly="">نیازی به انتخاب رنگ نمیباشد</option>');

                        } else {
                        }
                    }

                }
            });
        }).change();


    }

    function deleteService2(id, event) {
        event.preventDefault();
        $('#type_barnn' + id).remove();
        $('#productt' + id).remove();
        $('#colorr' + id).remove();
        $('#numberr' + id).remove();
        $('#action' + id).remove();

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

</script>
