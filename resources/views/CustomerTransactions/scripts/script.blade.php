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
    var intime = null;
    var totime = null;
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_data();

        function load_data(customer_id = '', indate = '', todate = '') {
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "bInfo": false,
                "paging": false,
                "bPaginate": false,
                "ordering": false,
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('td:eq(0)', nRow).css('background-color', '#e8ecff');
                    if (parseInt(aData.price) > parseInt("0")) {
                        $('td:eq(4)', nRow).css('background-color', 'rgba(8,71,255,0.33)');
                    }
                    if (parseInt(aData.sum) > parseInt("0")) {
                        $('td:eq(3)', nRow).css('background-color', 'rgba(255,0,0,0.33)');
                    }

                    var api = this.api(), aData;
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    var wedTotal = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    var thuTotal = api
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);


                    $(api.column(0).footer()).html('جمع کل');
                    $(api.column(3).footer()).html(formatNumber(wedTotal));
                    $(api.column(4).footer()).html(formatNumber(thuTotal));


                    if (thuTotal - wedTotal > 0) {
                        $("#sum_pricee").text('').css('background-color', 'rgb(248,244,255)');
                        $("#sum_price").text(formatNumber(Math.abs(thuTotal - wedTotal))).css('background-color', 'rgba(0,183,255,0.33)');
                    } else if (thuTotal - wedTotal < 0) {
                        $("#sum_price").text('').css('background-color', 'rgb(248,244,255)');
                        $("#sum_pricee").text(formatNumber(Math.abs(thuTotal - wedTotal))).css('background-color', 'rgba(255,0,0,0.33)');
                    } else {
                        $("#sum_pricee").text('0').css('background-color', 'rgb(248,244,255)');

                        $("#sum_price").text('0').css('background-color', 'rgb(248,244,255)');

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
                    ajax: "{{ route('admin.CustomerTransactions.list') }}",
                    data:
                        {
                            customer_id: customer_id,
                            indate: indate,
                            todate: todate,
                        }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'date', name: 'date'},
                    {data: 'description', name: 'description'},
                    {data: 'sum', name: 'sum'},
                    {data: 'price', name: 'price'},

                ]
            });
        }


        $('#filter').click(function () {
            var customer_id = $('#customer_id').val();
            id_customer = customer_id;
            var indate = $('#indate').val();
            intime = indate;
            var todate = $('#todate').val();
            totime = todate;
            $('.data-table').DataTable().destroy();
            $('.data').DataTable().destroy();
            load_data(customer_id, indate, todate);
            var data = {'id_customer': id_customer, "intime": intime, "totime": totime};
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

                ]
            });

        });


        $('#bulk_delete').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: {
                    'id_customer': id_customer,
                    'intime': intime,
                    'totime': totime,
                },
                url: "{{ route('admin.CustomerTransactions.print') }}",
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

    $('#payment').addClass('active');

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
