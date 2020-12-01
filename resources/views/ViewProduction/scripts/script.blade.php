<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
<script src="{{asset('/public/js/jquery.maskedinput.js')}}" type="text/javascript"></script>

<!-- Datatables Js-->


<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>


{{--<script src="//code.jquery.com/jquery-1.10.2.js"></script>--}}
{{--<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>--}}

{{--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>--}}


<meta name="_token" content="{{ csrf_token() }}"/>

<script type="text/javascript">
    <?php
    $polymerics = \App\Polymeric::all();
    ?>
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
            "order": [[8, "deshc"]],
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e6e6e6');

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
            ajax: "{{ route('admin.viewproduct.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                {data: 'product_color', name: 'product_color', "className": "dt-center"},
                {data: 'minimum', name: 'minimum', "className": "dt-center"},
                {data: 'maximum', name: 'maximum', "className": "dt-center"},
                {data: 'Inventory', name: 'Inventory', "className": "dt-center"},
                {data: 'number', name: 'number', "className": "dt-center"},
                {data: 'tolid', name: 'tolid', "className": "dt-center"},
                {data: 'device', name: 'device', "className": "dt-center"},
                {data: 'action', name: 'action', "className": "dt-center"},
            ]
        });

        $('body').on('click', '.new_product', function () {
            document.getElementById("warning_mavad").style.display = "none";

            var id = $(this).data("id");
            var prod = $(this).data("prod-id");
            $('#ajax_new_product').modal('show');
            $('#product_id').val(id);
            $('#p').val(id);
            var device_id = $('#device_id').val();
            $('#color_id').val(prod);
            $('#c').val(prod);
            var product = $('#product_id').val();
            $.ajax({
                type: "GET",
                data: {
                    product: product,
                },
                url: "{{route('admin.viewproduct.check')}}",
                success: function (res) {
                    if (res) {
                        $('#format_id').val(res.format_id);
                        $('#stime').val(res.cycletime);
                        if (res.insert_id == null) {
                            $('#insert_id').val(0);
                        } else {
                            $('#insert_id').val(res.insert_id);
                        }

                    } else {

                    }
                }
            });
            $('#dat-table-d').DataTable().destroy();
            $('.dat-table-d').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                createdRow: function (row, data, index) {
                    $(row).addClass('row1'),
                        $(row).attr('data-id', data.id)
                },
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
                    url: "{{ route('admin.viewproduct.devices.list') }}",
                    data: {
                        device_id: device_id,
                    },
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'id', name: 'id'},
                    {data: 'product', name: 'product'},
                    {data: 'color', name: 'color'},
                    {data: 'number', name: 'number'},
                    {data: 'startt', name: 'startt'},
                    {data: 'productiontime', name: 'productiontime'},
                    {data: 'status', name: 'status'},
                ]
            });
        });

        $('body').on('click', '.product_change', function () {
            var id = $(this).data("id");
            $('#edit_id').val(id);
            $('#product_change').modal('show');
            var device_id = $('#device_idd').val();

            $('#dat-table-change').DataTable().destroy();
            $('.dat-table-change').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                createdRow: function (row, data, index) {
                    $(row).addClass('row1'),
                        $(row).attr('data-id', data.id)
                },
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
                    url: "{{ route('admin.viewproduct.devices.list') }}",
                    data: {
                        device_id: device_id,
                    },
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'id', name: 'id'},
                    {data: 'product', name: 'product'},
                    {data: 'color', name: 'color'},
                    {data: 'number', name: 'number'},
                    {data: 'startt', name: 'startt'},
                    {data: 'productiontime', name: 'productiontime'},
                    {data: 'status', name: 'status'},
                ]
            });
        });

        $('#device_id')
            .change(function () {
                var device_id = $('#device_id').val();
                $('#dat-table-d').DataTable().destroy();
                $('.dat-table-d').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    createdRow: function (row, data, index) {
                        $(row).addClass('row1'),
                            $(row).attr('data-id', data.id)
                    },
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
                        url: "{{ route('admin.viewproduct.devices.list') }}",
                        data: {
                            device_id: device_id,
                        },
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                        {data: 'id', name: 'id'},
                        {data: 'product', name: 'product'},
                        {data: 'color', name: 'color'},
                        {data: 'number', name: 'number'},
                        {data: 'startt', name: 'startt'},
                        {data: 'productiontime', name: 'productiontime'},
                        {data: 'status', name: 'status'},
                    ]
                });
            }).change();

        $('#device_idd')
            .change(function () {
                var device_id = $('#device_idd').val();
                $('#dat-table-change').DataTable().destroy();
                $('.dat-table-change').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    createdRow: function (row, data, index) {
                        $(row).addClass('row1'),
                            $(row).attr('data-id', data.id)
                    },
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
                        url: "{{ route('admin.viewproduct.devices.list') }}",
                        data: {
                            device_id: device_id,
                        },
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                        {data: 'id', name: 'id'},
                        {data: 'product', name: 'product'},
                        {data: 'color', name: 'color'},
                        {data: 'number', name: 'number'},
                        {data: 'startt', name: 'startt'},
                        {data: 'productiontime', name: 'productiontime'},
                        {data: 'status', name: 'status'},
                    ]
                });
            }).change();

        $('#bach_id')
            .change(function () {
                var device_id = $('#bach_id').val();
                if (device_id == 0) {
                    $('#ajax').modal('show');
                }

            }).change();

        $('#product_id')
            .change(function () {
                var product = $('#product_id').val();
                $.ajax({
                    type: "GET",
                    data: {
                        product: product,
                    },
                    url: "{{route('admin.viewproduct.check')}}",
                    success: function (res) {
                        if (res) {
                            $('#format_id').val(res.format_id);
                            if (res.insert_id == null) {
                                $('#insert_id').val(0);
                            } else {
                                $('#insert_id').val(res.insert_id);
                            }

                        } else {

                        }
                    }
                });
            }).change();

        $('#bach_iid')
            .change(function () {
                var device_id = $('#bach_iid').val();
                var number = $('#numbeerr').val();
                var produuct = $('#product_ids').val();
                var format = $('#format_iid').val();
                var insert = $('#insert_iid').val();
                var collor = $('#color_iid').val();
                if (number > 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('admin.viewproduct.select')}}?device_id=" + device_id + "&number=" + number
                            + "&product=" + produuct + "&formatt=" + format + "&insert=" + insert + "&color=" + collor,
                        success: function (res) {
                            if (res) {
                                if (number != null) {
                                    if (res.check_mas != null) {
                                        document.getElementById("warning_mavadd").style.display = "block";
                                        document.getElementById("warning_mavad111").style.display = "block";
                                        $('#warning_mavad1111').text('');
                                        $('#warning_mavad1111').text(res.check_mas);
                                    } else {
                                        document.getElementById("warning_mavadd").style.display = "none";
                                        document.getElementById("warning_mavad111").style.display = "none";

                                    }

                                    if (res.check_mas != null && res.check_mat != null) {
                                        document.getElementById("warning_mavadd").style.display = "block";
                                        document.getElementById("warning_mavad111").style.display = "block";
                                        document.getElementById("warning_mavad222").style.display = "block";
                                        $('#warning_mavad1111').text('');
                                        $('#warning_mavad2222').text('');
                                        $('#warning_mavad1111').text(res.check_mas);
                                        $('#warning_mavad2222').text(res.check_mat);
                                    } else {
                                        document.getElementById("warning_mavadd").style.display = "none";
                                        document.getElementById("warning_mavad111").style.display = "none";
                                        document.getElementById("warning_mavad222").style.display = "none";

                                    }

                                    if (res.check_mas != null && res.check_mat != null && res.check_mat1 != null) {
                                        document.getElementById("warning_mavadd").style.display = "block";
                                        document.getElementById("warning_mavad111").style.display = "block";
                                        document.getElementById("warning_mavad222").style.display = "block";
                                        document.getElementById("warning_mavad333").style.display = "block";
                                        $('#warning_mavad1111').text('');
                                        $('#warning_mavad2222').text('');
                                        $('#warning_mavad3333').text('');
                                        $('#warning_mavad1111').text(res.check_mas);
                                        $('#warning_mavad2222').text(res.check_mat);
                                        $('#warning_mavad3333').text(res.check_mat1);
                                        if (res.check_mat2 != null) {
                                            document.getElementById("warning_mavad444").style.display = "block";
                                            $('#warning_mavad4444').text('');
                                            $('#warning_mavad4444').text(res.check_mat2);
                                        } else {
                                            document.getElementById("warning_mavad444").style.display = "none";
                                        }
                                        if (res.check_mat3 != null) {
                                            document.getElementById("warning_mavad555").style.display = "block";
                                            $('#warning_mavad5555').text('');
                                            $('#warning_mavad5555').text(res.check_mat3);
                                        } else {
                                            document.getElementById("warning_mavad555").style.display = "none";
                                        }
                                        if (res.check_mat4 != null) {
                                            document.getElementById("warning_mavad666").style.display = "block";
                                            $('#warning_mavad6666').text('');
                                            $('#warning_mavad6666').text(res.check_mat4);
                                        } else {
                                            document.getElementById("warning_mavad666").style.display = "none";
                                        }
                                    } else {
                                        document.getElementById("warning_mavadd").style.display = "none";
                                        document.getElementById("warning_mavad111").style.display = "none";
                                        document.getElementById("warning_mavad222").style.display = "none";
                                        document.getElementById("warning_mavad333").style.display = "none";

                                    }


                                } else {
                                    document.getElementById("warning_mavadd").style.display = "none";
                                    document.getElementById("warning_mavad111").style.display = "none";
                                    document.getElementById("warning_mavad222").style.display = "none";
                                    document.getElementById("warning_mavad333").style.display = "none";
                                    document.getElementById("warning_mavad444").style.display = "none";
                                    document.getElementById("warning_mavad555").style.display = "none";
                                    document.getElementById("warning_mavad666").style.display = "none";
                                }


                            }
                        }
                    });
                } else {
                    document.getElementById("warning_mavadd").style.display = "none";

                }

            }).change();

        $('#bach_id')
            .change(function () {
                var device_id = $('#bach_id').val();
                var number = $('#number').val();
                var produuct = $('#product_id').val();
                var format = $('#format_id').val();
                var insert = $('#insert_id').val();
                var collor = $('#color_id').val();
                if (number > 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('admin.viewproduct.select')}}?device_id=" + device_id + "&number=" + number
                            + "&product=" + produuct + "&formatt=" + format + "&insert=" + insert + "&color=" + collor,
                        success: function (res) {
                            if (res) {
                                if (device_id != 0) {
                                    if (number != null) {
                                        if (res.check_mas != null) {
                                            document.getElementById("warning_mavad").style.display = "block";
                                            document.getElementById("warning_mavad11").style.display = "block";
                                            $('#warning_mavad1').text('');
                                            $('#warning_mavad1').text(res.check_mas);
                                        } else {
                                            document.getElementById("warning_mavad").style.display = "none";
                                            document.getElementById("warning_mavad11").style.display = "none";

                                        }

                                        if (res.check_mas != null && res.check_mat != null) {
                                            document.getElementById("warning_mavad").style.display = "block";
                                            document.getElementById("warning_mavad11").style.display = "block";
                                            document.getElementById("warning_mavad22").style.display = "block";
                                            $('#warning_mavad1').text('');
                                            $('#warning_mavad2').text('');
                                            $('#warning_mavad1').text(res.check_mas);
                                            $('#warning_mavad2').text(res.check_mat);
                                        } else {
                                            document.getElementById("warning_mavad").style.display = "none";
                                            document.getElementById("warning_mavad11").style.display = "none";
                                            document.getElementById("warning_mavad22").style.display = "none";

                                        }

                                        if (res.check_mas != null && res.check_mat != null && res.check_mat1 != null) {
                                            document.getElementById("warning_mavad").style.display = "block";
                                            document.getElementById("warning_mavad11").style.display = "block";
                                            document.getElementById("warning_mavad22").style.display = "block";
                                            document.getElementById("warning_mavad33").style.display = "block";
                                            $('#warning_mavad1').text('');
                                            $('#warning_mavad2').text('');
                                            $('#warning_mavad3').text('');
                                            $('#warning_mavad1').text(res.check_mas);
                                            $('#warning_mavad2').text(res.check_mat);
                                            $('#warning_mavad3').text(res.check_mat1);
                                            if (res.check_mat2 != null) {
                                                document.getElementById("warning_mavad44").style.display = "block";
                                                $('#warning_mavad4').text('');
                                                $('#warning_mavad4').text(res.check_mat2);
                                            } else {
                                                document.getElementById("warning_mavad44").style.display = "none";
                                            }
                                            if (res.check_mat3 != null) {
                                                document.getElementById("warning_mavad55").style.display = "block";
                                                $('#warning_mavad5').text('');
                                                $('#warning_mavad5').text(res.check_mat3);
                                            } else {
                                                document.getElementById("warning_mavad55").style.display = "none";
                                            }
                                            if (res.check_mat4 != null) {
                                                document.getElementById("warning_mavad66").style.display = "block";
                                                $('#warning_mavad6').text('');
                                                $('#warning_mavad6').text(res.check_mat4);
                                            } else {
                                                document.getElementById("warning_mavad66").style.display = "none";
                                            }
                                        } else {
                                            document.getElementById("warning_mavad").style.display = "none";
                                            document.getElementById("warning_mavad11").style.display = "none";
                                            document.getElementById("warning_mavad22").style.display = "none";
                                            document.getElementById("warning_mavad33").style.display = "none";

                                        }


                                    } else {
                                        document.getElementById("warning_mavad").style.display = "none";
                                        document.getElementById("warning_mavad11").style.display = "none";
                                        document.getElementById("warning_mavad22").style.display = "none";
                                        document.getElementById("warning_mavad33").style.display = "none";
                                        document.getElementById("warning_mavad44").style.display = "none";
                                        document.getElementById("warning_mavad55").style.display = "none";
                                        document.getElementById("warning_mavad66").style.display = "none";
                                    }

                                }
                            }
                        }
                    });
                } else {
                    document.getElementById("warning_mavad").style.display = "none";

                }

            }).change();

        $('#format_id')
            .change(function () {
                var device_id = $('#bach_id').val();
                var number = $('#number').val();
                var product = $('#product_id').val();
                var format = $('#format_id').val();
                var insert = $('#insert_id').val();
                if (number > 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('admin.viewproduct.select')}}?device_id=" + device_id + "&number=" + number
                            + "&product=" + product + "&formatt=" + format + "&insert=" + insert,
                        success: function (res) {
                            if (res) {
                                console.log(res);
                            }
                        }
                    });
                } else {
                    console.log('fsfs');
                }

            }).change();

        $('#insert_id')
            .change(function () {
                var device_id = $('#bach_id').val();
                var number = $('#number').val();
                var product = $('#product_id').val();
                var format = $('#format_id').val();
                var insert = $('#insert_id').val();
                if (number > 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('admin.viewproduct.select')}}?device_id=" + device_id + "&number=" + number
                            + "&product=" + product + "&formatt=" + format + "&insert=" + insert,
                        success: function (res) {
                            if (res) {
                                console.log(res);
                            }
                        }
                    });
                } else {
                    console.log('fsfs');
                }

            }).change();

        $('#insert_idd')
            .change(function () {
                var device_id = $('#bach_iid').val();
                var number = $('#numbeerr').val();
                var produuct = $('#product_ids').val();
                var format = $('#format_iid').val();
                var insert = $('#insert_iid').val();
                var collor = $('#color_iid').val();
                if (device_id != 0 && number != 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('admin.viewproduct.select')}}?device_id=" + device_id + "&number=" + number
                            + "&product=" + produuct + "&formatt=" + format + "&insert=" + insert + "&color=" + collor,
                        success: function (res) {
                            if (res) {
                                if (number != null) {
                                    if (res.check_mas != null) {
                                        document.getElementById("warning_mavadd").style.display = "block";
                                        document.getElementById("warning_mavad111").style.display = "block";
                                        $('#warning_mavad1111').text('');
                                        $('#warning_mavad1111').text(res.check_mas);
                                    } else {
                                        document.getElementById("warning_mavadd").style.display = "none";
                                        document.getElementById("warning_mavad111").style.display = "none";

                                    }

                                    if (res.check_mas != null && res.check_mat != null) {
                                        document.getElementById("warning_mavadd").style.display = "block";
                                        document.getElementById("warning_mavad111").style.display = "block";
                                        document.getElementById("warning_mavad222").style.display = "block";
                                        $('#warning_mavad1111').text('');
                                        $('#warning_mavad2222').text('');
                                        $('#warning_mavad1111').text(res.check_mas);
                                        $('#warning_mavad2222').text(res.check_mat);
                                    } else {
                                        document.getElementById("warning_mavadd").style.display = "none";
                                        document.getElementById("warning_mavad111").style.display = "none";
                                        document.getElementById("warning_mavad222").style.display = "none";

                                    }

                                    if (res.check_mas != null && res.check_mat != null && res.check_mat1 != null) {
                                        document.getElementById("warning_mavadd").style.display = "block";
                                        document.getElementById("warning_mavad111").style.display = "block";
                                        document.getElementById("warning_mavad222").style.display = "block";
                                        document.getElementById("warning_mavad333").style.display = "block";
                                        $('#warning_mavad1111').text('');
                                        $('#warning_mavad2222').text('');
                                        $('#warning_mavad3333').text('');
                                        $('#warning_mavad1111').text(res.check_mas);
                                        $('#warning_mavad2222').text(res.check_mat);
                                        $('#warning_mavad3333').text(res.check_mat1);
                                        if (res.check_mat2 != null) {
                                            document.getElementById("warning_mavad444").style.display = "block";
                                            $('#warning_mavad4444').text('');
                                            $('#warning_mavad4444').text(res.check_mat2);
                                        } else {
                                            document.getElementById("warning_mavad444").style.display = "none";
                                        }
                                        if (res.check_mat3 != null) {
                                            document.getElementById("warning_mavad555").style.display = "block";
                                            $('#warning_mavad5555').text('');
                                            $('#warning_mavad5555').text(res.check_mat3);
                                        } else {
                                            document.getElementById("warning_mavad555").style.display = "none";
                                        }
                                        if (res.check_mat4 != null) {
                                            document.getElementById("warning_mavad666").style.display = "block";
                                            $('#warning_mavad6666').text('');
                                            $('#warning_mavad6666').text(res.check_mat4);
                                        } else {
                                            document.getElementById("warning_mavad666").style.display = "none";
                                        }
                                    } else {
                                        document.getElementById("warning_mavadd").style.display = "none";
                                        document.getElementById("warning_mavad111").style.display = "none";
                                        document.getElementById("warning_mavad222").style.display = "none";
                                        document.getElementById("warning_mavad333").style.display = "none";

                                    }


                                } else {
                                    document.getElementById("warning_mavadd").style.display = "none";
                                    document.getElementById("warning_mavad111").style.display = "none";
                                    document.getElementById("warning_mavad222").style.display = "none";
                                    document.getElementById("warning_mavad333").style.display = "none";
                                    document.getElementById("warning_mavad444").style.display = "none";
                                    document.getElementById("warning_mavad555").style.display = "none";
                                    document.getElementById("warning_mavad666").style.display = "none";
                                }


                            }
                        }
                    });
                } else {
                    document.getElementById("warning_mavadd").style.display = "none";

                }

            }).change();

        $('#number')
            .keyup(function () {
                var device_id = $('#bach_id').val();
                var number = $('#number').val();
                var produuct = $('#product_id').val();
                var format = $('#format_id').val();
                var insert = $('#insert_id').val();
                var collor = $('#color_id').val();
                if (device_id != 0 && number != 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('admin.viewproduct.select')}}?device_id=" + device_id + "&number=" + number
                            + "&product=" + produuct + "&formatt=" + format + "&insert=" + insert + "&color=" + collor,
                        success: function (res) {
                            if (res) {
                                if (number != null) {
                                    if (res.check_mas != null) {
                                        document.getElementById("warning_mavad").style.display = "block";
                                        document.getElementById("warning_mavad11").style.display = "block";
                                        $('#warning_mavad1').text('');
                                        $('#warning_mavad1').text(res.check_mas);
                                    } else {
                                        document.getElementById("warning_mavad").style.display = "none";
                                        document.getElementById("warning_mavad11").style.display = "none";

                                    }

                                    if (res.check_mas != null && res.check_mat != null) {
                                        document.getElementById("warning_mavad").style.display = "block";
                                        document.getElementById("warning_mavad11").style.display = "block";
                                        document.getElementById("warning_mavad22").style.display = "block";
                                        $('#warning_mavad1').text('');
                                        $('#warning_mavad2').text('');
                                        $('#warning_mavad1').text(res.check_mas);
                                        $('#warning_mavad2').text(res.check_mat);
                                    } else {
                                        document.getElementById("warning_mavad").style.display = "none";
                                        document.getElementById("warning_mavad11").style.display = "none";
                                        document.getElementById("warning_mavad22").style.display = "none";

                                    }

                                    if (res.check_mas != null && res.check_mat != null && res.check_mat1 != null) {
                                        document.getElementById("warning_mavad").style.display = "block";
                                        document.getElementById("warning_mavad11").style.display = "block";
                                        document.getElementById("warning_mavad22").style.display = "block";
                                        document.getElementById("warning_mavad33").style.display = "block";
                                        $('#warning_mavad1').text('');
                                        $('#warning_mavad2').text('');
                                        $('#warning_mavad3').text('');
                                        $('#warning_mavad1').text(res.check_mas);
                                        $('#warning_mavad2').text(res.check_mat);
                                        $('#warning_mavad3').text(res.check_mat1);
                                        if (res.check_mat2 != null) {
                                            document.getElementById("warning_mavad44").style.display = "block";
                                            $('#warning_mavad4').text('');
                                            $('#warning_mavad4').text(res.check_mat2);
                                        } else {
                                            document.getElementById("warning_mavad44").style.display = "none";
                                        }
                                        if (res.check_mat3 != null) {
                                            document.getElementById("warning_mavad55").style.display = "block";
                                            $('#warning_mavad5').text('');
                                            $('#warning_mavad5').text(res.check_mat3);
                                        } else {
                                            document.getElementById("warning_mavad55").style.display = "none";
                                        }
                                        if (res.check_mat4 != null) {
                                            document.getElementById("warning_mavad66").style.display = "block";
                                            $('#warning_mavad6').text('');
                                            $('#warning_mavad6').text(res.check_mat4);
                                        } else {
                                            document.getElementById("warning_mavad66").style.display = "none";
                                        }
                                    } else {
                                        document.getElementById("warning_mavad").style.display = "none";
                                        document.getElementById("warning_mavad11").style.display = "none";
                                        document.getElementById("warning_mavad22").style.display = "none";
                                        document.getElementById("warning_mavad33").style.display = "none";

                                    }


                                } else {
                                    document.getElementById("warning_mavad").style.display = "none";
                                    document.getElementById("warning_mavad11").style.display = "none";
                                    document.getElementById("warning_mavad22").style.display = "none";
                                    document.getElementById("warning_mavad33").style.display = "none";
                                    document.getElementById("warning_mavad44").style.display = "none";
                                    document.getElementById("warning_mavad55").style.display = "none";
                                    document.getElementById("warning_mavad66").style.display = "none";
                                }


                            }
                        }
                    });
                } else {
                    document.getElementById("warning_mavad").style.display = "none";

                }

            }).keyup();

        $('#numbeerr')
            .keyup(function () {
                var device_id = $('#bach_iid').val();
                var number = $('#numbeerr').val();
                var produuct = $('#product_ids').val();
                var format = $('#format_iid').val();
                var insert = $('#insert_iid').val();
                var collor = $('#color_iidd').val();
                if (device_id != 0 && number != 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('admin.viewproduct.select')}}?device_id=" + device_id + "&number=" + number
                            + "&product=" + produuct + "&formatt=" + format + "&insert=" + insert + "&color=" + collor,
                        success: function (res) {
                            if (res) {
                                if (number != null) {
                                    if (res.check_mas != null) {
                                        document.getElementById("warning_mavadd").style.display = "block";
                                        document.getElementById("warning_mavad111").style.display = "block";
                                        $('#warning_mavad1111').text('');
                                        $('#warning_mavad1111').text(res.check_mas);
                                    } else {
                                        document.getElementById("warning_mavadd").style.display = "none";
                                        document.getElementById("warning_mavad111").style.display = "none";

                                    }

                                    if (res.check_mas != null && res.check_mat != null) {
                                        document.getElementById("warning_mavadd").style.display = "block";
                                        document.getElementById("warning_mavad111").style.display = "block";
                                        document.getElementById("warning_mavad222").style.display = "block";
                                        $('#warning_mavad1111').text('');
                                        $('#warning_mavad2222').text('');
                                        $('#warning_mavad1111').text(res.check_mas);
                                        $('#warning_mavad2222').text(res.check_mat);
                                    } else {
                                        document.getElementById("warning_mavadd").style.display = "none";
                                        document.getElementById("warning_mavad111").style.display = "none";
                                        document.getElementById("warning_mavad222").style.display = "none";

                                    }

                                    if (res.check_mas != null && res.check_mat != null && res.check_mat1 != null) {
                                        document.getElementById("warning_mavadd").style.display = "block";
                                        document.getElementById("warning_mavad111").style.display = "block";
                                        document.getElementById("warning_mavad222").style.display = "block";
                                        document.getElementById("warning_mavad333").style.display = "block";
                                        $('#warning_mavad1111').text('');
                                        $('#warning_mavad2222').text('');
                                        $('#warning_mavad3333').text('');
                                        $('#warning_mavad1111').text(res.check_mas);
                                        $('#warning_mavad2222').text(res.check_mat);
                                        $('#warning_mavad3333').text(res.check_mat1);
                                        if (res.check_mat2 != null) {
                                            document.getElementById("warning_mavad444").style.display = "block";
                                            $('#warning_mavad4444').text('');
                                            $('#warning_mavad4444').text(res.check_mat2);
                                        } else {
                                            document.getElementById("warning_mavad444").style.display = "none";
                                        }
                                        if (res.check_mat3 != null) {
                                            document.getElementById("warning_mavad555").style.display = "block";
                                            $('#warning_mavad5555').text('');
                                            $('#warning_mavad5555').text(res.check_mat3);
                                        } else {
                                            document.getElementById("warning_mavad555").style.display = "none";
                                        }
                                        if (res.check_mat4 != null) {
                                            document.getElementById("warning_mavad666").style.display = "block";
                                            $('#warning_mavad6666').text('');
                                            $('#warning_mavad6666').text(res.check_mat4);
                                        } else {
                                            document.getElementById("warning_mavad666").style.display = "none";
                                        }
                                    } else {
                                        document.getElementById("warning_mavadd").style.display = "none";
                                        document.getElementById("warning_mavad111").style.display = "none";
                                        document.getElementById("warning_mavad222").style.display = "none";
                                        document.getElementById("warning_mavad333").style.display = "none";

                                    }


                                } else {
                                    document.getElementById("warning_mavadd").style.display = "none";
                                    document.getElementById("warning_mavad111").style.display = "none";
                                    document.getElementById("warning_mavad222").style.display = "none";
                                    document.getElementById("warning_mavad333").style.display = "none";
                                    document.getElementById("warning_mavad444").style.display = "none";
                                    document.getElementById("warning_mavad555").style.display = "none";
                                    document.getElementById("warning_mavad666").style.display = "none";
                                }


                            }
                        }
                    });
                } else {
                    document.getElementById("warning_mavadd").style.display = "none";

                }

            }).keyup();

        $('#device_idds')
            .change(function () {
                var device_id = $('#device_idds').val();
                $('#dat-table-d-e').DataTable().destroy();
                $('.dat-table-d-e').DataTable({
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
                        url: "{{ route('admin.viewproduct.devices.list') }}",
                        data: {
                            device_id: device_id,
                        },
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                        {data: 'id', name: 'id'},
                        {data: 'product', name: 'product'},
                        {data: 'color', name: 'color'},
                        {data: 'number', name: 'number'},
                        {data: 'startt', name: 'startt'},
                        {data: 'productiontime', name: 'productiontime'},
                        {data: 'status', name: 'status'},
                    ]
                });
            }).change();

        $('#save_new_product').click(function (e) {
            e.preventDefault();
            $('#save_new_product').text('در حال ثبت اطلاعات...');
            $('#save_new_product').prop("disabled", true);
            $.ajax({
                data: $('#Form_new_product').serialize(),
                url: "{{ route('admin.viewproduct.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#ajax_new_product').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#save_new_product').text('ثبت');
                        $('#save_new_product').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#Form_new_product').trigger("reset");
                        $('#ajax_new_product').modal('hide');
                        table.draw();
                        $('#device_data-table1').DataTable().draw();
                        $('#device_data-table2').DataTable().draw();
                        Swal.fire({
                            title: 'موفق!',
                            text: 'مشخصات برنامه جدید با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#save_new_product').text('ثبت');
                        $('#save_new_product').prop("disabled", false);

                    }
                }
            });
        });

        $('#edit_new_product').click(function (e) {
            e.preventDefault();
            $('#edit_new_product').text('در حال ثبت اطلاعات...');
            $('#edit_new_product').prop("disabled", true);
            $.ajax({
                data: $('#Form_edit_product').serialize(),
                url: "{{ route('admin.viewproduct.store.edit') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#product_change').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#edit_new_product').text('ثبت');
                        $('#edit_new_product').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#Form_edit_product').trigger("reset");
                        $('#product_change').modal('hide');
                        $('#ajax_device').modal('hide');
                        table.draw();
                        Swal.fire({
                            title: 'موفق!',
                            text: 'مشخصات برنامه به دستگاه جدید انتقال پیدا کرد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#edit_new_product').text('ثبت');
                        $('#edit_new_product').prop("disabled", false);
                    }
                }
            });
        });

        $('body').on('click', '.new_device', function () {
            var id = $(this).data("id");
            $.ajax({
                type: "GET",
                data: {
                    id: id,
                },
                url: "{{route('admin.viewproduct.device')}}",
                success: function (res) {
                    $('#ajax_device').modal('show');
                    $('#caption_device').text("دستگاه" + " " + res.name);
                    $('#data-table-device').DataTable().
                    destroy();
                    var device1 = $('.data-table-device').DataTable({
                        processing: true,
                        serverSide: true,
                        searching: false,
                        rowreorder: true,
                        retrieve: true,
                        aaSorting: [],
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
                            url: "{{ route('admin.viewproduct.device.list') }}",
                            data: {
                                device_id: id,
                            },
                        },
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                            {data: 'id', name: 'id'},
                            {data: 'product', name: 'product'},
                            {data: 'color', name: 'color'},
                            {data: 'number', name: 'number'},
                            {data: 'startt', name: 'startt'},
                            {data: 'productiontime', name: 'productiontime'},
                            {data: 'qc', name: 'qc'},
                            {data: 'status', name: 'status'},
                            {data: 'actions', name: 'actions', "className": "dt-center"},
                        ],
                        rowReorder: {
                            selector: 'tr td:not(:first-of-type,:last-of-type)',
                            dataSrc: 'order'
                        },
                    });

                    device1.on('row-reorder', function (e, details) {
                        if (details.length) {
                            var rows = [];
                            details.forEach(element => {
                                rows.push({
                                    id: device1.row(element.node).data().id,
                                    position: element.newData
                                });
                            });

                            $.ajax({
                                method: 'POST',
                                url: "{{ route('admin.viewproduct.sort') }}",
                                data: {rows, "_token": "{{ csrf_token() }}"}
                            }).done(function () {
                                device1.draw();
                                $('#device_data-table1').DataTable().draw();
                                $('#device_data-table2').DataTable().draw();
                            });
                        }
                    });


                }
            });
        });

        $('body').on('click', '.product_edit', function () {
            var device_iid = $('#device_idds').val();

            var id = $(this).data("id");
            $('#i').val(id);
            var prod = $(this).data("prod-id");
            $('#pp').val(id);
            $('#cc').val(prod);
            $.ajax({
                type: "GET",
                data: {
                    id: id,
                },
                url: "{{route('admin.viewproduct.device.edit')}}",
                success: function (res) {
                    $('#ajax_product_edit').modal('show');
                    $('#product_ids').val(res.product_id);
                    $('#color_idd').val(res.color_id);
                    $('#device_idds').val(res.device_id);
                    $('#format_iid').val(res.format_id);
                    $('#insert_iid').val(res.insert_id);
                    $('#bach_iid').val(res.bach_id);
                    $('#numbeerr').val(res.number);
                    $('#format_timee').val(res.format_time);
                    $('#insert_timee').val(res.insert_time);
                    $('#color_timee').val(res.color_time);
                    $('#stimee').val(res.stime);


                }
            });
            $('#dat-table-d-e').DataTable().destroy();
            $('.dat-table-d-e').DataTable({
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
                    url: "{{ route('admin.viewproduct.devices.list') }}",
                    data: {
                        device_id: device_iid,
                    },
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'id', name: 'id'},
                    {data: 'product', name: 'product'},
                    {data: 'color', name: 'color'},
                    {data: 'number', name: 'number'},
                    {data: 'startt', name: 'startt'},
                    {data: 'productiontime', name: 'productiontime'},
                    {data: 'status', name: 'status'},
                ]
            });
        });

        $('body').on('click', '.play_product', function () {

            $('#ajax_device').modal('hide');
            var id = $(this).data("id");
            Swal.fire({
                title: 'شرع به تولید برنامه!',
                text: "آیا از شروع به تولید این برنامه اطمینان دارید؟",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'شروع به تولید',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.viewproduct.start')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#data-table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'موفق',
                                text: 'برنامه مورد نظر با موفقیت شروع به تولید شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });

        $('body').on('click', '.date_product', function () {
            var id = $(this).data("id");

            $.ajax({
                type: "GET",
                data: {
                    id: id,
                },
                url: "{{route('admin.viewproduct.check.date')}}",
                success: function (res) {
                    $('#id_date').val(id);
                    if (res) {
                        $('#ajax_date').modal('show');
                        $('#created').val(res.date_start);
                        $('#time_date').val(res.time_start);
                    } else {
                        $('#ajax_date').modal('show');
                    }
                }
            });


        });

        $('#saveBtn_date').click(function (e) {
            e.preventDefault();
            $('#saveBtn_date').text('در حال ثبت اطلاعات...');
            $('#saveBtn_date').prop("disabled", true);
            $.ajax({
                data: $('#Form_date').serialize(),
                url: "{{ route('admin.viewproduct.date') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#ajax_device').modal('hide');
                        $('#ajax_date').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveBtn_date').text('ثبت');
                        $('#saveBtn_date').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#Form_date').trigger("reset");
                        $('#ajax_date').modal('hide');

                        $('#data-table-device').DataTable().draw();
                        $('#device_data-table1').DataTable().draw();
                        $('#device_data-table2').DataTable().draw();
                        $('#saveBtn_date').text('ثبت');
                        $('#saveBtn_date').prop("disabled", false);
                    }
                }
            });
        });

        $('#saveBtnn').click(function (e) {
            e.preventDefault();
            $('#saveBtnn').text('در حال ثبت اطلاعات...');
            $('#saveBtnn').prop("disabled", true);
            $.ajax({
                data: $('#productFormmmm').serialize(),
                url: "{{ route('admin.information.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#ajax').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveBtnn').text('ثبت');
                        $('#saveBtnn').prop("disabled", false);
                    }

                    if (data.success) {

                        $('#productFormmmm').trigger("reset");
                        $('#ajax').modal('hide');

                        $("#bach_id").empty();
                        $.each(data.informations, function (key, value) {
                            $("#bach_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $("#bach_id").append('<option value="0">ثبت مواد تولیدی جدید</option>');

                        $('#saveBtnn').text('ثبت');
                        $('#saveBtnn').prop("disabled", false);

                    }
                }
            });
        });

        $('body').on('click', '.view_Product', function () {
            var id = $(this).data("id");
            var prod = $(this).data("prod-id");
            var product = $(this).data("product-id");
            $('#product_view').modal('show');
            $('#dat-table-view').DataTable().destroy();
            $('.dat-table-view').DataTable({
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
                    url: "{{ route('admin.viewproduct.devices.list.view') }}",
                    data: {
                        product: product,
                        color_id: prod,
                    },
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'id', name: 'id'},
                    {data: 'product', name: 'product'},
                    {data: 'color', name: 'color'},
                    {data: 'number', name: 'number'},
                    {data: 'startt', name: 'startt'},
                    {data: 'productiontime', name: 'productiontime'},
                    {data: 'status', name: 'status'},
                ]
            });

        });

        @foreach($devices as $device)

        $('.device_data-table{{$device->id}}').DataTable({
            processing: true,
            serverSide: true,
            rowreorder: true,
            retrieve: true,
            aaSorting: [],
            "bInfo": false,
            "paging": false,
            "bPaginate": false,
            "columnDefs": [
                {"orderable": false, "targets": 0},
            ],

            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css('background-color', '#e6e6e6');

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
                url: "{{ route('admin.viewproduct.list.devices') }}",
                data: {
                    device_id: '{{$device->id}}',
                },
            },
            columns: [
                {data: 'id', name: 'id', "className": "dt-center"},
                {data: 'product_color', name: 'product_color', "className": "dt-center"},
                {data: 'format', name: 'format', "className": "dt-center"},
                {data: 'insert', name: 'insert', "className": "dt-center"},
                {data: 'number', name: 'number', "className": "dt-center"},
                {data: 'total', name: 'total', "className": "dt-center"},
                {data: 'startt', name: 'startt', "className": "dt-center"},
                {data: 'productiontime', name: 'productiontime', "className": "dt-center"},
                {data: 'status', name: 'status', "className": "dt-center"},
                {data: 'mstatus', name: 'mstatus', "className": "dt-center"},
                {data: 'tstatus', name: 'tstatus', "className": "dt-center"},
                {data: 'actions', name: 'actions', "className": "dt-center"},
            ],
            rowReorder: {
                selector: 'tr td:not(:first-of-type,:last-of-type)',
                dataSrc: 'order'
            },
        });
        var d = $('.device_data-table1').DataTable();
        d.on('row-reorder', function (e, details) {
            if (details.length) {
                var rows = [];
                d.forEach(element => {
                    rows.push({
                        id: d.row(element.node).data().id,
                        position: element.newData
                    });
                });

                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.viewproduct.sortt') }}",
                    data: {rows, "_token": "{{ csrf_token() }}"}
                }).done(function () {
                    $('#device_data-table1').DataTable().draw();
                    $('#device_data-table2').DataTable().draw();
                });
            }
        });


        @endforeach

        $('#save_edit_product').click(function (e) {
            e.preventDefault();
            $('#save_edit_product').text('در حال ثبت اطلاعات...');
            $('#save_edit_product').prop("disabled", true);
            $.ajax({
                data: $('#Form_ediit_product').serialize(),
                url: "{{ route('admin.viewproduct.store.edit') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.errors) {
                        $('#ajax_product_edit').modal('hide');
                        $('#ajax_device').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#save_edit_product').text('ثبت');
                        $('#save_edit_product').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#Form_ediit_product').trigger("reset");
                        $('#ajax_product_edit').modal('hide');
                        $('#ajax_device').modal('hide');
                        table.draw();
                        $('#device_data-table1').DataTable().draw();
                        $('#device_data-table2').DataTable().draw();
                        Swal.fire({
                            title: 'موفق!',
                            text: 'مشخصات برنامه با موفقیت در سیستم ویرایش شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        });
                        $('#save_edit_product').text('ثبت');
                        $('#save_edit_product').prop("disabled", false);

                    }
                }
            });
        });

    });

    $('body').on('click', '.product_delete', function () {
        var id = $(this).data("id");
        $('#ajax_device').modal('hide');
        Swal.fire({
            title: 'حذف سفارش تولید؟',
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
                    url: "{{route('admin.productionorder.delete')}}" + '/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function (data) {
                        $('#data-table').DataTable().ajax.reload();
                        $('#data-table').DataTable().draw();
                        $('#device_data-table1').DataTable().draw();
                        $('#device_data-table2').DataTable().draw();
                        Swal.fire({
                            title: 'موفق!',
                            text: 'مشخصات سفارش تولید با موفقیت از سیستم حذف شد',
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        })
                    }
                });
            }
        })
    });

