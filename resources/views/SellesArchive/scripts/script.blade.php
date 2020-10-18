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
            "order": [[ 8, "deesc" ]],
            "language": {
                "search": "جستجو:",
                "lengthMenu": "نمایش _MENU_",
                "zeroRecords": "موردی یافت نشد!",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "موردی یافت نشد",
                "infoFiltered": "(جستجو از _MAX_ مورد)",
                "processing": "در حال پردازش اطلاعات"
            },
            ajax: "{{ route('admin.salesarchive.list') }}",
            "deferRender": true,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'invoiceNumber', name: 'invoiceNumber'},
                {data: 'date', name: 'date'},
                {data: 'user_name', name: 'user_name'},
                {data: 'customer_name', name: 'customer_name'},
                {data: 'number_sell', name: 'number_sell'},
                {data: 'paymentMethod', name: 'paymentMethod'},
                {data: 'price_sell', name: 'price_sell'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
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


    });

    $('#sell').addClass('active');
</script>
