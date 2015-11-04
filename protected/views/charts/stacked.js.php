<?php
$data = Jobs::execSQLQuery($chart["series"][0]["query"]);

$cat_str = "";
$series_str = "";
$index = 1;
foreach ($data as $d) {
    $cat_str .= '\'' . $index . '\'' . ',';
    $series_str .= $d[$chart["series"][0]["attribute"]] . ',';
    $index++;
}
$cat_str = rtrim($cat_str, ",");
$series_str = rtrim($series_str, ",");
?>

<script type="text/javascript">
    $(function () {
        $('#chart-container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '<?php echo $chart["title"] ?>'
            },
            subtitle: {
                text: '<?php echo $chart["subtitle"] ?>'
            },
            xAxis: {
                title: {
                    text: '<?php echo $chart["xAxis"]["title"] ?>'
                },
                categories: [<?php echo $cat_str; ?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: '<?php echo $chart["yAxis"]["title"] ?>'
                }
            },
            tooltip: {
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                shared: true
            },
            plotOptions: {
                column: {
                    stacking: 'percent'
                }
            },
            series: [{
                    name: 'Perf < 1 GB/s',
                    data: [5, 3, 4]
                }, {
                    name: 'Perf = 1 GB/s - 5 GB/s',
                    data: [2, 2, 3]
                }, {
                    name: 'Perf > 5 GB/s',
                    data: [3, 4, 4]
                }]
        });
    });
</script>