</script>

<script language="javascript">

    added_inputs2_array = [];
    if (added_inputs2_array.length >= 1)
        for (var a in added_inputs2_array)
            added_inputs_array_table2(added_inputs2_array[a], a);

    function added_inputs_array_table2(data, a) {

        var myNode = document.createElement('div');
        myNode.id = 'namee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'nameee" + a + "\'  name=\"nameee[]\"\n" +
            "class=\"form-control\"/>" +
            "<option>انتخاب کنید...</option>" +
            @foreach($polymerics as $polymeric)
                "<option value='{{$polymeric->id}}'>{{$polymeric->type}}-{{$polymeric->grid}}</option>" +
            @endforeach
                "</select>" +
            "</div></div></div>";
        document.getElementById('namee').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'darsad' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'darsaddd" + a + "\'  name=\"darsaddd[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('darsad').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'actiont' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<button onclick='deleteService2(" + a + ", event)' class=\"form-control btn btn-danger\"><i class=\"fa fa-removee\"></button></div>";
        document.getElementById('actiont').appendChild(myNode);


    }

    function deleteService2(id, event) {
        event.preventDefault();
        $('#namee' + id).remove();
        $('#darsad' + id).remove();

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

<script>
    $('#barnam').addClass('active');

    kamaDatepicker('created',
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

    jQuery(function ($) {
        $('#time_date').mask("99:99");
    });

</script>
