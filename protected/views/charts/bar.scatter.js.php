<?php
include_once 'utils2.php';
?>
<script type="text/javascript">

    $(function () {
        //        $("#tooltip1").tooltip('show');
        //        $('[data-toggle="tooltip"]').tooltip();
        var globalCallback = function (chart) {
            // Specific event listener
            Highcharts.addEvent(chart.container, 'click', function (e) {
                e = chart.pointer.normalize();
                console.log('Clicked chart at ' + e.chartX + ', ' + e.chartY);
            });
            // Specific event listener
            Highcharts.addEvent(chart.xAxis[0], 'afterSetExtremes', function (e) {
                console.log('Set extremes to ' + e.min + ', ' + e.max);
            });
            Highcharts.addEvent(chart, 'load', function (e) {
                //                e = chart.pointer.normalize();
                console.log('loaded');
                var chart = this,
                        legend = chart.legend;
                for (var i = 0, len = legend.allItems.length; i < len; i++) {
                    (function (i) {
                        var item = legend.allItems[i].legendItem;
                        item.on('mouseover', function (e) {
                            //show custom tooltip here
                            console.log("mouseover" + i);
                            //                            $('#tooltips').tooltip();
                            $("#tooltip" + (i + 1)).tooltip('show');
                        }).on('mouseout', function (e) {
                            //hide tooltip
                            console.log("mouseout" + i);
                            $("#tooltip" + (i + 1)).tooltip('hide');
                        });
                    })(i);
                }
            });
        }

        // Add `globalCallback` to the list of highcharts callbacks
        Highcharts.Chart.prototype.callbacks.push(globalCallback);
        console.log($('#chart-container'));
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

                console.log(chart.yAxis[0]);
                console.log("set min and max to 0 and 100");
            } else {
//                chart.yAxis[0].setExtremes(null, null);
                chart.yAxis[0].update({
                    max: null,
                    min: null
                });
                console.log(chart.yAxis[0]);
                console.log("set min and max to null and null");
            }
            stacking = !stacking;
            //            chart.series[0].update({
            //                color: color ? null : Highcharts.getOptions().colors[1]
            //            });
            //            color = !color;
            chart.redraw();
        });

    });
</script>
