<?php
include_once 'utils2.php';
?>

<script type="text/javascript">
    $(function () {
        $('#toggle-percentage').hide();
        send();


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