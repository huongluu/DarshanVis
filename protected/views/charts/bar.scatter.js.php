<?php
include_once 'utils2.php';
?>
<script type="text/javascript">

    $(function () {

//        console.log($('#chart-container'));
        $('#chart-container').highcharts({
<?php echo getHighchartSafeJson($chart["highchart-confs"]); ?>

            series: []
        });

        var chart = $('#chart-container').highcharts();
        var color = false;
        var stacking = false;
        console.log(">>>>>>>>>>>");
        console.log(chart);

        chart.yAxis[2].labelFormatter = function () {
            return byte_formatter(this, "/s");
        }


        // Toggle abs/%
        $('#toggle-percentage').click(function () {
            for (var i = 0; i < 5; i++) {
                chart.series[i].update({
                    stacking: stacking ? "normal" : "percent"
                });
            }

            chart.yAxis[0].axisTitle.attr({
                text: stacking ? "Distribution of time (s)" : "Percentage of time (%)"
            });

            if (!stacking) {
                chart.yAxis[0].setExtremes(0, 100);
            } else {
                chart.yAxis[0].setExtremes(null, null);
            }
            stacking = !stacking;
            chart.redraw();
        });

    });
</script>
