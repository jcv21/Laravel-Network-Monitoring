<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title><?php echo e($data['title']); ?></title>

    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script src="https://www.google.com/jsapi"></script>

    <style>

        .line-chart {
            width: 600px;
            height: 400px;
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

  

<h2 class="text-center"><?php echo e($data['title']); ?></h2>
<div class="date-container">
    <b>Date:</b> <?php echo e($data['date_from']); ?> - <?php echo e($data['date_to']); ?>

</div>
  
<div class="row">
    <div id="chartDiv" class="line-chart"></div>
    <div id="chartDiv2" class="line-chart"></div>
</div>
<div class="row" id="second_charts" style="display: none;">
    <div id="chartDiv3" class="line-chart"></div>
    <div id="chartDiv4" class="line-chart"></div>
</div>
  
<div class="text-center">
    <form action="<?php echo e(route('download')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <input type="hidden" id="report_name" name="report_name" value="<?php echo e($data['title']); ?>">
        <input type="hidden" name="report_start_date" id="report_start_date" value="<?php echo e($data['date_from']); ?>">
        <input type="hidden" name="report_end_date" id="report_end_date" value="<?php echo e($data['date_to']); ?>">
        <input type="hidden" name="InputSDate" id="InputSDate" value="<?php echo e($data['InputSDate']); ?>">
        <input type="hidden" name="InputEDate" id="InputEDate" value="<?php echo e($data['InputEDate']); ?>">
        <input type="hidden" name="InputReportType" id="InputReportType" value="<?php echo e($data['type']); ?>">
        <button type="submit" name="btnSubmitPDF" id="btnSubmitPDF" class="btn_submit">
            Download PDF File
        </button>
    </form>
    <form action="<?php echo e(route('report')); ?>" method="GET">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn_main_menu">Back to Main Menu</button>
    </form>
</div>


<script type="text/javascript">

    window.onload = function() {

        var data_type = <?php echo json_encode($data['type'], JSON_PRETTY_PRINT, 512) ?>;
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
        var incoming_packets = <?php echo json_encode($data['incoming_packets'], 15, 512) ?>;
        var outgoing_packets = <?php echo json_encode($data['outgoing_packets'], 15, 512) ?>;
        var incoming_bytes = <?php echo json_encode($data['incoming_bytes'], 15, 512) ?>;
        var outgoing_bytes = <?php echo json_encode($data['outgoing_bytes'], 15, 512) ?>;
        
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
        var download = <?php echo json_encode($data['dowload_bandwidth'], JSON_PRETTY_PRINT, 512) ?>;
        var upload = <?php echo json_encode($data['upload_bandwidth'], JSON_PRETTY_PRINT, 512) ?>;

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
<?php /**PATH /var/www/html/eyenet/resources/views/report_pdf.blade.php ENDPATH**/ ?>