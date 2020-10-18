<style>
    body {
        font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
        background-color: #fff;
    }

    div.container {
        min-width: 980px;
        margin: 0 auto;
    }

    /** Hide console */
    .as-console-wrapper {
        display: none !important;
    }
</style>

<title>TODO supply a title</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="//cdn.mcfcloud.com/jquery-1.11.2/external/jquery/jquery.js"></script>
<link href="//datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
<script src="//datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="//cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script>

    <table id="example" class="display">
    </table>

<script>
    $(document).ready( function () {
        var data = [
            ['1', 'David', 'Maths', '80'],
            ['1', 'David', 'Physics', '90'],
            ['3', 'a', 'Computers', '70'],
            ['3', 'b', 'Computers', '70'],
            ['2', 'Alex', 'Maths', '80'],
            ['2', 'Alex', 'Maths', '80'],
            ['2', 'Alex', 'Physics', '70'],
            ['4', 'Alex', 'Computers', '90'],
        ];
        var table = $('#example').DataTable({
            columns: [
                {
                    name: 'first',
                    title: 'ID',
                },
                {
                    name: 'second',
                    title: 'Name',
                },
                {
                    title: 'Subject',
                },
                {
                    title: 'Marks',
                },
            ],
            data: data,
            rowsGroup: [
                0,1
            ],
            pageLength: '20',
        });
    } );
</script>

