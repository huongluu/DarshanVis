<?php
include_once 'utils2.php';
?>

<script type="text/javascript">
    $(function () {
        $('#toggle-percentage').hide();
        send();
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


        $('#chart-container').highcharts({
            <?php echo getHighchartSafeJson($chart["highchart-confs"]); ?>

            series: [],
            tooltip: {
                backgroundColor: {
                linearGradient: [0, 0, 0, 100],
                stops: [
                    [0, '#FFFFFF'],
                    [1, '#E0E0E0']
                ]
            },
            borderWidth: 1,
            borderColor: '#AAA',    
            formatter: function() {
                 var output=byte_formatter(this.y, "/s");
                   return this.y+"value is "+output ;
                }

            }
        });

        var chart = $('#chart-container').highcharts();
//        console.log(">>>>>>>>>>>>>>>>>>>>>>." + chart.yAxis[0]);
        console.log(chart.yAxis[0]);
        chart.yAxis[0].labelFormatter = function () {
            return byte_formatter(this, "/s");
        }
    });
</script>