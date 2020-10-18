<script src="{{asset('/public/js/1.js')}}"></script>
<script src="{{asset('/public/assets/sweetalert.js')}}"></script>
<link href="{{asset('/public/css/1.css')}}" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>

<style>
    .registercontpage {
        position: relative;
        z-index: 0;
        background: #fff;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 10px;
        font-size: 12px;
        border-radius: 50px;
    }

    .btn-circle {
        background: #000;
    }

    .btn-default[disabled] {
        background-color: #cccccc;
        border-color: #cccccc;
    }

    .stepwizard-step p {
        margin-top: 10px;
    }

    .stepwizard-row {
        display: table-row;
    }

    .stepwizard {
        display: table;
        width: 50%;
        position: relative;
    }

    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }

    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }

    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }

    .btn-circle {
        width: 50px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }

    .field {
        position: relative;
        float: left;
        clear: both;
        margin: .35em 0;
        width: 100%;
    }


</style>
<style>
    .pt-3-half {
        padding-top: 1.4rem;
    }
</style>
<script type="text/javascript">
    $(window).bind("load", function () {
        var D_date = $('#D_date').val();
        $('#date').val(D_date);
        $('#date').val($('#datew').val());
        $('#Established_company').val($('#H_Established_companys').val());
        $('#date_work_company').val($('#D_date_work_company').val());
        $('#date_personel').val($('#D_date_personel').val());
        $('#date_birth').val($('#D_date_birth').val());
        $('#credibilitylicense_work_company').val($('#C_credibilitylicense_work_company').val());
        added_inputs1_array = [];
            @foreach($customer_banks as $customer_bank)
        var customer_bank = {
                'name_bank_company': "{{$customer_bank->name_bank_company}}",
                'branch_bank_company': "{{$customer_bank->branch_bank_company}}",
                'account_bank_company': "{{$customer_bank->account_bank_company}}",
                'date_bank_company': "{{$customer_bank->date_bank_company}}",
            };
        added_inputs1_array.push(customer_bank);
        @endforeach
        if (added_inputs1_array.length >= 1)
            for (var a in added_inputs1_array)
                added_inputs_array_table1(added_inputs1_array[a], a);


        added_inputs2_array = [];
            @foreach($customer_securings as $customer_securing)
        var customer_securing = {
                'name_securing_company': "{{$customer_securing->name_securing_company}}",
                'date_securing_company': "{{$customer_securing->date_securing_company}}",

            };
        added_inputs2_array.push(customer_securing);
        @endforeach

        if (added_inputs2_array.length >= 1)
            for (var a in added_inputs2_array)
                added_inputs_array_table2(added_inputs2_array[a], a);


        added_inputs3_array = [];
            @foreach($company_personals as $company_personal)
        var company_personal = {
                'per_side_company': "{{$company_personal->per_side_company}}",
                'per_sex_company': "{{$company_personal->per_sex_company}}",
                'per_title_company': "{{$company_personal->per_title_company}}",
                'per_name_company': "{{$company_personal->per_name_company}}",
                'per_phone_company': "{{$company_personal->per_phone_company}}",
                'per_inside_company': "{{$company_personal->per_inside_company}}",
                'per_email_company': "{{$company_personal->per_email_company}}",
                'per_tel_company_company': "{{$company_personal->per_tel_company_company}}",

            };
        added_inputs3_array.push(company_personal);
        @endforeach
        if (added_inputs3_array.length >= 1)
            for (var a in added_inputs3_array)
                added_inputs_array_table3(added_inputs3_array[a], a);


    });
</script>
<script src="{{asset('/public/js/2.js')}}"></script>

