<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/public/js/datatab.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/row.js')}}" type="text/javascript"></script>
<style>
    .as-console-wrapper {
        display: none !important;
    }
</style>
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
    $(function () {
            <?php
            $productss = \App\Product::all();
            ?>
        var produc = [];
        @foreach($productss as $produc)
        produc.push({
            'id': '{{$produc->id}}',
            'label': '{{$produc->label}}',
        });
            @endforeach

        var invoice_product = [];
        @foreach($invoice_products as $invoice_product)
        invoice_product.push({
            'id': '{{$invoice_product->id}}',
            'product_id': '{{$invoice_product->product_id}}',
            'color_id': '{{$invoice_product->color_id}}',
            'leftover': '{{$invoice_product->leftover}}',
            'invoice_id': '{{$invoice_product->invoice_id}}'
        });
            @endforeach
        var invoice = [];
        @foreach($invoices as $invoice)
        invoice.push({
            'id': '{{$invoice->id}}',
            'label': '{{$invoice->label}}',
        });
            @endforeach
        var product = [];
        @foreach($products as $product)
        product.push({
            'id': '{{$product->id}}',
            'costumer': '{{$product->customer_id}}',
        });
            @endforeach
        var color = [];
        @foreach($colors as $color)
        color.push({
            'id': '{{$color->id}}',
            'name': '{{$color->name}}',
        });
        @endforeach


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            "bInfo": false,
            "paging": false,
            "bPaginate": false,
            "columnDefs": [
                {"orderable": false, "targets": 0},
            ],
            "order": [[10, "desc"]],
            "ordering": false,
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e8ecff');
                if (parseInt(aData.barn) < parseInt(aData.salesNumber)) {
                    $('td:eq(9)', nRow).css('color', '#fb8000');
                } else if (parseInt(aData.barn) >= parseInt(aData.salesNumber)) {
                    $('td:eq(9)', nRow).css('color', '#00d1fb');

                } else {
                    $('td', nRow).css('background-color', 'white');
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
            ajax: {
                ajax: "{{ route('admin.invoice.success') }}",
            },
            columns: [
                {data: 'checkbox', orderable: false, searchable: false, "className": "dt-center"},
                {data: 'id', name: 'id'},
                {data: 'invoice', name: 'invoice'},
                {data: 'user', name: 'user'},
                {data: 'customer', name: 'customer'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'salesNumber', name: 'salesNumber'},
                {data: 'leftover', name: 'leftover'},
                {data: 'barn', name: 'barn'},
                {data: 'barnn', name: 'barnn'},
                {data: 'action_success', name: 'action_success'},
            ],
            rowsGroup: [
                2, 3, 4
            ],
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
                url: "{{ route('admin.invoices.success.detail.cancel') }}",
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
                        table.draw();
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

        $('body').on('click', '.SendToListNumber', function () {
            $('#saveToListd').prop("disabled", false);
            var id = $(this).data('id');
            $.get("{{ route('admin.invoice.payment.checked') }}" + '/' + id, function (data) {
                $('#successdetailModal').modal('show');
                $('#invoice_product').val(id);
                $('#numbere').val(data.number - data.product);
                $('#alertdetail').text('تعداد تولید شده برای این محصول' + " " + data.product + " " + 'عدد میباشد');
                $('#alertdetail').show();
                if (data.number <= data.product) {
                    $('#saveToListd').prop("disabled", true);
                }

            })

        });

        $('body').on('click', '.scheduling', function () {
            var id = $(this).data('id');
            $('#schedulingModal').modal('show');
            $('#scheduling').val(id);
        });

        $('#saveToscheduling').click(function (e) {
            e.preventDefault();
            $('#saveToscheduling').text('در حال ثبت اطلاعات...');
            $('#saveToscheduling').prop("disabled", true);
            $.ajax({
                data: $('#schedulingform').serialize(),
                url: "{{ route('admin.invoices.success.detail.scheduling') }}",
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
                        $('#saveToscheduling').text('ثبت');
                        $('#saveToscheduling').prop("disabled", false);
                    }


                    if (data.erro) {
                        $('#schedulingform').trigger("reset");
                        $('#schedulingModal').modal('hide');
                        Swal.fire({
                            title: 'خطا!',
                            text: 'تعداد درخواستی شما بیشتر از موجودی انبار میباشد!',
                            icon: 'error',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveToscheduling').text('ثبت');
                        $('#saveToscheduling').prop("disabled", false);
                    }

                    if (data.error) {
                        $('#schedulingform').trigger("reset");
                        $('#schedulingModal').modal('hide');
                        Swal.fire({
                            title: 'خطا!',
                            text: 'تعداد ارسالی برای بارگیری نمیتواند بیشتر از تعداد درخواستی مشتری باشد!',
                            icon: 'error',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveToscheduling').text('ثبت');
                        $('#saveToscheduling').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#schedulingform').trigger("reset");
                        $('#schedulingModal').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveToscheduling').text('ثبت');
                        $('#saveToscheduling').prop("disabled", false);
                    }
                }
            });
        });

        $('#saveToListd').click(function (e) {
            e.preventDefault();
            $('#saveToListd').text('در حال ثبت اطلاعات...');
            $('#saveToListd').prop("disabled", true);
            $.ajax({
                data: $('#successdetailinvoices').serialize(),
                url: "{{ route('admin.invoices.success.detail.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errorr) {
                        $('#successdetailModal').modal('hide');
                        jQuery.each(data.errorr, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveToListd').text('ثبت');
                        $('#saveToListd').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#successdetailinvoices').trigger("reset");
                        $('#successdetailModal').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveToListd').text('ثبت');
                        $('#saveToListd').prop("disabled", false);
                    }
                }
            });
        });

        $('body').on('click', '.SendToList', function () {
            var id = $(this).data('id');
            $('#successModal').modal('show');
            $('#id_success').val(id);
        });

        $('body').on('click', '.Confirmpayment', function () {
            var id = $(this).data("id");
            $('#Confirmpayment').modal('show');
            $('#invoice_id_payment').val(id);
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

        $('#savePaymentConfirm').click(function (e) {
            e.preventDefault();
            $('#savePaymentConfirm').text('در حال ثبت اطلاعات...');
            $('#savePaymentConfirm').prop("disabled", true);
            var form = $('#PaymentConfirm')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{ route('admin.invoice.payment.confrim.store') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function (data) {
                    if (data.errors) {
                        $('#Confirmpayment').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#savePaymentConfirm').text('ثبت');
                        $('#savePaymentConfirm').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#PaymentConfirm').trigger("reset");
                        $('#Confirmpayment').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#savePaymentConfirm').text('ثبت');
                        $('#savePaymentConfirm').prop("disabled", false);
                    }
                }
            });
        });

        $('#savetolist').click(function (e) {
            e.preventDefault();
            $('#savetolist').text('در حال ثبت اطلاعات...');
            $('#savetolist').prop("disabled", true);
            var form = $('#tolistform')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{ route('admin.invoice.tolist.sotre.detail') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function (data) {
                    if (data.errors) {
                        $('#ToList').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#savetolist').text('ثبت');
                        $('#savetolist').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#tolistform').trigger("reset");
                        $('#ToList').modal('hide');
                        Swal.fire({
                            title: 'موفق',
                            text: 'درخواست شما برای صف تولید ارسال شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#savetolist').text('ثبت');
                        $('#savetolist').prop("disabled", false);
                    }
                }
            });
        });


        $('#saveToList').click(function (e) {
            e.preventDefault();
            $('#saveToList').text('در حال ثبت اطلاعات...');
            $('#saveToList').prop("disabled", true);
            $.ajax({
                data: $('#successinvoices').serialize(),
                url: "{{ route('admin.invoices.success.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#successModal').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveToList').text('ثبت');
                        $('#saveToList').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#successinvoices').trigger("reset");
                        $('#successModal').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveToList').text('ثبت');
                        $('#saveToList').prop("disabled", false);
                    }
                }
            });
        });

        $('body').on('click', '.deleteProduct', function () {
            $('#id_delete').val('');
            $('#description_c').val('');
            var id = $(this).data("id");
            $('#id_delete').val(id);
            $('#ajaxModelDelete').modal('show');

            $('#saveCancel').click(function (e) {
                e.preventDefault();

                var form = $('#CustomerCanceled')[0];
                var data = new FormData(form);

                $('#ajaxModelDelete').modal('hide');

                Swal.fire({
                    title: 'لغو پیش فاکتور؟',
                    text: "مشخصات پیش فاکتور لغو شده فقط توسط مدیریت قابل بازیابی میباشد!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'حذف',
                    cancelButtonText: 'انصراف',
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            data: data,
                            url: "{{ route('admin.invoice.delete') }}",
                            cache: false,
                            contentType: false,
                            processData: false,
                            method: 'POST',
                            type: 'POST',
                            success: function (data) {
                                table.draw();
                                Swal.fire({
                                    title: 'موفق',
                                    text: 'مشخصات پیش فاکتور با موفقیت از لیست شما حذف شد',
                                    icon: 'success',
                                    confirmButtonText: 'تایید'
                                });

                            }
                        });
                        $('#id_delete').val('');
                        $('#description').val('');
                    }

                });


            });

        });

        $("#select_all").change(function () {
            $(".student_checkbox").prop('checked', $(this).prop('checked'));
        });

        $("#show").click(function () {

            if ($('input:checkbox').prop("checked", true)) {
                alert(selectedIds)
            }
            var ids = '';
            $('input:checked:checked').each(function () {
                ids = selectedIds + ','
            });
            alert(ids);

        });

        $(document).on('click', '#bulk_delete', function () {
            var test = null;
            $('#productlistForm').trigger("reset");
            $('.ffff').remove();
            $('.ddddd').remove();
            var id = [];
            var include = [];
            $('.student_checkbox:checked').each(function () {
                id.push($(this).val());
            });
            $.ajax({
                url: "{{ route('admin.invoice.success.list.time')}}",
                method: "get",
                data: {id: id},
                success: function (data) {
                    data.forEach(function (item) {
                        for (var i in invoice_product) {
                            if (invoice_product[i].id == item) {
                                for (var p in product) {
                                    if (invoice_product[i].invoice_id == product[p].id) {
                                        include.push(product[p].costumer);
                                    }
                                }
                            }
                        }
                        ;
                        var min = Math.min.apply(null, include);
                        var max = Math.max.apply(null, include);
                        if (min == max) {
                            for (var i in invoice_product) {
                                if (invoice_product[i].id == item) {
                                    for (var d in invoice) {
                                        if (invoice_product[i].product_id == invoice[d].id) {
                                            for (var e in color) {
                                                if (invoice_product[i].color_id == color[e].id) {
                                                    $('#ajaxModel').modal('show');
                                                    var counter = 2;
                                                    var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
                                                    newTextBoxDiv.after().html('<div class="col-md-12">' +
                                                        '<label class="ffff">' + invoice[d].label + '' + ' - ' + '' + color[e].name + '</label>' +
                                                        '<input type="hidden" name="id_product[]" id="id_product" value="' + invoice_product[i].id + '">' +
                                                        '<input placeholder="لطفا مقدار بارگیری را وارد کنید" class="form-control ddddd"' +
                                                        'type="number" name="product_name[]" id="product_name" value="' + invoice_product[i].leftover + '" >' +
                                                        '</div>');
                                                    newTextBoxDiv.appendTo("#TextBoxesGroup");
                                                    counter++;
                                                }
                                            }
                                        }
                                    }

                                }
                            }
                        } else {
                            $('#ajaxModel').modal('hide');
                            Swal.fire({
                                title: 'اخطار',
                                text: 'مجاز برای ارسال به چند خریدار نمیباشید!',
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            });
                        }

                    });

                }

            });


        });

        $(document).on('click', '#To_List', function () {
            $('.numfff').remove();
            $('.productt_mmm').remove();
            $('.colorr_mmm').remove();
            $('.sum_mmm').remove();
            $('.sum_sss').remove();
            $('.date_mmm').remove();
            $('.olavittt').remove();
            var test = null;
            var id = [];
            var include = [];
            $('.student_checkbox:checked').each(function () {
                id.push($(this).val());
            });
            $.ajax({
                url: "{{ route('admin.invoice.add.tolist')}}",
                method: "get",
                data: {id: id},
                success: function (data) {
                    $('#ToList').modal('show');
                    added_inputs4_array = [];
                    data.details.forEach(function (entry) {
                        var invoice_p = {
                            'id': entry.id,
                            'product_id': entry.product_id,
                            'color_id': entry.color_id,
                            'salesNumber': entry.salesNumber,
                        };
                        added_inputs4_array.push(invoice_p);

                    });

                    if (added_inputs4_array.length >= 1)
                        for (var a in added_inputs4_array)
                            added_inputs_array_table3(added_inputs4_array[a], a);

                    function added_inputs_array_table3(data, a) {
                        var myNode = document.createElement('div');
                        myNode.id = 'numf' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input readonly type=\"text\" id=\'numff" + a + "\'  name=\"numff[]\"\n" +
                            "class=\"form-control numfff\"/>" +
                            "</div></div></div>";
                        document.getElementById('numf').appendChild(myNode);
                        $('#numff' + a + '').val(data.id);


                        var myNode = document.createElement('div');
                        myNode.id = 'product_m' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input readonly type=\"text\" id=\'productt_m" + a + "\'  name=\"productt_m[]\"\n" +
                            "class=\"form-control productt_mmm\"/>" +
                            "</div></div></div>";
                        document.getElementById('product_m').appendChild(myNode);

                        for (var pi in produc) {
                            if (data.product_id == produc[pi].id) {
                                $('#productt_m' + a + '').val(produc[pi].label);
                            }
                        }


                        var myNode = document.createElement('div');
                        myNode.id = 'color_m' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input readonly type=\"text\" id=\'colorr_m" + a + "\'  name=\"colorr_m[]\"\n" +
                            "class=\"form-control colorr_mmm\"/>" +
                            "</div></div></div>";
                        document.getElementById('color_m').appendChild(myNode);

                        for (var po in color) {
                            if (data.color_id == color[po].id) {
                                $('#colorr_m' + a + '').val(color[po].name);
                            }
                        }




                        var myNode = document.createElement('div');
                        myNode.id = 'sum_m' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input readonly type=\"text\" id=\'sum_mm" + a + "\'  name=\"sum_mm[]\"\n" +
                            "class=\"form-control sum_mmm\"/>" +
                            "</div></div></div>";
                        document.getElementById('sum_m').appendChild(myNode);
                        $('#sum_mm' + a + '').val(data.salesNumber);


                        var myNode = document.createElement('div');
                        myNode.id = 'sum_s' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input type=\"text\" id=\'sum_ss" + a + "\'  name=\"sum_ss[]\"\n" +
                            "class=\"form-control sum_sss\"/>" +
                            "</div></div></div>";
                        document.getElementById('sum_s').appendChild(myNode);

                        var myNode = document.createElement('div');
                        myNode.id = 'date_m' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<input type=\"text\" id=\'date_mm" + a + "\'  name=\"date_mm[]\"\n" +
                            "class=\"form-control date_mmm\"/>" +
                            "</div></div></div>";
                        document.getElementById('date_m').appendChild(myNode);


                        var myNode = document.createElement('div');
                        myNode.id = 'olavit' + a;
                        myNode.innerHTML += "<div class='form-group'>" +
                            "<select id=\'olavitt" + a + "\'  name=\"olavitt[]\"\n" +
                            "class=\"form-control olavittt\"/>" +
                            "<option>انتخاب کنید</option>" +
                            "<option value='بسیار مهم'>بسیار مهم</option>" +
                            "<option value='مهم'>مهم</option>" +
                            "<option value='عادی'>عادی</option>" +
                            "</select>" +
                            "</div></div></div>";
                        document.getElementById('olavit').appendChild(myNode);


                    }

                }

            });

        });

        $('#saveBtnListS').click(function (e) {
            e.preventDefault();

            $('#saveBtnListS').text('در حال ارسال اطلاعات...');
            $('#saveBtnListS').prop("disabled", true);
            $.ajax({
                data: $('#productlistForm').serialize(),
                url: "{{ route('admin.invoices.success.list.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    if (data.error) {
                        $('#ajaxModel').modal('hide');
                        jQuery.each(data.error, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveBtnListS').text('ثبت');
                        $('#saveBtnListS').prop("disabled", false);
                    }

                    if (data.success) {
                        $('#productlistForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtnListS').text('ثبت');
                        $('#saveBtnListS').prop("disabled", false);
                    }

                    if (data.errorss) {
                        $('#productlistForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        Swal.fire({
                            title: 'خطا!',
                            text: 'تعداد درخواستی شما بیشتر از موجودی انبار میباشد!',
                            icon: 'error',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtnListS').text('ثبت');
                        $('#saveBtnListS').prop("disabled", false);
                    }

                    if (data.errorr) {
                        $('#productlistForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        Swal.fire({
                            title: 'خطا!',
                            text: 'تعداد ارسالی برای بارگیری نمیتواند بیشتر از تعداد درخواستی مشتری باشد!',
                            icon: 'error',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtnListS').text('ثبت');
                        $('#saveBtnListS').prop("disabled", false);
                    }

                    if (data.erro) {
                        $('#productlistForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        Swal.fire({
                            title: 'خطا!',
                            text: 'تعداد ارسالی برای بارگیری نمیتواند بیشتر از تعداد درخواستی مشتری باشد!',
                            icon: 'error',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtnListS').text('ثبت');
                        $('#saveBtnListS').prop("disabled", false);
                    }

                    if (data.eerrorr) {
                        $('#productlistForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        Swal.fire({
                            title: 'خطا!',
                            text: 'تعداد ارسالی برای بارگیری نمیتواند بیشتر از تعداد درخواستی مشتری باشد!',
                            icon: 'error',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtnListS').text('ثبت');
                        $('#saveBtnListS').prop("disabled", false);
                    }

                    if (data.eerrrorr) {
                        $('#productlistForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        Swal.fire({
                            title: 'خطا!',
                            text: 'تعداد ارسالی برای بارگیری نمیتواند بیشتر از تعداد درخواستی مشتری باشد!',
                            icon: 'error',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtnListS').text('ثبت');
                        $('#saveBtnListS').prop("disabled", false);
                    }

                    if (data.emppty) {
                        $('#productlistForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        Swal.fire({
                            title: 'خطا!',
                            text: 'تعداد درخواستی محصولات شما از موجودی انبار بیشتر میباشد!',
                            icon: 'error',
                            confirmButtonText: 'تایید',
                        });
                        $('#saveBtnListS').text('ثبت');
                        $('#saveBtnListS').prop("disabled", false);
                    }

                }
            });
        });

        kamaDatepicker('datev',
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


    });

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
        added_inputs4_array.push(data);
        added_inputs_array_table3(data, added_inputs4_array.length - 1);
    }

    $('#sell').addClass('active');


</script>

