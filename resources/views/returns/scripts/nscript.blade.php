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

    $(function () {

        var retur = [];
        @foreach($returns as $return)
        retur.push({
            'id': '{{$return->id}}',
            'customer_id': '{{$return->customer_id}}',
        });
            @endforeach

        var invoice_product = [];
        @foreach($detail_returnss as $detail_return)
        invoice_product.push({
            'id': '{{$detail_return->id}}',
            'return_id': '{{$detail_return->return_id}}',
            'invoice_id': '{{$detail_return->invoice_id}}',
            'product_id': '{{$detail_return->product_id}}',
            'color_id': '{{$detail_return->color_id}}',
            'number': '{{$detail_return->number}}',
        });
            @endforeach
        var product = [];
        @foreach($products as $product)
        product.push({
            'id': '{{$product->id}}',
            'label': '{{$product->label}}',
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
            "ordering": false,
            "order": [[0, "deesc"]],
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.returns.list.nosuccess') }}",
            columns: [
                {data: 'checkbox', orderable: false, searchable: false, "className": "dt-center"},
                {data: 'code', name: 'code'},
                {data: 'date', name: 'date'},
                {data: 'user_id', name: 'user_id'},
                {data: 'costumer_id', name: 'costumer_id'},
                {data: 'label', name: 'label'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
            ],
            rowsGroup:
                [
                    1, 2, 3, 4
                ],
        });
        $("#select_all").change(function () {
            $(".student_checkbox").prop('checked', $(this).prop('checked'));
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
                url: "{{ route('admin.returns.list.nosuccess.select')}}",
                method: "get",
                data: {id: id},
                success: function (data) {
                    data.forEach(function (item) {
                        for (var i in invoice_product) {
                            if (invoice_product[i].id == item) {
                                for (var p in retur) {
                                    if (invoice_product[i].return_id == retur[p].id) {
                                        include.push(retur[p].customer_id);
                                    }
                                }
                            }
                        };
                        var min = Math.min.apply(null, include);
                        var max = Math.max.apply(null, include);
                        if (min == max) {
                            for (var i in invoice_product) {
                                if (invoice_product[i].id == item) {
                                    for (var d in product) {
                                        if (invoice_product[i].product_id == product[d].id) {
                                            for (var e in color) {
                                                if (invoice_product[i].color_id == color[e].id) {
                                                    $('#ajaxModell').modal('show');
                                                    var counter = 2;
                                                    var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
                                                    newTextBoxDiv.after().html('<div class="col-md-12">' +
                                                        '<label class="ffff">' + product[d].label + '' + ' - ' + '' + color[e].name + '</label>' +
                                                        '<input type="hidden" name="id_product[]" id="id_product" value="' + invoice_product[i].id + '">' +
                                                        '<input placeholder="لطفا مقدار بارگیری را وارد کنید" class="form-control ddddd"' +
                                                        'type="number" name="product_name[]" id="product_name" value="' + invoice_product[i].number + '" >' +
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


        $('#saveBtnListS').click(function (e) {
            e.preventDefault();

            $('#saveBtnListS').text('در حال ارسال اطلاعات...');
            $('#saveBtnListS').prop("disabled", true);
            $.ajax({
                data: $('#productlistForm').serialize(),
                url: "{{ route('admin.returns.success.list.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    if (data.error) {
                        $('#ajaxModell').modal('hide');
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
                        $('#ajaxModell').modal('hide');
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


                }
            });
        });


    });

    $('#retu').addClass('active');
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
</script>



