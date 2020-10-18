<!-- barcodegenerator.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <style>
        @media print {
            .control-group {
                display: none;
                content: " (" attr(href) ") ";

            }
        }
    </style>
</head>
<body onload="window.print()">
<br/>

<div class="row">

    <div class="col-md-12">
        <br/>

        @for($i = 0; $i < $print; $i++)

            <div class="col-xs-4">
                <img src="{{url($a)}}" width="200">
                <br/>
                <br/>
                <br/>
            </div>
        @endfor
    </div>
</div>

</body>
</html>
