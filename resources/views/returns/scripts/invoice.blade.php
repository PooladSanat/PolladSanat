<script src="{{asset('/public/js/2.js')}}"></script>
<link rel="stylesheet" href="{{asset('/public/css/kamadatepicker.min.css')}}">
<script src="{{asset('/public/js/kamadatepicker.min.js')}}"></script>
<script type="text/javascript">
    @php
        $dat = \Carbon\Carbon::now();
    $date = \Morilog\Jalali\Jalalian::forge($dat)->format('Y/m/d');
    @endphp
    $('#created').val('{{$date}}');
    $(function () {

        $('#sell').addClass('active');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            var form = $('#productForm').serialize();
            $.ajax({
                url: "{{ route('admin.returns.store.stoore') }}",
                data: form,
                type: 'POST',
                success: function (data) {
                    if (data.errors) {
                        jQuery.each(data.errors, function (key, value) {
                            Swal.fire({
                                title: 'خطا!',
                                text: value,
                                icon: 'error',
                                confirmButtonText: 'تایید'
                            })
                        });
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

                    }
                }
            });
        });

        $('#paymentMethod')
            .change(function () {
                var t = $('#paymentMethod').val();
                if (t == "نقدی") {
                    $('#takhfif').val(23);
                } else if (t == "بصورت چک 1 ماهه") {
                    $('#takhfif').val(21);
                } else if (t == "بصورت چک 2 ماهه") {
                    $('#takhfif').val(19);
                } else if (t == "بصورت چک 3 ماهه") {
                    $('#takhfif').val(17);
                }
                totalfinal();
            })
            .change();

    });

</script>


