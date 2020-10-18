<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/jquery.maskedinput.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/datatab.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/row.js')}}" type="text/javascript"></script>
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    var id_id = null;
    var id_customer = null;
    var id_user = null;
    var type_user = null;
    var intime = null;
    var totime = null;
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_data();

        function load_data(customer_id = '', user_id = '', indate = '', todate = '', type = '') {
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "bInfo": false,
                "paging": false,
                "bPaginate": false,
                "ordering": false,
                "searching": false,
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('td:eq(0)', nRow).css('background-color', '#e8ecff');

                    if (aData.payment == "پرداخت شده") {
                        $('td:eq(7)', nRow).css('background-color', 'rgba(8,71,255,0.31)');
                    } else {
                        $('td:eq(7)', nRow).css('background-color', 'rgba(255,0,0,0.32)');

                    }


                    var api = this.api(), aData;
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    var thuTotal = api
                        .column(5)
                        .data()
                        .reduce(function (a, b) {
                            return formatNumber(intVal(a) + intVal(b));
                        }, 0);

                    var friTotal = api
                        .column(6)
                        .data()
                        .reduce(function (a, b) {
                            return formatNumber(intVal(a) + intVal(b));
                        }, 0);

                    $(api.column(0).footer()).html('جمع کل');
                    $(api.column(5).footer()).html(thuTotal);
                    $(api.column(6).footer()).html(friTotal);


                }
                ,
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
                    ajax: "{{ route('admin.ReportMonthly.exit.list') }}",
                    data:
                        {
                            customer_id: customer_id,
                            user_id: user_id,
                            indate: indate,
                            todate: todate,
                            type: type,
                        }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'pack_id', name: 'pack_id'},
                    {data: 'date', name: 'date'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'customer_id', name: 'customer_id'},
                    {data: 'total', name: 'total'},
                    {data: 'price', name: 'price'},
                    {data: 'payment', name: 'payment'},
                ]
            });
        }


        $('#filter').click(function () {
            var customer_id = $('#customer_id').val();
            id_customer = customer_id;
            var user_id = $('#user_id').val();
            id_user = user_id;
            var indate = $('#indate').val();
            intime = indate;
            var todate = $('#todate').val();
            totime = todate;
            var type = $('#type').val();
            type_user = type;
            $('.data-table').DataTable().destroy();
            $('.data').DataTable().destroy();
            load_data(customer_id, user_id, indate, todate, type);
            var data = {
                'id_customer': id_customer,
                "id_user": id_user,
                "intime": intime,
                "totime": totime,
                "type": type_user
            };
            $('.data').DataTable({
                processing: false,
                serverSide: true,
                stateSave: true,
                searching: false,
                "bInfo": false,
                "paging": false,
                "bPaginate": false,
                "ordering": false,
                "columnDefs": [
                    {"orderable": false, "targets": 0},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('td:eq(0)', nRow).css('background-color', '#e8ecff');
                },
                "language": {
                    "search": "جستجو:",
                    "lengthMenu": "نمایش _MENU_",
                    "zeroRecords": "محصولی را انتخاب کنید",
                    "info": "نمایش _PAGE_ از _PAGES_",
                    "infoEmpty": "موردی یافت نشد",
                    "infoFiltered": "(جستجو از _MAX_ مورد)",
                    "processing": "در حال پردازش اطلاعات",
                },
                "ajax": {
                    "url": "{{ route('admin.CustomerStatusReport.list.detail') }}",
                    "data": data
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'type', name: 'type'},
                    {data: 'shenase', name: 'shenase'},
                    {data: 'date', name: 'date'},
                    {data: 'name', name: 'name'},
                    {data: 'name_user', name: 'name_user'},
                    {data: 'price', name: 'price'},
                    {data: 'status', name: 'status'},

                ]
            });

        });


        $('#bulk_delete').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: {
                    'id_custome': $('#customer_id').val(),
                    'id_user': $('#user_id').val(),
                    'intime': $('#indate').val(),
                    'totime': $('#todate').val(),
                    'type': $('#type').val(),
                },
                url: "{{ route('admin.CustomerStatusReport.exit.print') }}",
                dataType: 'html',
                success: function (data) {
                    if (data) {
                        w = window.open(window.location.href, "_blank");
                        w.document.open();
                        w.document.write(data);
                        w.document.close();
                        w.location.reload();
                    }
                }
            });
        });





    });

    $('body').on('click', '.detail-factor', function () {

        var detail_factor = $(this).data('id');
        $('#ajaxModellistr').modal('show');
        $('#factor').DataTable().destroy();
        $('.factor').DataTable({
            processing: true,
            serverSide: true,
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
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: {
                url: "{{ route('admin.payment.list.detail.factor.payment') }}",
                data: {
                    detail_factor: detail_factor,
                },
            },
            columns: [
                {data: 'pack', name: 'pack'},
                {data: 'customer', name: 'customer'},
                {data: 'user', name: 'user'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'total', name: 'total'},
                {data: 'created_at', name: 'created_at'},
            ],
            rowsGroup:
                [
                    0, 1, 2
                ],

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
    $(document).ready(function () {
        $('#customer_id').select2({
            width: '100%',
            dir: 'rtl',
            placeholder: 'مشتریان',
            language: {
                noResults: function () {
                    return 'مشتری با این نام یافت نشد';
                },
            },
        });
    });
</script>