<script>


    $(document).ready(function () {
        $('#nextBtn').click(function () {
            var type = $('#type').val();
            if (type) {
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.customers.filter')}}?type=" + type,
                    success: function (res) {
                        if (res == 1) {
                            $('#company').show();
                            $('#personal').hide();
                            $('#id').val('1');
                        } else {
                            $('#company').hide();
                            $('#personal').show();
                            $('#id').val('2');
                        }
                    }
                });
            }
        });
        var tests = $('#country').val();
        var zone_id = $('#zone_id').val();
        var areas_id = $('#areas_id').val();
        $.ajax({
            url: "{{route('admin.list.check.city')}}?commodity_id=" + tests,
            context: document.body,
            success: function (res) {
                if (res) {
                    $("#city").empty();
                    $("#city").append('<option>لطفا شهر را انتخاب کنید</option>');
                    $.each(res, function (key, value) {
                        $("#city").val(zone_id);
                        $("#city").append('<option value="' + value.zone_id + '">' + value.name + '</option>');
                    });
                } else {
                    $("#city").empty();
                }
            }
        });
        $.ajax({
            url: "{{route('admin.list.check.state')}}?commodity_id=" + zone_id,
            context: document.body,
            success: function (res) {
                if (res) {
                    $("#staate").empty();
                    $("#staate").append('<option>لطفا منطقه را انتخاب کنید</option>');
                    $.each(res, function (key, value) {
                        console.log(areas_id);
                        $("#staate").val(areas_id);
                        $("#staate").append('<option value="' + value.id + '">' + value.areas + '</option>');
                    });
                } else {
                    $("#staate").empty();
                }
            }
        });
        $('#country').change(function () {
            var commodityID = $(this).val();
            if (commodityID) {
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.list.check.city')}}?commodity_id=" + commodityID,
                    success: function (res) {
                        if (res) {
                            $("#city").empty();
                            $("#city").append('<option>لطفا شهر را انتخاب کنید</option>');
                            $.each(res, function (key, value) {
                                $("#city").append('<option value="' + value.zone_id + '">' + value.name + '</option>');
                            });
                        } else {
                            $("#city").empty();
                        }
                    }
                });
            } else {
                $("#city").empty();
            }
        });
        $('#city').change(function () {
            var commodityID = $(this).val();
            if (commodityID) {
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.list.check.state')}}?commodity_id=" + commodityID,
                    success: function (res) {
                        if (res) {
                            console.log(res);
                            $("#staate").empty();
                            $("#staate").append('<option>لطفا منطقه را انتخاب کنید</option>');
                            $.each(res, function (key, value) {
                                $("#staate").append('<option value="' + value.id + '">' + value.areas + '</option>');
                            });
                        } else {
                            $("#staate").empty();
                        }
                    }
                });
            } else {
                $("#staate").empty();
            }
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
        kamaDatepicker('date_work_company',
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
        kamaDatepicker('date_personel',
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
        kamaDatepicker('date_birth',
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
        kamaDatepicker('credibilitylicense_work_company',
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
        kamaDatepicker('Established_company',
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
    });

</script>

<script>
    function numberOnly(input) {
        var regex = /[^0-9]/gi;
        input.value = input.value.replace(regex, "");
    }

    $(document).ready(function () {
        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);
            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url'],textarea[textarea]"),
                isValid = true;
            console.log(curStepBtn);
            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                console.log(curInputs);
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-primary').trigger('click');
    });

</script>

<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $('#saveBtn').text('در حال ثبت اطلاعات...');
            $('#saveBtn').prop("disabled", true);
            var form = $('#productForm')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{ route('admin.customers.edit') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function (data) {
                    if (data.errors) {
                        $('#ajaxModel').modal('hide');
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);
                    }
                    if (data.success) {
                        Swal.fire({
                            title: 'موفق',
                            text: data.success,
                            icon: 'success',
                            confirmButtonText: 'تایید'
                        }).then((result) => {

                            location.reload();

                        });
                        $('#saveBtn').text('ثبت');
                        $('#saveBtn').prop("disabled", false);

                    }
                }
            });
        });
    });

</script>

