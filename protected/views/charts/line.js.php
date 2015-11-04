<?php
include_once 'utils2.php';
?>

<script type="text/javascript">
    $(function () {
        $('#toggle-percentage').hide();
        send();


        $('#chart-container').highcharts({
<?php echo getHighchartSafeJson($chart["highchart-confs"]); ?>

            series: []
        });

        var chart = $('#chart-container').highcharts();
//        console.log(">>>>>>>>>>>>>>>>>>>>>>." + chart.yAxis[0]);
        console.log(chart.yAxis[0]);
        chart.yAxis[0].labelFormatter = function () {
            return byte_formatter(this, "/s");
        }
    });
</script>