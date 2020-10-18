<script src="{{asset('/public/js/1.js')}}"></script>
<script src="{{asset('/public/assets/sweetalert.js')}}"></script>
<link href="{{asset('/public/css/1.css')}}" rel="stylesheet" id="bootstrap-css">
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
<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
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
                url: "{{ route('admin.customers.store') }}",
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

<script>
    added_inputs1_array = [];
    if (added_inputs1_array.length >= 1)
        for (var a in added_inputs1_array)
            added_inputs_array_table2(added_inputs1_array[a], a);


    function added_inputs_array_table1(data, a) {

        var myNode = document.createElement('div');
        myNode.id = 'namee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'name_bank_company" + a + "\'  name=\"name_bank_company[]\"\n" +
            "class=\"form-control sell\"/>" +
            "</div></div></div>";
        document.getElementById('namee').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'shobee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'branch_bank_company" + a + "\'  name=\"branch_bank_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('shobee').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'shomaree' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'account_bank_company" + a + "\'  name=\"account_bank_company[]\"\n" +
            "class=\"form-control Price_Sell\"/>" +
            "</div></div></div>";
        document.getElementById('shomaree').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'tarikhh' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'date_bank_company" + a + "\'  name=\"date_bank_company[]\"\n" +
            "class=\"form-control Weight\"/>" +
            "</div></div></div>";
        document.getElementById('tarikhh').appendChild(myNode);


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
<script>
    added_inputs2_array = [];
    if (added_inputs2_array.length >= 1)
        for (var a in added_inputs2_array)
            added_inputs_array_table2(added_inputs2_array[a], a);


    function added_inputs_array_table2(data, a) {

        var myNode = document.createElement('div');
        myNode.id = 'nameee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'name_securing_company" + a + "\'  name=\"name_securing_company[]\"\n" +
            "class=\"form-control sell\"/>" +
            "</div></div></div>";
        document.getElementById('nameee').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'shobeee' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'date_securing_company" + a + "\'  name=\"date_securing_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('shobeee').appendChild(myNode);

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
<script>
    added_inputs3_array = [];
    if (added_inputs3_array.length >= 1)
        for (var a in added_inputs3_array)
            added_inputs_array_table2(added_inputs3_array[a], a);


    function added_inputs_array_table3(data, a) {

        var myNode = document.createElement('div');
        myNode.id = 'per_side' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_side_company" + a + "\'  name=\"per_side_company[]\"\n" +
            "class=\"form-control sell\"/>" +
            "</div></div></div>";
        document.getElementById('per_side').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'per_sex' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_sex_company" + a + "\'  name=\"per_sex_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_sex').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'per_title' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_title_company" + a + "\'  name=\"per_title_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_title').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'per_name' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_name_company" + a + "\'  name=\"per_name_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_name').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'per_phone' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_phone_company" + a + "\'  name=\"per_phone_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_phone').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'per_inside' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_inside_company" + a + "\'  name=\"per_inside_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_inside').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'per_email' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_email_company" + a + "\'  name=\"per_email_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_email').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'per_tel' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'per_tel_company_company" + a + "\'  name=\"per_tel_company_company[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('per_tel').appendChild(myNode);

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