<script language="javascript">
    function added_inputs_array_table1(data, a) {
        var myNode = document.createElement('div');
        myNode.id = 'namee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'name_bank_company" + a + "\'  name=\"name_bank_company[]\"\n" +
            "class=\"form-control sell\"/>" +
            "</div></div></div>";
        document.getElementById('namee').appendChild(myNode);
        $('#name_bank_company' + a + '').val(data.name_bank_company);
        var myNode = document.createElement('div');
        myNode.id = 'shobee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'branch_bank_company" + a + "\'  name=\"branch_bank_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('shobee').appendChild(myNode);
        $('#branch_bank_company' + a + '').val(data.branch_bank_company);
        var myNode = document.createElement('div');
        myNode.id = 'shomaree' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'account_bank_company" + a + "\'  name=\"account_bank_company[]\"\n" +
            "class=\"form-control Price_Sell\"/>" +
            "</div></div></div>";
        document.getElementById('shomaree').appendChild(myNode);
        $('#account_bank_company' + a + '').val(data.account_bank_company);

        var myNode = document.createElement('div');
        myNode.id = 'tarikhh' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'date_bank_company" + a + "\'  name=\"date_bank_company[]\"\n" +
            "class=\"form-control Weight\"/>" +
            "</div></div></div>";
        document.getElementById('tarikhh').appendChild(myNode);
        $('#date_bank_company' + a + '').val(data.date_bank_company);

        var myNode = document.createElement('div');
        myNode.id = 'actiont' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<button onclick='deleteService1(" + a + ", event)' class=\"form-control btn btn-danger\"><i class=\"fa fa-remove\"></button></div>";
        document.getElementById('actiont').appendChild(myNode);
    }

    function deleteService1(id, event) {
        event.preventDefault();
        $('#namee' + id).remove();
        $('#shobee' + id).remove();
        $('#shomaree' + id).remove();
        $('#tarikhh' + id).remove();
        $('#actiont' + id).remove();
    }


    function addInput10() {
        var data = {
            'title': '',
            'icon': '',
        };
        added_inputs1_array.push(data);
        added_inputs_array_table1(data, added_inputs1_array.length - 1);
    }
</script>

<script language="javascript">


    function added_inputs_array_table2(data, a) {

        var myNode = document.createElement('div');
        myNode.id = 'nameee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'name_securing_company" + a + "\'  name=\"name_securing_company[]\"\n" +
            "class=\"form-control sell\"/>" +
            "</div></div></div>";
        document.getElementById('nameee').appendChild(myNode);
        $('#name_securing_company' + a + '').val(data.name_securing_company);
        var myNode = document.createElement('div');
        myNode.id = 'shobeee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'date_securing_company" + a + "\'  name=\"date_securing_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('shobeee').appendChild(myNode);
        $('#date_securing_company' + a + '').val(data.date_securing_company);
        var myNode = document.createElement('div');
        myNode.id = 'actiontt' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<button onclick='deleteService2(" + a + ", event)' class=\"form-control btn btn-danger\"><i class=\"fa fa-remove\"></button></div>";
        document.getElementById('actiontt').appendChild(myNode);
    }

    function deleteService2(id, event) {
        event.preventDefault();
        $('#nameee' + id).remove();
        $('#shobeee' + id).remove();
        $('#actiontt' + id).remove();
    }


    function addInput11() {
        var data = {
            'title': '',
            'icon': '',
        };
        added_inputs2_array.push(data);
        added_inputs_array_table2(data, added_inputs2_array.length - 1);
    }
</script>

