<?php
$data = Jobs::execSQLQuery($chart["series"][0]["query"]);

$cat_str = "";
$series_str = "[0,0],";
$xseries_str = "";
$yseries_str = "";
$index = 1;
foreach ($data as $d) {
    //$cat_str .= '\'' . $index . '\'' . ',';
    $xseries_str = $d[$chart["series"][0]["xattribute"]] ;
    $yseries_str = $d[$chart["series"][0]["yattribute"]] ;
    $series_str .= '['.$xseries_str.', '.$yseries_str.']' . ',';
    $index++;
}
//$cat_str = rtrim($cat_str, ",");
$series_str = rtrim($series_str, ",");
?>

<script type="text/javascript">
    $(function() {
        $('#chart-container').highcharts({
            chart: {
                type: 'line',
                zoomType: 'xy'
            },
            title: {
                text: '<?php echo $chart["title"] ?>',
                x: -20 //center
            },
            subtitle: {
                text: '<?php echo $chart["subtitle"] ?>',
                x: -20
            },
            xAxis: {
                title: {
                    enabled: true,
                    text: '<?php echo $chart["xAxis"]["title"] ?>'
                },
                min: 0,
                labels: {
                    formatter: function(){
                       return this.value;
                    }
                },
                crosshair: true

            },
            yAxis: {
                title: {
                    text: '<?php echo $chart["yAxis"]["title"] ?>'
                },
                plotLines: [{
                        value: 0,
                        width: 5,
                        color: '#808080'
                    }],
                min: 0,
                max: 1, 
                crosshair: true,
                labels: {
                    formatter: function(){
                        return 100*this.value + '%';
                    }
                },
            },
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
                     return 'Percentage of <b> ' + this.x + '  </b>apps so far is <b>' + (this.y*100) + '</b> %, in mira ';
                }

            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0,
                enabled: false 
            },
            series: [{
                    name: '<?php echo $chart["series"][0]["name"]; ?>',
                    data: [<?php echo $series_str ?>]
                }]
        });
    });
</script>