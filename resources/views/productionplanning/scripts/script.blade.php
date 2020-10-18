<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var deviceproductfalse1 = $('.listfalsedevice1').DataTable({
            processing: true,
            serverSide: true,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.pPlanning.deviceproductfalse1') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ordercode', name: 'ordercode'},
                {data: 'product_id', name: 'product_id'},
                {data: 'color_id', name: 'color_id'},
                {data: 'number', name: 'number'},
                {data: 'created_at', name: 'created_at'},


            ]
        });

        {{--var devicefalse1 = $('.devicefalse1').DataTable({--}}
        {{--    processing: true,--}}
        {{--    serverSide: true,--}}
        {{--    rowreorder: true,--}}
        {{--    retrieve: true,--}}
        {{--    aaSorting: [],--}}
        {{--    "searching": false,--}}
        {{--    "lengthChange": false,--}}
        {{--    "info": false,--}}
        {{--    "bPaginate": false,--}}
        {{--    "bSort": false,--}}
        {{--    "language": {--}}
        {{--        "search": "جستجو:",--}}
        {{--        "lengthMenu": "نمایش _MENU_",--}}
        {{--        "zeroRecords": "موردی یافت نشد!",--}}
        {{--        "info": "نمایش _PAGE_ از _PAGES_",--}}
        {{--        "infoEmpty": "موردی یافت نشد",--}}
        {{--        "infoFiltered": "(جستجو از _MAX_ مورد)",--}}
        {{--        "processing": "در حال پردازش اطلاعات"--}}
        {{--    },--}}
        {{--    ajax: "{{ route('admin.device1.list') }}",--}}
        {{--    columns: [--}}
        {{--        {data: 'DT_RowIndex', name: 'DT_RowIndex'},--}}
        {{--        {data: 'product', name: 'product'},--}}
        {{--        {data: 'color', name: 'color'},--}}
        {{--        {data: 'number', name: 'number'},--}}
        {{--        {data: 'format', name: 'format'},--}}
        {{--        {data: 'insert', name: 'insert'},--}}
        {{--        {data: 'cycletime', name: 'cycletime'},--}}
        {{--        {data: 'size', name: 'size'},--}}
        {{--        {data: 'productiontime', name: 'productiontime'},--}}
        {{--        {data: 'productionqueue', name: 'productionqueue'},--}}
        {{--        {data: 'numberproduced', name: 'numberproduced'},--}}
        {{--        {data: 'Productionbalance', name: 'Productionbalance'},--}}
        {{--        {data: 'remainingtime', name: 'remainingtime'},--}}
        {{--        {data: 'deleteINdevice1', name: 'deleteINdevice1', orderable: false, searchable: false},--}}
        {{--    ]--}}
        {{--});--}}

        var deviceproduct1 = $('.listdevice1').DataTable({
            processing: true,
            serverSide: true,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.pPlanning.deviceproduct1') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ordercode', name: 'ordercode'},
                {data: 'product_id', name: 'product_id'},
                {data: 'color_id', name: 'color_id'},
                {data: 'number', name: 'number'},
                {data: 'created_at', name: 'created_at'},
                {data: 'addTOdevice1', name: 'addTOdevice1', orderable: false, searchable: false},


            ]
        });

        var device1 = $('.device1').DataTable({
            processing: true,
            serverSide: true,
            rowreorder: true,
            retrieve: true,
            aaSorting: [],
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "bSort": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.device1.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'format', name: 'format'},
                {data: 'insert', name: 'insert'},
                {data: 'cycletime', name: 'cycletime'},
                {data: 'size', name: 'size'},
                {data: 'state', name: 'state'},
                {data: 'productiontime', name: 'productiontime'},
                {data: 'productionqueue', name: 'productionqueue'},
                {data: 'numberproduced', name: 'numberproduced'},
                {data: 'Productionbalance', name: 'Productionbalance'},
                {data: 'remainingtime', name: 'remainingtime'},
                {data: 'deleteINdevice1', name: 'deleteINdevice1', orderable: false, searchable: false},
            ],
            rowReorder: {
                selector: 'tr td:not(:first-of-type,:last-of-type)',
                dataSrc: 'Order'
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
                    url: "{{ route('admin.device1.list.SortDevice1') }}",
                    data: {rows, "_token": "{{ csrf_token() }}"}
                }).done(function () {
                    device1.draw();
                });
            }
        });
        $('#device1').click(function () {
            $('#showDevice1').modal('show');
        });
        $('#falsedevice1').click(function () {
            $('#showFalseDevice1').modal('show');
        });
        $('body').on('click', '.addTOdevice1', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.pPlanning.AddDevice1') }}" + '/' + product_id, function (data) {
                if (data.success) {
                    deviceproduct1.draw();
                    deviceproduct2.draw();
                    deviceproduct3.draw();
                    deviceproduct4.draw();
                    deviceproduct5.draw();
                    deviceproductfalse3.draw();
                    deviceproductfalse2.draw();
                    deviceproductfalse1.draw();
                    device1.draw();
                } else {
                    $('#showDevice1').modal('hide');
                    Swal.fire({
                        title: 'خطا!',
                        text: 'خطایی در ارتباط با سیستم رخ داده است',
                        icon: 'error',
                        confirmButtonText: 'تایید'
                    });
                }

            })
        });
        $('body').on('click', '.deleteINdevice1', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.pPlanning.DeleteDevice1') }}" + '/' + product_id, function (data) {
                if (data.success) {
                    device1.draw();
                    devicefalse1.draw();
                    deviceproductfalse3.draw();
                    deviceproductfalse2.draw();
                    deviceproductfalse1.draw();
                    deviceproduct1.draw();
                    deviceproduct2.draw();
                    deviceproduct3.draw();
                    deviceproduct4.draw();
                    deviceproduct5.draw();
                } else {
                    $('#showDevice1').modal('hide');
                    Swal.fire({
                        title: 'خطا!',
                        text: 'خطایی در ارتباط با سیستم رخ داده است',
                        icon: 'error',
                        confirmButtonText: 'تایید'
                    });
                }

            })
        });


        var deviceproductfalse2 = $('.listdevicefalse2').DataTable({
            processing: true,
            serverSide: true,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.pPlanning.deviceproductfalse2') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ordercode', name: 'ordercode'},
                {data: 'product_id', name: 'product_id'},
                {data: 'color_id', name: 'color_id'},
                {data: 'number', name: 'number'},
                {data: 'created_at', name: 'created_at'},
            ]
        });
        var devicefalse2 = $('.devicefalse2').DataTable({
            processing: true,
            serverSide: true,
            rowreorder: true,
            retrieve: true,
            aaSorting: [],
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "bSort": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.device2.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'format', name: 'format'},
                {data: 'insert', name: 'insert'},
                {data: 'cycletime', name: 'cycletime'},
                {data: 'size', name: 'size'},
                {data: 'productiontime', name: 'productiontime'},
                {data: 'productionqueue2', name: 'productionqueue2'},
                {data: 'numberproduced', name: 'numberproduced'},
                {data: 'Productionbalance', name: 'Productionbalance'},
                {data: 'remainingtime', name: 'remainingtime'},
                {data: 'deleteINdevice2', name: 'deleteINdevice2', orderable: false, searchable: false},
            ]
        });
        var deviceproduct2 = $('.listdevice2').DataTable({
            processing: true,
            serverSide: true,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.pPlanning.deviceproduct2') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ordercode', name: 'ordercode'},
                {data: 'product_id', name: 'product_id'},
                {data: 'color_id', name: 'color_id'},
                {data: 'number', name: 'number'},
                {data: 'created_at', name: 'created_at'},
                {data: 'addTOdevice2', name: 'addTOdevice2', orderable: false, searchable: false},


            ]
        });
        var device2 = $('.device2').DataTable({
            processing: true,
            serverSide: true,
            rowreorder: true,
            retrieve: true,
            aaSorting: [],
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "bSort": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.device2.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'format', name: 'format'},
                {data: 'insert', name: 'insert'},
                {data: 'cycletime', name: 'cycletime'},
                {data: 'size', name: 'size'},
                {data: 'productiontime', name: 'productiontime'},
                {data: 'productionqueue2', name: 'productionqueue2'},
                {data: 'numberproduced', name: 'numberproduced'},
                {data: 'Productionbalance', name: 'Productionbalance'},
                {data: 'remainingtime', name: 'remainingtime'},
                {data: 'deleteINdevice2', name: 'deleteINdevice2', orderable: false, searchable: false},
            ],
            rowReorder: {
                selector: 'tr td:not(:first-of-type,:last-of-type)',
                dataSrc: 'Order'
            },
        });
        device2.on('row-reorder', function (e, details) {
            if (details.length) {
                var rows = [];
                details.forEach(element => {
                    rows.push({
                        id: device2.row(element.node).data().id,
                        position: element.newData
                    });
                });

                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.device2.list.SortDevice2') }}",
                    data: {rows, "_token": "{{ csrf_token() }}"}
                }).done(function () {
                    device2.draw();
                });
            }
        });
        $('#device2').click(function () {
            $('#showDevice2').modal('show');
        });
        $('#falsedevice2').click(function () {
            $('#showFalseDevice2').modal('show');
        });
        $('body').on('click', '.addTOdevice2', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.pPlanning.AddDevice2') }}" + '/' + product_id, function (data) {
                if (data.success) {
                    deviceproduct2.draw();
                    deviceproduct3.draw();
                    deviceproduct1.draw();
                    deviceproduct4.draw();
                    deviceproduct5.draw();
                    deviceproductfalse3.draw();
                    deviceproductfalse2.draw();
                    deviceproductfalse1.draw();
                    device2.draw();
                } else {
                    $('#showDevice2').modal('hide');
                    Swal.fire({
                        title: 'خطا!',
                        text: 'خطایی در ارتباط با سیستم رخ داده است',
                        icon: 'error',
                        confirmButtonText: 'تایید'
                    });
                }

            })
        });
        $('body').on('click', '.deleteINdevice2', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.pPlanning.DeleteDevice2') }}" + '/' + product_id, function (data) {
                if (data.success) {
                    device2.draw();
                    devicefalse2.draw();
                    deviceproduct1.draw();
                    deviceproduct2.draw();
                    deviceproductfalse3.draw();
                    deviceproductfalse2.draw();
                    deviceproductfalse1.draw();
                    deviceproduct3.draw();
                    deviceproduct4.draw();
                    deviceproduct5.draw();
                } else {
                    $('#showDevice2').modal('hide');
                    Swal.fire({
                        title: 'خطا!',
                        text: 'خطایی در ارتباط با سیستم رخ داده است',
                        icon: 'error',
                        confirmButtonText: 'تایید'
                    });
                }


            })
        });


        var deviceproductfalse3 = $('.listdevicefalse3').DataTable({
            processing: true,
            serverSide: true,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.pPlanning.deviceproductfalse3') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ordercode', name: 'ordercode'},
                {data: 'product_id', name: 'product_id'},
                {data: 'color_id', name: 'color_id'},
                {data: 'number', name: 'number'},
                {data: 'created_at', name: 'created_at'},


            ]
        });
        var devicefalse3 = $('.devicefalse3').DataTable({
            processing: true,
            serverSide: true,
            rowreorder: true,
            retrieve: true,
            aaSorting: [],
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "bSort": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.device3.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'format', name: 'format'},
                {data: 'insert', name: 'insert'},
                {data: 'cycletime', name: 'cycletime'},
                {data: 'size', name: 'size'},
                {data: 'productiontime', name: 'productiontime'},
                {data: 'productionqueue3', name: 'productionqueue3'},
                {data: 'numberproduced', name: 'numberproduced'},
                {data: 'Productionbalance', name: 'Productionbalance'},
                {data: 'remainingtime', name: 'remainingtime'},
                {data: 'deleteINdevice3', name: 'deleteINdevice3', orderable: false, searchable: false},
            ]
        });
        var deviceproduct3 = $('.listdevice3').DataTable({
            processing: true,
            serverSide: true,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.pPlanning.deviceproduct3') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ordercode', name: 'ordercode'},
                {data: 'product_id', name: 'product_id'},
                {data: 'color_id', name: 'color_id'},
                {data: 'number', name: 'number'},
                {data: 'created_at', name: 'created_at'},
                {data: 'addTOdevice3', name: 'addTOdevice3', orderable: false, searchable: false},


            ]
        });
        var device3 = $('.device3').DataTable({
            processing: true,
            serverSide: true,
            rowreorder: true,
            retrieve: true,
            aaSorting: [],
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "bSort": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.device3.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'format', name: 'format'},
                {data: 'insert', name: 'insert'},
                {data: 'cycletime', name: 'cycletime'},
                {data: 'size', name: 'size'},
                {data: 'productiontime', name: 'productiontime'},
                {data: 'productionqueue3', name: 'productionqueue3'},
                {data: 'numberproduced', name: 'numberproduced'},
                {data: 'Productionbalance', name: 'Productionbalance'},
                {data: 'remainingtime', name: 'remainingtime'},
                {data: 'deleteINdevice3', name: 'deleteINdevice3', orderable: false, searchable: false},
            ],
            rowReorder: {
                selector: 'tr td:not(:first-of-type,:last-of-type)',
                dataSrc: 'Order'
            },
        });
        device3.on('row-reorder', function (e, details) {
            if (details.length) {
                var rows = [];
                details.forEach(element => {
                    rows.push({
                        id: device3.row(element.node).data().id,
                        position: element.newData
                    });
                });

                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.device3.list.SortDevice3') }}",
                    data: {rows, "_token": "{{ csrf_token() }}"}
                }).done(function () {
                    device3.draw();
                });
            }
        });
        $('#device3').click(function () {
            $('#showDevice3').modal('show');
        });
        $('#falsedevice3').click(function () {
            $('#showFalseDevice3').modal('show');
        });
        $('body').on('click', '.addTOdevice3', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.pPlanning.AddDevice3') }}" + '/' + product_id, function (data) {
                if (data.success) {
                    deviceproduct2.draw();
                    deviceproduct3.draw();
                    deviceproduct1.draw();
                    deviceproduct4.draw();
                    deviceproduct5.draw();
                    deviceproductfalse3.draw();
                    deviceproductfalse2.draw();
                    deviceproductfalse1.draw();
                    device3.draw();
                } else {
                    $('#showDevice3').modal('hide');
                    Swal.fire({
                        title: 'خطا!',
                        text: 'خطایی در ارتباط با سیستم رخ داده است',
                        icon: 'error',
                        confirmButtonText: 'تایید'
                    });
                }

            })
        });
        $('body').on('click', '.deleteINdevice3', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.pPlanning.DeleteDevice3') }}" + '/' + product_id, function (data) {
                if (data.success) {
                    device3.draw();
                    devicefalse3.draw();
                    deviceproduct1.draw();
                    deviceproductfalse3.draw();
                    deviceproductfalse2.draw();
                    deviceproductfalse1.draw();
                    deviceproduct2.draw();
                    deviceproduct3.draw();
                    deviceproduct4.draw();
                    deviceproduct5.draw();
                } else {
                    $('#showDevice3').modal('hide');
                    Swal.fire({
                        title: 'خطا!',
                        text: 'خطایی در ارتباط با سیستم رخ داده است',
                        icon: 'error',
                        confirmButtonText: 'تایید'
                    });
                }
            })
        });


        var deviceproduct4 = $('.listdevice4').DataTable({
            processing: true,
            serverSide: true,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.pPlanning.deviceproduct4') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ordercode', name: 'ordercode'},
                {data: 'product_id', name: 'product_id'},
                {data: 'color_id', name: 'color_id'},
                {data: 'number', name: 'number'},
                {data: 'created_at', name: 'created_at'},
                {data: 'addTOdevice4', name: 'addTOdevice4', orderable: false, searchable: false},


            ]
        });
        var device4 = $('.device4').DataTable({
            processing: true,
            serverSide: true,
            rowreorder: true,
            retrieve: true,
            aaSorting: [],
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "bSort": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.device4.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'format', name: 'format'},
                {data: 'insert', name: 'insert'},
                {data: 'cycletime', name: 'cycletime'},
                {data: 'size', name: 'size'},
                {data: 'productiontime', name: 'productiontime'},
                {data: 'productionqueue4', name: 'productionqueue4'},
                {data: 'numberproduced', name: 'numberproduced'},
                {data: 'Productionbalance', name: 'Productionbalance'},
                {data: 'remainingtime', name: 'remainingtime'},
                {data: 'deleteINdevice4', name: 'deleteINdevice4', orderable: false, searchable: false},
            ],
            rowReorder: {
                selector: 'tr td:not(:first-of-type,:last-of-type)',
                dataSrc: 'Order'
            },
        });
        device4.on('row-reorder', function (e, details) {
            if (details.length) {
                var rows = [];
                details.forEach(element => {
                    rows.push({
                        id: device4.row(element.node).data().id,
                        position: element.newData
                    });
                });

                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.device4.list.SortDevice4') }}",
                    data: {rows, "_token": "{{ csrf_token() }}"}
                }).done(function () {
                    device4.draw();
                });
            }
        });
        $('#device4').click(function () {
            $('#showDevice4').modal('show');
        });
        $('body').on('click', '.addTOdevice4', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.pPlanning.AddDevice4') }}" + '/' + product_id, function (data) {
                deviceproduct2.draw();
                deviceproduct3.draw();
                deviceproduct4.draw();
                deviceproduct1.draw();
                deviceproduct5.draw();

                device4.draw();
            })
        });
        $('body').on('click', '.deleteINdevice4', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.pPlanning.DeleteDevice4') }}" + '/' + product_id, function (data) {
                device4.draw();
                deviceproduct1.draw();
                deviceproduct2.draw();
                deviceproduct3.draw();
                deviceproduct4.draw();
                deviceproduct5.draw();

            })
        });


        var deviceproduct5 = $('.listdevice5').DataTable({
            processing: true,
            serverSide: true,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.pPlanning.deviceproduct5') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ordercode', name: 'ordercode'},
                {data: 'product_id', name: 'product_id'},
                {data: 'color_id', name: 'color_id'},
                {data: 'number', name: 'number'},
                {data: 'created_at', name: 'created_at'},
                {data: 'addTOdevice5', name: 'addTOdevice5', orderable: false, searchable: false},


            ]
        });
        var device5 = $('.device5').DataTable({
            processing: true,
            serverSide: true,
            rowreorder: true,
            retrieve: true,
            aaSorting: [],
            "searching": false,
            "lengthChange": false,
            "info": false,
            "bPaginate": false,
            "bSort": false,
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.device5.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'format', name: 'format'},
                {data: 'insert', name: 'insert'},
                {data: 'cycletime', name: 'cycletime'},
                {data: 'size', name: 'size'},
                {data: 'productiontime', name: 'productiontime'},
                {data: 'productionqueue5', name: 'productionqueue5'},
                {data: 'numberproduced', name: 'numberproduced'},
                {data: 'Productionbalance', name: 'Productionbalance'},
                {data: 'remainingtime', name: 'remainingtime'},
                {data: 'deleteINdevice5', name: 'deleteINdevice5', orderable: false, searchable: false},
            ],
            rowReorder: {
                selector: 'tr td:not(:first-of-type,:last-of-type)',
                dataSrc: 'Order'
            },
        });
        device5.on('row-reorder', function (e, details) {
            if (details.length) {
                var rows = [];
                details.forEach(element => {
                    rows.push({
                        id: device5.row(element.node).data().id,
                        position: element.newData
                    });
                });

                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.device5.list.SortDevice5') }}",
                    data: {rows, "_token": "{{ csrf_token() }}"}
                }).done(function () {
                    device5.draw();
                });
            }
        });
        $('#device5').click(function () {
            $('#showDevice5').modal('show');
        });
        $('body').on('click', '.addTOdevice5', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.pPlanning.AddDevice5') }}" + '/' + product_id, function (data) {
                deviceproduct2.draw();
                deviceproduct3.draw();
                deviceproduct4.draw();
                deviceproduct5.draw();
                deviceproduct1.draw();
                device5.draw();
            })
        });
        $('body').on('click', '.deleteINdevice5', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('admin.pPlanning.DeleteDevice5') }}" + '/' + product_id, function (data) {
                device5.draw();
                deviceproduct1.draw();
                deviceproduct2.draw();
                deviceproduct3.draw();
                deviceproduct4.draw();
                deviceproduct5.draw();

            })
        });


    });
    $('#manufacturing').addClass('active');

</script>