<script language="javascript">

    function added_inputs_array_table3(data, a) {

        var myNode = document.createElement('div');
        myNode.id = 'per_side' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_side_company" + a + "\'  name=\"per_side_company[]\"\n" +
            "class=\"form-control sell\"/>" +
            "</div></div></div>";
        document.getElementById('per_side').appendChild(myNode);
        $('#per_side_company' + a + '').val(data.per_side_company);
        var myNode = document.createElement('div');
        myNode.id = 'per_sex' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_sex_company" + a + "\'  name=\"per_sex_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_sex').appendChild(myNode);
        $('#per_sex_company' + a + '').val(data.per_sex_company);

        var myNode = document.createElement('div');
        myNode.id = 'per_title' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_title_company" + a + "\'  name=\"per_title_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_title').appendChild(myNode);
        $('#per_title_company' + a + '').val(data.per_title_company);
        var myNode = document.createElement('div');
        myNode.id = 'per_name' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_name_company" + a + "\'  name=\"per_name_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_name').appendChild(myNode);
        $('#per_name_company' + a + '').val(data.per_name_company);

        var myNode = document.createElement('div');
        myNode.id = 'per_phone' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_phone_company" + a + "\'  name=\"per_phone_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_phone').appendChild(myNode);
        $('#per_phone_company' + a + '').val(data.per_phone_company);
        var myNode = document.createElement('div');
        myNode.id = 'per_inside' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_inside_company" + a + "\'  name=\"per_inside_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_inside').appendChild(myNode);
        $('#per_inside_company' + a + '').val(data.per_inside_company);

        var myNode = document.createElement('div');
        myNode.id = 'per_email' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_email_company" + a + "\'  name=\"per_email_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_email').appendChild(myNode);
        $('#per_email_company' + a + '').val(data.per_email_company);
        var myNode = document.createElement('div');
        myNode.id = 'per_tel' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_tel_company_company" + a + "\'  name=\"per_tel_company_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_tel').appendChild(myNode);
        $('#per_tel_company_company' + a + '').val(data.per_tel_company_company);
        var myNode = document.createElement('div');
        myNode.id = 'actiontt' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<button onclick='deleteService3(" + a + ", event)' class=\"form-control btn btn-danger\"><i class=\"fa fa-remove\"></button></div>";
        document.getElementById('actionttt').appendChild(myNode);
    }

    function deleteService3(id, event) {
        event.preventDefault();
        $('#per_side' + id).remove();
        $('#per_sex' + id).remove();
        $('#per_title' + id).remove();
        $('#per_name' + id).remove();
        $('#per_phone' + id).remove();
        $('#per_inside' + id).remove();
        $('#per_email' + id).remove();
        $('#per_tel' + id).remove();
        $('#actionttt' + id).remove();
    }


    function addInput12() {
        var data = {
            'title': '',
            'icon': '',
        };
        added_inputs3_array.push(data);
        added_inputs_array_table3(data, added_inputs3_array.length - 1);
    }
</script>


<style>
    .vertical {
        border-left: 1px solid black;
        height: 470px;
        position: absolute;
        margin-top: 40px;
        left: 50%;
    }
