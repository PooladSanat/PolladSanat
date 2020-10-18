<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/jquery.maskedinput.js')}}" type="text/javascript"></script>
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
    var detail_factor = null;
    <?php
    $v = verta();
    $months = $v->month;
    if ($months < 10) {
        $year = $v->year;
        $month = $months;
        $m = 0;
    } else {
        $year = $v->year;
        $month = $months;
    }
    ?>
    $('#indate').val({{$year}}+'/' + '{{$m}}'+{{$month}}+
    '/' + '01'
    )
    ;
    $('#todate').val({{$year}}+'/' + '{{$m}}'+{{$month}}+
    '/' + '31'
    )
    ;


    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    var ind = {{$year}}+'/' + '{{$m}}'+{{$month}}+
    '/' + '01';
    var tod = {{$year}}+'/' + '{{$m}}'+{{$month}}+
    '/' + '31';

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        load_data();

        function load_data(indate = ind, todate = tod) {
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "ordering": false,
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                    var api = this.api(), aData;
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    var wedTotal = api
                        .column(1)
                        .data()
                        .reduce(function (a, b) {
                            return formatNumber(intVal(a) + intVal(b));
                        }, 0);

                    var thuTotal = api
                        .column(2)
                        .data()
                        .reduce(function (a, b) {
                            return formatNumber(intVal(a) + intVal(b));
                        }, 0);

                    var friTotal = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return formatNumber(intVal(a) + intVal(b));
                        }, 0);

                    var friTotaal = api
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                            return formatNumber(intVal(a) + intVal(b));
                        }, 0);
                    var friTotaasl = api
                        .column(5)
                        .data()
                        .reduce(function (a, b) {
                            return formatNumber(intVal(a) + intVal(b));
                        }, 0);

                    $(api.column(0).footer()).html('جمع کل');
                    $(api.column(1).footer()).html(wedTotal);
                    $(api.column(2).footer()).html(thuTotal);
                    $(api.column(3).footer()).html(friTotal);
                    $(api.column(4).footer()).html(friTotaal);
                    $(api.column(5).footer()).html(friTotaasl);

                    if (aData.total == 0 && aData.sum == 0 && aData.sa == 0 && aData.as == 0 && parseInt(aData.payment) == 0) {
                        $('td', nRow).css('background-color', 'rgba(76,82,85,0.36)');
                    }
                }
                ,
                "bInfo": false,
                "paging": false,
                "bPaginate": false,
                "columnDefs": [
                    {"orderable": false, "targets": 0},
                ],
                "order": [[1, "ACcS"]],
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
                    ajax: "{{ route('admin.ReportMonthly.list') }}",
                    data:
                        {
                            indate: indate,
                            todate: todate,
                        }
                },
                columns: [
                    {data: 'date', name: 'date'},
                    {data: 'as', name: 'as'},
                    {data: 'total', name: 'total'},
                    {data: 'sum', name: 'sum'},
                    {data: 'sa', name: 'sa'},
                    {data: 'payment', name: 'payment'},


                ],
                "order": [[0, "desc"]]
            });
        }


        $('#filter').click(function () {
            var indate = $('#indate').val();
            var todate = $('#todate').val();
            $('.data-table').DataTable().destroy();
            load_data(indate, todate);
        });

    });





    $('body').on('click', '.detail-tolid', function () {

        detail_factor = $(this).data('id');
        $('#ajaxModellistr').modal('show');
        $("#factttor").DataTable().destroy();
        $('.factttor').DataTable({
            processing: true,
            serverSide: true,
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
            ajax: {
                url: "{{ route('admin.ReportMonthly.list.tolid') }}",
                data: {
                    detail_factor: detail_factor,
                },
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'number', name: 'number'},
                {data: 'date', name: 'date'},
                {data: 'time', name: 'time'},
            ]

        });
        $("#fro").DataTable().destroy();
        $('.fro').DataTable({
            processing: true,
            serverSide: true,
            "ordering": false,
            "searching": false,
            "orderable": false,
            "bSort": false,
            "paging": false,
            "info": false,
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
                url: "{{ route('admin.ReportMonthly.list.frosh') }}",
                data: {
                    detail_factor: detail_factor,
                },
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'pack_id', name: 'pack_id'},
                {data: 'user_id', name: 'user_id'},
                {data: 'customer_id', name: 'customer_id'},
                {data: 'number', name: 'number'},
                {data: 'price', name: 'price'},
            ]

        });
        $("#mar").DataTable().destroy();
        $('.mar').DataTable({
            processing: true,
            serverSide: true,
            "ordering": false,
            "searching": false,
            "orderable": false,
            "bSort": false,
            "paging": false,
            "info": false,
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
                url: "{{ route('admin.ReportMonthly.list.mar') }}",
                data: {
                    detail_factor: detail_factor,
                },
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'user', name: 'user'},
                {data: 'customer', name: 'customer'},
                {data: 'factor', name: 'factor'},
                {data: 'number', name: 'number'},
                {data: 'description', name: 'description'},
            ]

        });

        $("#asnad").DataTable().destroy();
        $('.asnad').DataTable({
            processing: true,
            serverSide: true,
            "ordering": false,
            "searching": false,
            "orderable": false,
            "bSort": false,
            "paging": false,
            "info": false,
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
                url: "{{ route('admin.ReportMonthly.list.asnad') }}",
                data: {
                    detail_factor: detail_factor,
                },
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'customer', name: 'customer'},
                {data: 'payment_id', name: 'payment_id'},
                {data: 'type', name: 'type'},
                {data: 'shenase', name: 'shenase'},
                {data: 'price', name: 'price'},
            ]

        });

    });


    $('#report').addClass('active');

</script>
<script>
    kamaDatepicker('indate',
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
    kamaDatepicker('todate',
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
