<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
    var id = null;
    id = '{{$id->id}}';

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
                if (parseInt(aData.barn) <= parseInt(aData.salesNumber)) {
                    $('td', nRow).css('background-color', '#fb8000');
                } else if (parseInt(aData.barn) >= parseInt(aData.salesNumber)) {
                    $('td', nRow).css('background-color', '#00d1fb');
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
            ajax: "{{ route('admin.invoice.detail.success') }}" + "/" + id,
            columns: [
                {data: 'product', name: 'product'},
                {data: 'color', name: 'color'},
                {data: 'salesNumber', name: 'salesNumber'},
                {data: 'user', name: 'user'},
                {data: 'costumer', name: 'costumer'},
                {data: 'barn', name: 'barn'},
                {data: 'detail_success', name: 'detail_success', orderable: false, searchable: false},
            ]

        });

        $('body').on('click', '.SendToListNumber', function () {
            $('#saveToListd').prop("disabled", false);
            var id = $(this).data('id');
            $.get("{{ route('admin.invoice.payment.checked') }}" + '/' + id, function (data) {
                $('#successdetailModal').modal('show');
                $('#invoice_product').val(id);
                $('#number').val(data.number - data.product);
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
                        $('#dataa-table').DataTable().ajax.reload();
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
                    if (data.errors) {
                        $('#successdetailModal').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
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
                        $('#dataa-table').DataTable().ajax.reload();
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

    });

    $('#sell').addClass('active');
</script>
