<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>{{ $data['title'] }}</title>

    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script src="https://www.google.com/jsapi"></script>

    <style>
        .line-chart {
            width: 400px;
            height: 300px;
            margin: 0 auto;
        }

        .text-center{
            text-align: center;
        }

        .date-container{
            text-align: center;
        }

        .btn_submit{
            background-color: navy;
            border: 1px navy; 
            color: #fff;
            padding: 10px 8px;
            box-shadow: 0 4px 7px rgba(0, 0, 0, 0.137);
            cursor: pointer;
        }

        .btn_submit:hover{
            background-color: rgba(0, 0, 128, 0.671);
        }

        .btn_main_menu{
            background-color: rgb(0, 89, 255);
            border: 1px rgb(0, 89, 255); 
            color: #fff;
            padding: 10px 8px;
            cursor: pointer;
            box-shadow: 0 4px 7px rgba(0, 0, 0, 0.137);
            text-decoration: none;
            margin: 5px;
        }

        .btn_main_menu:hover{
            background-color: rgb(65, 126, 240);
        }

        .row{
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }
    </style>

</head>

<body>

  

<h2 class="text-center">{{ $data['title'] }}</h2>
<div class="date-container">
    <b>Date:</b> {{ $data['date_from'] }} - {{ $data['date_to'] }}
</div>
  
<div class="row">
    <div id="chartDiv" class="line-chart"></div>
    <div id="chartDiv2" class="line-chart"></div>
</div>
<div class="row" id="second_charts" style="display: none;">
    <div id="chartDiv3" class="line-chart"></div>
    <div id="chartDiv4" class="line-chart"></div>
</div>



<script type="text/javascript">

    window.onload = function() {

        var data_type = @json($data['type'], JSON_PRETTY_PRINT);
        var type = JSON.parse(data_type);

        if(type == 1){
            google.load("visualization", "1.1", {
                packages: ["corechart"],

                callback: 'bandwidth'
            });
        }else if(type == 2){
            $("#second_charts").css("display", "flex");

            google.load("visualization", "1.1", {
                packages: ["corechart"],

                callback: 'traffic'
            });
        }

    };

    function traffic() {
        var incoming_packets = @json($data['incoming_packets']);
        var outgoing_packets = @json($data['outgoing_packets']);
        var incoming_bytes = @json($data['incoming_bytes']);
        var outgoing_bytes = @json($data['outgoing_bytes']);
        
        var in_packets = new google.visualization.DataTable();
        var out_packets = new google.visualization.DataTable();
        var in_bytes = new google.visualization.DataTable();
        var out_bytes = new google.visualization.DataTable();

        in_packets.addColumn('date', 'Incoming Date');
        in_packets.addColumn('number', 'Incoming Packets');

        $.each(incoming_packets, function(i,val){
            in_packets.addRows([
                [new Date(val.dtime_in), val.in_packets]
            ]);
        });

        in_bytes.addColumn('date', 'Incoming Date');
        in_bytes.addColumn('number', 'Incoming Bytes');

        $.each(incoming_bytes, function(i,val){
            in_bytes.addRows([
                [new Date(val.dtime_in), val.in_bytes]
            ]);
        });

        out_bytes.addColumn('date', 'Outgoing Date');
        out_bytes.addColumn('number', 'Ougoing Bytes');

        $.each(outgoing_bytes, function(i,val){
            out_bytes.addRows([
                [new Date(val.dtime_out), val.out_bytes]
            ]);
        });

        out_packets.addColumn('date', 'Outgoing Date');
        out_packets.addColumn('number', 'Ougoing Packets');

        $.each(outgoing_packets, function(i,val){
            out_packets.addRows([
                [new Date(val.dtime_out), val.out_packets]
            ]);
        });


        var options = {
            title: 'Incoming Packets',
            sliceVisibilityThreshold: .2
        };

        var options2 = {
            title: 'Outgoing Packets',
            sliceVisibilityThreshold: .2
        }

        var options3 = {
            title: 'Incoming Bytes',
            sliceVisibilityThreshold: .2
        };

        var options4 = {
            title: 'Outgoing Bytes',
            sliceVisibilityThreshold: .2
        }

        var chart = new google.visualization.LineChart(document.getElementById('chartDiv'));
        var chart2 = new google.visualization.LineChart(document.getElementById('chartDiv2'));
        var chart3 = new google.visualization.LineChart(document.getElementById('chartDiv3'));
        var chart4 = new google.visualization.LineChart(document.getElementById('chartDiv4'));
        chart.draw(in_packets, options);
        chart2.draw(out_packets, options2);
        chart3.draw(in_bytes, options);
        chart4.draw(out_bytes, options2);

    }

    function bandwidth() {
        var download = @json($data['dowload_bandwidth'], JSON_PRETTY_PRINT);
        var upload = @json($data['upload_bandwidth'], JSON_PRETTY_PRINT);

        var data = new google.visualization.DataTable();
        var upload_table = new google.visualization.DataTable();

        data.addColumn('date', 'Date');
        data.addColumn('number', 'Download Bandwidth');

        upload_table.addColumn('date', 'Date');
        upload_table.addColumn('number', 'Upload Bandwidth');


        $.each(download, function(i,val){
            data.addRows([
                [new Date(val.dtime), val.bandwidth_donwld]
            ]);
        });

        $.each(upload, function(i,val){
            upload_table.addRows([
                [new Date(val.dtime), val.bandwidth_upload]
            ]);
        });


        var options = {

            title: 'Download Bandwidth',

            sliceVisibilityThreshold: .2

        };

        var options2 = {

            title: 'Upload Bandwidth',

            sliceVisibilityThreshold: .2

        };

        var chart = new google.visualization.LineChart(document.getElementById('chartDiv'));
        var chart2 = new google.visualization.LineChart(document.getElementById('chartDiv2'));

        chart.draw(data, options);
        chart2.draw(upload_table, options2);
    }


</script>

  

</body>

</html>
