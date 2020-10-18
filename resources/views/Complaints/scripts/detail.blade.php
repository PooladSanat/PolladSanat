<script src="{{asset('/public/js/a1.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/a2.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/jquery.maskedinput.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>

<meta name="_token" content="{{ csrf_token() }}"/>
<script type="text/javascript">
    $('#sell').addClass('active');
</script>
<style>
    .boxed {
        border: 1px solid;
        background-color: white;
    }
</style>
<script type="text/javascript">

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('#mTable').DataTable({
            "paging": false,
            "info": false
        });
        $('#new').click(function () {
            var id = $('#id').val();
            $('#newmodel').modal('show');
            $('#id_com').val(id);
        });
        $('#newbtn').click(function (e) {
            e.preventDefault();
            $('#newbtn').text('در حال ثبت اطلاعات...');
            $('#newbtn').prop("disabled", true);
            var form = $('#newform')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{ route('admin.Complaints.StoreDetail') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function (data) {
                    if (data.errors) {
                        $('#newform').trigger("reset");
                        $('#newmodel').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#newbtn').text('ثبت');
                        $('#newbtn').prop("disabled", false);
                    }
                    if (data.success) {
                        $('#newform').trigger("reset");
                        $('#newmodel').modal('hide');
                        Swal.fire({
                            title: 'موفق',
                            text: 'مشخصات با موفقیت در سیستم ثبت شد',
                            icon: 'success',
                            confirmButtonText: 'تایید',
                        }).then((result) => {

                            location.reload();

                        });
                        $('#newbtn').text('ثبت');
                        $('#newbtn').prop("disabled", false);
                    }
                }
            });
        });
        $('#end').click(function (e) {
            e.preventDefault();
            var id = $('#id').val();
            Swal.fire({
                title: 'بستن شکایت؟',
                text: "بر روی شکایات بسته شده امکان درج اقدام جدید وجود ندارد!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بستن شکایت',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.Complaints.close')}}",
                        data: {
                            'id': id,
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#data-table').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'موفق',
                                text: 'وضعیت شکایت با موفقیت به اتمام یافته تغیر کرد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            }).then((result) => {

                                location.reload();

                            });
                        }
                    });
                }
            })
        });
        $('.modalLink').click(function () {
            var files = [];
            var passedID = $(this).attr('data-id');
            $('.ffff').remove();
            $('.ddddd').remove();
            $.ajax({
                type: 'GET',
                url: "{{route('admin.Complaints.file.check')}}",
                data: {
                    'id': passedID,
                    '_token': $('input[name=_token]').val(),
                },
                success: function (data) {
                    data.forEach(function (item) {
                        files.push({
                            'title': item.title,
                            'file': item.file,
                        });
                    });
                    for (var f in files) {
                        $('#newmoddel').modal('show');
                        const url = 'http://127.0.0.1/PooladPuish/';
                        const path = files[f].file;
                        var counter = 2;
                        var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
                        newTextBoxDiv.after().html('<div class="col-md-12">' +
                            '<div class="col-md-3"></div>' +
                            '<div class="col-md-3"><label class="ffff">' + files[f].title + '</label></div>' +
                            '<div class="col-md-5"><a class="ddddd" target="_blank" href="http://127.0.0.1/PooladPuish/' + files[f].file + '">مشاهده</a></div>' +
                            '<div class="col-md-1"></div>' +
                            '</div>');

                        newTextBoxDiv.appendTo("#TextBoxesGroup");
                        counter++;
                    }


                }
            });


        });

        $('.modalLinkk').click(function () {
            var passedID = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                url: "{{route('admin.Complaints.file.check.des')}}",
                data: {
                    'id': passedID,
                    '_token': $('input[name=_token]').val(),
                },
                success: function (data) {
                    $('#newmoddell').modal('show');
                    $('#description').val(data.description);
                }
            });


        });

    });
</script>
<script language="javascript">


    added_inputs2_array = [];
    if (added_inputs2_array.length >= 1)
        for (var a in added_inputs2_array)
            added_inputs_array_table2(added_inputs2_array[a], a);


    function added_inputs_array_table2(data, a) {
        var myNode = document.createElement('div');
        myNode.id = 'titlee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'ttitle" + a + "\'  name=\"ttitle[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('titlee').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'filee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"file\" id=\'ffile" + a + "\'  name=\"ffile[]\"\n" +
            "class=\"form-control\"/>" +
            "</div></div></div>";
        document.getElementById('filee').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'actiont' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<button onclick='deleteService2(" + a + ", event)' class=\"form-control btn btn-danger\"><i class=\"fa fa-remove\"></button></div>";
        document.getElementById('actiont').appendChild(myNode);


    }

    function deleteService2(id, event) {
        event.preventDefault();
        $('#titlee' + id).remove();
        $('#filee' + id).remove();
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
