<script src="{{asset('/public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript">
    $('#commodity').change(function () {
        var commodityID = $(this).val();
        if (commodityID) {
            $.ajax({
                type: "GET",
                url: "{{route('admin.list.product')}}?commodity_id=" + commodityID,
                success: function (res) {
                    if (res) {
                        $("#characteristic").empty();
                        $("#characteristic").append('<option>مشخصه محصول را انتخاب کنید</option>');
                        $.each(res, function (key, value) {
                            $("#characteristic").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {
                        $("#characteristic").empty();
                    }
                }
            });
        } else {
            $("#characteristic").empty();
        }
    });
</script>
<script type="text/javascript">
    $('#commodity_i').change(function () {
        var commodityID = $(this).val();
        if (commodityID) {
            $.ajax({
                type: "GET",
                url: "{{route('admin.list.product')}}?commodity_id=" + commodityID,
                success: function (res) {
                    if (res) {
                        $("#characteristic_i").empty();
                        $("#characteristic_i").append('<option>مشخصه محصول را انتخاب کنید</option>');
                        $.each(res, function (key, value) {
                            $("#characteristic_i").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {
                        $("#characteristic_i").empty();
                    }
                }
            });
        } else {
            $("#characteristic_i").empty();
        }
    });
</script>