</style>
<script>

    $(function () {


        $("#delete_certificate_documents_company").bind("click", function () {
            var id = $('#id_customer').val();
            Swal.fire({
                title: 'حذف فایل شناسنامه؟',
                text: "فایل های حذف شده قابل بازیابی نیستند!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.customers.delete.fileCertificate')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#check_certificate_documents_company').hide();
                            $('#delete_certificate_documents_company').hide();
                            $('#view_certificate_documents_company').hide();
                            document.getElementById("uncheck_certificate_documents_company").style.visibility = "visible";
                            Swal.fire({
                                title: 'موفق',
                                text: 'فایل شناسنامه با موفقیت از پرونده ای مشتری حذف شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });
        $("#delete_cart_documents_company").bind("click", function () {
            var id = $('#id_customer').val();
            Swal.fire({
                title: 'حذف فایل کارت ملی؟',
                text: "فایل های حذف شده قابل بازیابی نیستند!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.customers.delete.fileCart')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#check_cart_documents_company').hide();
                            $('#delete_cart_documents_company').hide();
                            $('#view_cart_documents_company').hide();
                            document.getElementById("uncheck_cart_documents_company").style.visibility = "visible";
                            Swal.fire({
                                title: 'موفق',
                                text: 'فایل کارت ملی با موفقیت از پرونده ای مشتری حذف شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });
        $("#delete_activity_documents_company").bind("click", function () {
            var id = $('#id_customer').val();
            Swal.fire({
                title: 'حذف فایل محل فعالیت؟',
                text: "فایل های حذف شده قابل بازیابی نیستند!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.customers.delete.fileActivity')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#check_activity_documents_company').hide();
                            $('#delete_activity_documents_company').hide();
                            $('#view_activity_documents_company').hide();
                            document.getElementById("uncheck_activity_documents_company").style.visibility = "visible";
                            Swal.fire({
                                title: 'موفق',
                                text: 'فایل محل فعالیت با موفقیت از پرونده ای مشتری حذف شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });
        $("#delete_store_documents_company").bind("click", function () {
            var id = $('#id_customer').val();
            Swal.fire({
                title: 'حذف فایل مالکیت فروشگاه؟',
                text: "فایل های حذف شده قابل بازیابی نیستند!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.customers.delete.fileStore')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#check_store_documents_company').hide();
                            $('#delete_store_documents_company').hide();
                            $('#view_store_documents_company').hide();
                            document.getElementById("uncheck_store_documents_company").style.visibility = "visible";
                            Swal.fire({
                                title: 'موفق',
                                text: 'فایل مالکیت فروشگاه با موفقیت از پرونده ای مشتری حذف شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });
        $("#delete_ownership_documents_company").bind("click", function () {
            var id = $('#id_customer').val();
            Swal.fire({
                title: 'حذف فایل مالکیت انبار؟',
                text: "فایل های حذف شده قابل بازیابی نیستند!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.customers.delete.fileOwnership')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#check_ownership_documents_company').hide();
                            $('#delete_ownership_documents_company').hide();
                            $('#view_ownership_documents_company').hide();
                            document.getElementById("uncheck_ownership_documents_company").style.visibility = "visible";
                            Swal.fire({
                                title: 'موفق',
                                text: 'فایل مالکیت انبار با موفقیت از پرونده ای مشتری حذف شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });
        $("#delete_established_documents_company").bind("click", function () {
            var id = $('#id_customer').val();
            Swal.fire({
                title: 'حذف فایل تاسیس و بهره برداری؟',
                text: "فایل های حذف شده قابل بازیابی نیستند!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.customers.delete.fileEstablished')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#check_established_documents_company').hide();
                            $('#delete_established_documents_company').hide();
                            $('#view_established_documents_company').hide();
                            document.getElementById("uncheck_established_documents_company").style.visibility = "visible";
                            Swal.fire({
                                title: 'موفق',
                                text: 'فایل تاسیس و بهره برداری با موفقیت از پرونده ای مشتری حذف شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });
        $("#delete_sstore_documents_company").bind("click", function () {
            var id = $('#id_customer').val();
            Swal.fire({
                title: 'حذف فایل عکس فروشگاه؟',
                text: "فایل های حذف شده قابل بازیابی نیستند!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.customers.delete.fileSstore')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#check_sstore_documents_company').hide();
                            $('#delete_sstore_documents_company').hide();
                            $('#view_sstore_documents_company').hide();
                            document.getElementById("uncheck_sstore_documents_company").style.visibility = "visible";
                            Swal.fire({
                                title: 'موفق',
                                text: 'فایل عکس فروشگاه با موفقیت از پرونده ای مشتری حذف شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });
        $("#delete_pstore_documents_company").bind("click", function () {
            var id = $('#id_customer').val();
            Swal.fire({
                title: 'حذف فایل عکس انبار؟',
                text: "فایل های حذف شده قابل بازیابی نیستند!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.customers.delete.filePstore')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#check_pstore_documents_company').hide();
                            $('#delete_pstore_documents_company').hide();
                            $('#view_pstore_documents_company').hide();
                            document.getElementById("uncheck_pstore_documents_company").style.visibility = "visible";
                            Swal.fire({
                                title: 'موفق',
                                text: 'فایل عکس انبار با موفقیت از پرونده ای مشتری حذف شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });
        $("#delete_final_documents_company").bind("click", function () {
            var id = $('#id_customer').val();
            Swal.fire({
                title: 'حذف فایل نتیجه استعلام حسابهای بانکی؟',
                text: "فایل های حذف شده قابل بازیابی نیستند!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.customers.delete.fileFinal')}}" + '/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function (data) {
                            $('#check_final_documents_company').hide();
                            $('#delete_final_documents_company').hide();
                            $('#view_final_documents_company').hide();
                            document.getElementById("uncheck_final_documents_company").style.visibility = "visible";
                            Swal.fire({
                                title: 'موفق',
                                text: 'فایل نتیجه استعلام حسابهای بانکی با موفقیت از پرونده ای مشتری حذف شد',
                                icon: 'success',
                                confirmButtonText: 'تایید'
                            })
                        }
                    });
                }
            })
        });


    });

    $('#customer').addClass('active');

</script>