<script language="javascript">
    var all_modelProducts = [];
    var all_settings = [];
    @foreach($modelProducts as $modelProduct)
    all_modelProducts.push({'product_id': '{{$modelProduct->product_id}}', 'size': '{{$modelProduct->size}}'});
    @endforeach

    all_settings.push({'Tax': '{{$setting->Tax}}'});

    var all_modelProduct = all_modelProducts;
    var all_setting = all_settings;
    for (var i in all_setting)

        added_inputs2_array = [];
    if (added_inputs2_array.length >= 1)
        for (var a in added_inputs2_array)
            added_inputs_array_table2(added_inputs2_array[a], a);


    function added_inputs_array_table2(data, a) {

        var myNode = document.createElement('div');
        myNode.id = 'productt' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'product" + a + "\'  name=\"product[]\"\n" +
            "class=\"form-control\"/>" +
            "<option>انتخاب کنید</option>" +
            "+@foreach($products as $product)+" +
            "<option value=\"{{$product->id}}\">{{$product->label}}</option>" +
            "+@endforeach+" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('productt').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'color' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<select id=\'color" + a + "\'  name=\"color[]\"\n" +
            "class=\"form-control\"/>" +
            "+@foreach($colors as $color)+" +
            "<option value=\"{{$color->id}}\">{{$color->name}}</option>" +
            "+@endforeach+" +
            "</select>" +
            "</div></div></div>";
        document.getElementById('color').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'selll' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'sell" + a + "\'  name=\"sell[]\"\n" +
            "class=\"form-control sell\"/>" +
            "</div></div></div>";
        document.getElementById('selll').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'numberr' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'number" + a + "\'  name=\"number[]\"\n" +
            "class=\"form-control number\"/>" +
            "</div></div></div>";
        document.getElementById('numberr').appendChild(myNode);

        var myNode = document.createElement('div');
        myNode.id = 'Price_Selll' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'Price_Sell" + a + "\' readonly  name=\"Price_Sell[]\"\n" +
            "class=\"form-control Price_Sell\"/>" +
            "</div></div></div>";
        document.getElementById('Price_Selll').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'Weightt' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'Weight" + a + "\' readonly  name=\"Weight[]\"\n" +
            "class=\"form-control Weight\"/>" +
            "</div></div></div>";
        document.getElementById('Weightt').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'Taxx' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<input type=\"text\" id=\'Tax" + a + "\' readonly  name=\"Tax[]\"\n" +
            "class=\"form-control tax\"/>" +
            "</div></div></div>";
        document.getElementById('Taxx').appendChild(myNode);


        var myNode = document.createElement('div');
        myNode.id = 'actiont' + a;
        myNode.innerHTML += "<div class='form-group'>" +
            "<button onclick='deleteService2(" + a + ", event)' class=\"form-control btn btn-danger\"><i class=\"fa fa-remove\"></button></div>";
        document.getElementById('actiont').appendChild(myNode);


        $('#number' + a + ',#sell' + a + '')
            .keyup(function () {
                var selll = parseInt($('#sell' + a + '').val());
                var number = parseInt($('#number' + a + '').val());
                $('#Price_Sell' + a + '').val(selll * number);
                if ($('#InvoiceType').val() == 1) {
                    var s = parseFloat($('#Price_Sell' + a + '').val() * all_setting[i].Tax / 100) + parseFloat($('#Price_Sell' + a + '').val());
                    $('#Tax' + a + '').val(s - $('#Price_Sell' + a + '').val());
                    tax();
                    totalfinal();
                } else {
                    var sum = parseFloat($('#Price_Sell' + a + '').val());
                    $('#Tax' + a + '').val('0');
                    tax();
                    totalfinal();
                }

            })
            .keyup();


        $('#sell' + a + '')
            .keyup(function () {
                $(".sell").each(function () {
                    $(this).keyup(function () {
                        calculateSum();
                        numberSum();
                        Price_SellSum();
                        Wigt();
                    });
                });
            })
            .keyup();


        $('#number' + a + '')
            .keyup(function () {
                $(".number").each(function () {
                    $(this).keyup(function () {
                        numberSum();
                        Price_SellSum();
                        Wigt();

                    });
                });

                var id = $('#product' + a + '').val();
                for (var i in all_modelProducts) {
                    if (all_modelProducts[i].product_id === id) {
                        var number = parseInt($('#number' + a + '').val());
                        $('#Weight' + a + '').val(all_modelProducts[i].size * number);
                    }
                }
            })
            .keyup();


        $('#InvoiceType')
            .change(function () {
                if ($('#InvoiceType').val() == 1) {
                    var s = parseFloat($('#Price_Sell' + a + '').val() * all_setting[i].Tax / 100) + parseFloat($('#Price_Sell' + a + '').val());
                    $('#Tax' + a + '').val(s - $('#Price_Sell' + a + '').val());
                    tax();
                    totalfinal();
                } else {
                    $('#Tax' + a + '').val('0');
                    tax();
                    totalfinal();
                }

            })
            .change();


        $('#product' + a + '')
            .change(function () {
                var id = $('#product' + a + '').val();
                for (var i in all_modelProducts) {
                    if (all_modelProducts[i].product_id == id) {
                        var number = parseInt($('#number' + a + '').val());
                        $('#Weight' + a + '').val(all_modelProducts[i].size * number);
                        Wigt();


                    }


                }


            })
            .change();

        $('#product' + a + '')
            .change(function () {
                var id = $('#product' + a + '').val();
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.product.price')}}?id=" + id,
                    success: function (res) {

                        if (res) {

                            if (res.product) {
                                $('#type' + a + '').empty();
                                $.each(res.product, function (key, value) {
                                    $('#type' + a + '').append('<option value="' + value.id + '">' + value.title + '</option>');
                                });

                            } else {
                                $('#type' + a + '').empty();
                            }


                            $('#sell' + a + '').val(res.id.price);
                            var selllll = parseInt($('#sell' + a + '').val());
                            var numberrr = parseInt($('#number' + a + '').val());
                            $('#Price_Sell' + a + '').val(selllll * numberrr);
                            $('#Tax' + a + '').val(parseFloat($('#Price_Sell' + a + '').val() * all_setting[i].Tax / 100) + parseFloat($('#Price_Sell' + a + '').val()));
                            tax();
                            calculateSum();
                            numberSum();
                            Price_SellSum();

                        } else {

                        }
                    }
                });


            })
            .change();


    }

    function deleteService2(id, event) {
        event.preventDefault();
        $('#productt' + id).remove();
        $('#color' + id).remove();
        $('#selll' + id).remove();
        $('#numberr' + id).remove();
        $('#Taxx' + id).remove();
        $('#Price_Selll' + id).remove();
        $('#Weightt' + id).remove();
        $('#actiont' + id).remove();

        tax();
        totalfinal();
        calculateSum();
        numberSum();
        Price_SellSum();
        Wigt();

    }

    $('#takhfif')
        .keyup(function () {
            totalfinal();
        })
        .keyup();


    $('#expenses')
        .keyup(function () {
            totalfinal();
        })
        .keyup();

    $('#Carry')
        .keyup(function () {
            totalfinal();
        })
        .keyup();

    $('#paymentMethod')
        .change(function () {
            totalfinal();
        })
        .change();


    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    function calculateSum() {

        var sum = 0;
        $(".sell").each(function () {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
        $("#sum_sell").text(formatNumber(sum) + 'ریال');
        $("#average_sell").text(formatNumber(sum / 2) + 'ریال');
        $('#sum_selll').val(sum);
    }

    function numberSum() {
        var sum = 0;
        $(".number").each(function () {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
        $("#number_sell").text(sum + 'عدد');
        $("#average_number").text(sum / 2 + 'عدد');
        $('#number_selll').val(sum);
    }

    function Price_SellSum() {

        var sum = 0;
        $(".Price_Sell").each(function () {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
        $("#price_sell").text(formatNumber(sum) + 'ریال');
        $("#average_price").text(formatNumber(sum / 2) + 'ریال');
        $('#price_selll').val(sum);
    }

    function Wigt() {

        var sum = 0;
        $(".Weight").each(function () {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
        $("#Weight").text(formatNumber(sum / 1000 + 'کیلوگرم'));
        $("#average_Weight").text(formatNumber((sum / 2) / 1000 + 'کیلوگرم'));
    }

    function tax() {

        var sum = 0;
        var t = 0;
        $(".tax").each(function () {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseInt(this.value);
            }
        });
        $('#ma').val(sum);
        $("#tax").text(formatNumber(sum) + 'ریال');
        $("#average_tax").text(formatNumber(t / 2) + 'ریال');
        $("#price_full").val(sum);
    }

    function totalfinal() {
        var sum = 0;
        var total = 0;
        var takhfif = $('#takhfif').val();
        var expenses = $('#expenses').val();
        var Carry = $('#Carry').val();
        $(".Price_Sell").each(function () {
            if (!isNaN(this.value) && this.value.length != 0) {
                total += parseFloat(this.value);
            }
        });
        $(".tax").each(function () {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseInt(this.value);
            }
        });
        var o = total * takhfif / 100;
        var v = total - o;
        $('#price_f').val(Number(v) + Number(sum) + Number(expenses) + Number(Carry));
        $('#taa').val(o);
        $('#ta').text(formatNumber(o) + ' ' + 'ریال');
        $('#totalfinal').text(formatNumber(Number(v) + Number(sum) + Number(expenses) + Number(Carry)) + ' ' + ' ریال ');
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
<script>
    kamaDatepicker('created',
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
