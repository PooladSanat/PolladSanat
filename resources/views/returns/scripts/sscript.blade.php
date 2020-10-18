<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/public/js/datatab.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/row.js')}}" type="text/javascript"></script>
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
<style>
    .as-console-wrapper {
        display: none !important;
    }

</style>

<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
    @php
        $dat = \Carbon\Carbon::now();
    $date = \Morilog\Jalali\Jalalian::forge($dat)->format('Y/m/d');
    @endphp
    $('#from_date').val('{{$date}}');
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        load_data();

        function load_data(from_check = '', from_date = '{{$date}}', to = '{{$date}}') {
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                "bInfo": false,
                "paging": false,
                "bPaginate": false,
                "columnDefs": [
                    {"orderable": false, "targets": 0},
                ],
                "ordering": false,
                "language":
                    {
                        "search":
                            "جستجو:",
                        "lengthMenu":
                            "نمایش _MENU_",
                        "zeroRecords":
                            "موردی یافت نشد!",
                        "info":
                            "نمایش _PAGE_ از _PAGES_",
                        "infoEmpty":
                            "موردی یافت نشد",
                        "infoFiltered":
                            "(جستجو از _MAX_ مورد)",
                        "processing":
                            "در حال پردازش اطلاعات"
                    },
                ajax: {
                    ajax: "{{ route('admin.returns.list.scheduling') }}",
                    data:
                        {
                            from_check: from_check,
                            from_date: from_date,
                            to: to,
                        }
                },
                "deferRender": true,
                columns: [
                    {data: 'pack', name: 'pack', "className": "dt-center"},
                    {data: 'user_name', name: 'customer_name'},
                    {data: 'customer_name', name: 'customer_name'},
                    {data: 'product', name: 'product'},
                    {data: 'color', name: 'color'},
                    {data: 'number', name: 'number'},
                    {data: 'type', name: 'type'},
                    {data: 'Carry', name: 'Carry'},
                    {data: 'date', name: 'date'},
                    {data: 'description', name: 'description'},
                    {data: 'end', name: 'end'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                rowsGroup:
                    [
                        0, 1, 2, 6, 7, 8, 9, 10, 11
                    ],

            });

        }

        $('#filter').click(function () {
            var from_check = $('#list').val();
            var from_date = $('#from_date').val();
            var to = '';
            $('#data-table').DataTable().destroy();
            load_data(from_check, from_date, to);
        });

        $('body').on('click', '.end', function () {
            var id = $(this).data("id");
            Swal.fire({
                title: 'خروج از انبار موقت؟',
                text: "مشخصات تایید شده از انبار موقت کسر خواهد شد!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'تایید',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.returns.exit')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#data-table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'موفق',
                                text: 'مشخصات با موفقیت در سیستم ثبت شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });

    });


    $('#retu').addClass('active');

</script>


<script>
    kamaDatepicker('from_date',
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
    kamaDatepicker('date',
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
    kamaDatepicker('daatee',
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
