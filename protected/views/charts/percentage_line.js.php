<?php
$data = Jobs::execSQLQuery($chart["series"][0]["query"]);

$cat_str = "";
$series_str1 = "[0,0],";
$series_str2 = "";
$xseries_str = "";
$yseries_str1 = "";
$yseries_str2 ="";
$index = 1;
foreach ($data as $d) {
    //$cat_str .= '\'' . $index . '\'' . ',';
    $xseries_str = $d[$chart["series"][0]["xattribute"]] ;
    $yseries_str1 = $d[$chart["series"][0]["yattribute1"]] ;
    $yseries_str2 = $d[$chart["series"][0]["yattribute2"]] ;
    $series_str1 .= '['.$xseries_str.', '.$yseries_str1.']' . ',';
    $series_str2 .= '['.$xseries_str.', '.$yseries_str2.']' . ',';
    $index++;
}
//$cat_str = rtrim($cat_str, ",");
$series_str1 = rtrim($series_str1, ",");
$series_str2 = rtrim($series_str2, ",");
//echo $series_str2;
?>

<script type="text/javascript">
    $(function() {
        var percentage=true;
        var ready=true;
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
                type:"normal",
                min: 0,
                max: 1, 
                crosshair: true,
                labels: {
                    formatter: function(){
                        if(percentage)
                        {
                            return 100*this.value + '%';    
                        }
                        else
                        {
                            return this.value;
                        }
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
                    if (percentage)
                        return 'Percentage of <b> ' + this.x + '  </b>jobs so far is <b>' + roundSF(this.y*100, 4) + '</b> %';
                    else
                        return 'Cumulative IO time of <b> ' + this.x + '  </b>jobs so far is <b>' + roundSF(this.y,10) + '</b> Hours ';
                  
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
                    data: [<?php echo $series_str1 ?>]
                }]
        });

    var chart = $('#chart-container').highcharts();
        
    // Toggle abs/%
        $('#toggle-percentage').click(function () {

            if(ready)
            {
                ready=false;
                percentage = !percentage;

             
                //console.log(chart.yAxis[0]);
                console.log("lets get started percentage:"+percentage);

                if(percentage)
                {
                    chart.yAxis[0].update({
                    min: 0,
                    type: "normal"
                    });
                }
                else
                {
                   chart.yAxis[0].setExtremes( <?php echo $data[0][$chart["series"][0]["yattribute2"]]?>,<?php echo $data[0]["system_iotime"]?>);
           
                }

                    

                chart.series[0].update(
                {
                    data: percentage ? [<?php echo $series_str1 ?>] : [<?php echo $series_str2 ?>] ,
                });

                chart.xAxis[0].update({
                    min: percentage? 0:1
                }); 

                chart.yAxis[0].update({
                    min: percentage? 0:1,
                    type: percentage? "normal":"logarithmic"
                }); 

                chart.yAxis[0].axisTitle.attr(
               {
                text: percentage ? "Percentage of Total System I/O Time" : "Cumulative Total System I/O Time"
                });

                 

                
            
             if(percentage)
                {
                    chart.yAxis[0].setExtremes(0,1);
                }
                else
                {
                    chart.yAxis[0].setExtremes( <?php echo $data[0][$chart["series"][0]["yattribute2"]]?>,<?php echo $data[0]["system_iotime"]?>);
                }

               

                chart.redraw();
                ready=true;
            }
        });
    });
</script>