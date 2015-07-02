<?php
$data = Jobs::execSQLQuery($chart["series"][0]["query"]);
//print_r($data);
$cats_str = "";
$series_str = "";

foreach ($data as $d) {
    $cats_str .= '\'' . $d[$chart["xAxis"]["attribute"]] . '\'' . ',';
    $series_str .= '[' . $d[$chart["series"][0]["min"]] . ',' . ($d[$chart["series"][0]["q1"]] * 2) . ',' . $d[$chart["series"][0]["median"]] . ',' . ($d[$chart["series"][0]["q3"]] * 0.5) . ',' . $d[$chart["series"][0]["max"]] . '],';
}
$cats_str = rtrim($cats_str, ",");
$series_str = rtrim($series_str, ",");
//echo $series_str;
?>
<script type="text/javascript">
    $(function() {
        $('#chart-container').highcharts({
            chart: {
                type: 'boxplot'
            },
            title: {
                text: '<?php echo $chart["title"] ?>'
            },
            legend: {
                enabled: false
            },
            xAxis: {
                categories: [<?php echo $cats_str ?>],
                title: {
                    text: '<?php echo $chart["xAxis"]["title"] ?>'
                }
            },
            yAxis: {
                type: 'logarithmic',
                title: {
                    text: '<?php echo $chart["yAxis"]["title"] ?>'
                }
            },
            series: [{
                    name: 'Job Size',
                    data: [
                       <?php echo $series_str; ?>
                    ],
                    tooltip: {
                        headerFormat: '<em>Application {point.key}</em><br/>'
                    },
                    fillColor:  '#99CCFF'
                }]

        });
    });
</script>