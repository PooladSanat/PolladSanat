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
                    if (parseInt(aData.t) > parseInt("0")) {
                        $('td:eq(5)', nRow).css('background-color', 'rgba(204,255,141,0.58)');
                    } else if (parseInt(aData.t) < parseInt("0")) {
                        $('td:eq(5)', nRow).css('background-color', 'rgba(255,106,107,0.4)');
                    } else if (parseInt(aData.t) == parseInt("0")) {
                        $('td:eq(5)', nRow).css('background-color', 'rgb(248,244,255)');
                    }
                    $('#sum_gg').text(aData.prrice).css('background-color', 'rgba(255,106,107,0.4)');

                    if (parseInt(aData.rreciveprice) > 0) {
                        $('#sum_hh').text(aData.rreciveprice).css('background-color', 'rgba(0,183,255,0.42)');
                    } else {
                        $('#sum_hh').text(aData.rreciveprice).css('background-color', 'rgb(255,249,255)');
                    }

                    if (parseInt(aData.rrecivepricee) < 0) {
                        $('#sum_jj').text(aData.rrecivepriceee).css('background-color', 'rgba(255,106,107,0.4)');
                    } else if (parseInt(aData.rrecivepricee) > 0) {
                        $('#sum_jj').text(aData.rrecivepriceee).css('background-color', 'rgba(0,183,255,0.42)');
                    } else {
                        $('#sum_jj').text(aData.rrecivepriceee).css('background-color', 'rgb(255,249,255)');
                    }


                    if (parseInt(aData.customerr) > 0) {
                        $('#sum_j').text(aData.customerr).css('background-color', 'rgba(255,106,107,0.4)');
                    } else {
                        $('#sum_j').text(aData.customerr).css('background-color', 'rgb(255,249,255)');
                    }
                    $('#sum_customer').text(aData.sum_customerr);
                    if (parseInt(aData.summmm) < 0) {
                        $('#summ').text(formatNumber(Math.abs(aData.summmm))).css('background-color', 'rgba(255,106,107,0.4)');
                    } else if (parseInt(aData.summmm) > 0) {
                        $('#summ').text(formatNumber(Math.abs(aData.summmm))).css('background-color', 'rgba(0,183,255,0.42)');
                    } else if (parseInt(aData.summmm) == 0) {
                        $('#summ').text(formatNumber(Math.abs(aData.summmm))).css('background-color', 'rgba(255,249,255)');
                    }


                    if (parseInt(aData.account) < 0) {
                        $('#a').text(aData.accountt).css('background-color', 'rgba(255,106,107,0.4)');
                    } else if (parseInt(aData.account) > 0) {
                        $('#a').text(aData.accountt).css('background-color', 'rgba(0,183,255,0.42)');
                    } else if (parseInt(aData.account) == 0) {
                        $('#a').text(aData.accountt).css('background-color', 'rgba(255,249,255)');
                    }


                    if (parseInt(aData.summmm) < 0) {
                        $('#b').text(formatNumber(Math.abs(aData.summmm))).css('background-color', 'rgba(255,106,107,0.4)');
                    } else if (parseInt(aData.summmm) > 0) {
                        $('#b').text(formatNumber(Math.abs(aData.summmm))).css('background-color', 'rgba(0,183,255,0.42)');
                    } else if (parseInt(aData.summmm) == 0) {
                        $('#b').text(formatNumber(Math.abs(aData.summmm))).css('background-color', 'rgba(255,249,255)');
                    }
                    var dd = aData.rrecivepricee - aData.customer;

                    if (parseInt(aData.accou) - parseInt(aData.summmm) < 0) {
                        $('#c').text(formatNumber(Math.abs(aData.accou - aData.summmm))).css('background-color', 'rgba(0,183,255,0.42)');
                    } else if (parseInt(aData.accou) - parseInt(aData.summmm) > 0) {
                        $('#c').text(formatNumber(Math.abs(aData.accou - aData.summmm))).css('background-color', 'rgba(255,106,107,0.4)');
                    } else if (parseInt(aData.accou) - parseInt(aData.summmm) == 0) {
                        $('#c').text(formatNumber(Math.abs(aData.accou - aData.summmm))).css('background-color', 'rgba(255,249,255)');
                    }
                    $("#cap").text("جزییات صورتحساب" + " " + aData.iid);

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
                    ajax: "{{ route('admin.CustomerStatusReport.list') }}",
                    data:
                        {
                            customer_id: customer_id,
                            indate: indate,
                            todate: todate,
                        }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'price', name: 'price'},
                    {data: 'reciveprice', name: 'reciveprice'},
                    {data: 'total', name: 'total'},
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
                    if (aData.status == "پرداخت شده") {
                        $('td:eq(8)', nRow).css('background-color', 'rgba(0,183,255,0.42)');

                    } else {
                        $('td:eq(8)', nRow).css('background-color', 'rgba(255,106,107,0.4)');

                    }
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
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "dt-center"},
                    {data: 'type', name: 'type'},
                    {data: 'payment', name: 'payment'},
                    {data: 'shenase', name: 'shenase'},
                    {data: 'datee', name: 'datee'},
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
                    'id_customer': id_customer,
                    'intime': intime,
                    'totime': totime,
                },
                url: "{{ route('admin.CustomerStatusReport.print') }}",
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
        $('#ajaxModellistre').modal('show');
        $('#factooooor').DataTable().destroy();
        $('.factooooor').DataTable({
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
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: {
                url: "{{ route('admin.payment.list.detail.factor') }}",
                data: {
                    detail_factor: detail_factor,
                },
            },
            columns: [
                {data: 'id', name: 'id', "className": "dt-center"},
                {data: 'customer', name: 'customer'},
                {data: 'user', name: 'user'},
                {data: 'factor', name: 'factor'},
                {data: 'ta', name: 'ta'},
                {data: 'type', name: 'type'},
                {data: 'created_at', name: 'created_at'},
            ],
            rowsGroup:
                [
                    0, 1, 2, 3, 4, 5, 6
                ],

        });


    });


    $('body').on('click', '.detail-factor-product', function () {
        var detail_factor = $(this).data('id');
        $("#tt").removeClass('active');
        $("#ff").addClass('active');
        $("#t").removeClass('active');
        $("#f").addClass('active');
        $('#factooor').DataTable().destroy();
        $('.factooor').DataTable({
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
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: {
                url: "{{ route('admin.payment.list.detail.factor.detail') }}",
                data: {
                    detail_factor: detail_factor,
                },
            },
            columns: [
                {data: 'id', name: 'id', "className": "dt-center"},
                {data: 'customer', name: 'customer'},
                {data: 'user', name: 'user'},
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'total', name: 'total'},
                {data: 'created_at', name: 'created_at'},
            ],
            rowsGroup:
                [
                    0, 1, 2, 6
                ],

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
