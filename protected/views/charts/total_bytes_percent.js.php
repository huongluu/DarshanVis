<?php
include_once 'utils2.php';



$merged_query = $chart["query"]["merged_query"];

$orderby = "sum_bytes";
$data = Jobs::execSQLQuery($merged_query);


$series_str = array();

$categories = array();

$attr_count = 7;
//initialize strings for the attribute series
for ($i = 1; $i <= $attr_count; $i++) {
    // var_dump($chart["series"][0]["attr" . $i]);
    if (!isset($series_str[$i])) {
        $series_str[$i] = "";
    }
    if (!isset($cat_str[$i])) {
        $cat_str[$i] = "";
    }
}

$i = 1;
$index = 1;
//var_dump($data[$i]);
foreach ($data as $each_data) {

    if (($each_data['less_than_one_giga'] == null && $each_data['one_giga_to_ten_giga'] == null && $each_data['ten_to_hundred_giga'] == null && $each_data['hundred_to_tera'] == null && $each_data['more_than_tera'] == null) || $each_data['max'] == 0 || $each_data['median'] == 0)
        continue;
    else {
        $categories[] = $each_data["appname"];
        for ($i = 1; $i <= 7; $i++) {
            if ($each_data[$chart["series"][0]["attr" . $i]] === null)
                $each_data[$chart["series"][0]["attr" . $i]] = '0';
            $cat_str[$i] .= '\'' . $index . '\'' . ',';
            $series_str[$i] .= $each_data[$chart["series"][0]["attr" . $i]] . ',';
        }
        $index++;
    }
}

//  $index=1;
//  foreach ($median as $each_data)
//  {
//      //echo $i.'\n';
//      //echo $chart["series"][0]["attr".$i];
// if($each_data['less_than_one_giga']==null && $each_data['one_giga_to_ten_giga']==null && $each_data['ten_to_hundred_giga']==null && $each_data['hundred_to_tera']==null &&$each_data['more_than_tera']==null )
//          continue;
//  else
//  {
//      if($each_data[  $chart["series"][0]["attr".'6']  ]==null  )
//          $each_data[  $chart["series"][0]["attr".'6']  ]='0';
//           $cat_str[6] .= '\'' . $index . '\'' . ',';
//      $series_str[6] .= $each_data[  $chart["series"][0]["attr".'6']  ]. ',';
//      $index++;
//  }
//  }
//  $cat_str[6] = rtrim($cat_str[6], ",");
//      $series_str[6] = rtrim($series_str[6], ",");
//  $index=1;
//  foreach ($max as $each_data)
//  {
//      //echo $i.'\n';
//      //echo $chart["series"][0]["attr".$i];
//  if($each_data['less_than_one_giga']==null && $each_data['one_giga_to_ten_giga']==null && $each_data['ten_to_hundred_giga']==null && $each_data['hundred_to_tera']==null &&$each_data['more_than_tera']==null )
//          continue;
//  else{
//      if($each_data[  $chart["series"][0]["attr".'7']  ]==null  )
//          $each_data[  $chart["series"][0]["attr".'7']  ]='0';
//           $cat_str[7] .= '\'' . $index . '\'' . ',';
//       $series_str[7] .= $each_data[  $chart["series"][0]["attr".'7']  ]. ',';
//      $index++;
//      }
//  }
//  $cat_str[7] = rtrim($cat_str[7], ",");
//      $series_str[7] = rtrim($series_str[7], ",");



for ($i = 1; $i <= 7; $i++) {
    # code...
    $cat_str[$i] = rtrim($cat_str[$i], ",");
    $series_str[$i] = rtrim($series_str[$i], ",");
}






//$categories = rtrim($categories, ",");
//$categories .= ']';
$chart["highchart-confs"]["xAxis"]["categories"] = $categories;
//var_dump($chart["highchart-confs"]["xAxis"]);
//    $cats_str .= '\'' . $d[$chart["xAxis"]["attribute"]] . '\'' . ',';
//    $series_str .= '[' . $d[$chart["series"][0]["min"]] . ',' . ($d[$chart["series"][0]["q1"]] * 2) . ',' . $d[$chart["series"][0]["median"]] . ',' . ($d[$chart["series"][0]["q3"]] * 0.5) . ',' . $d[$chart["series"][0]["max"]] . '],';
//$cats_str = rtrim($cats_str, ",");
// for ($i = 1; $i <= $attr_count; $i++) {
//     $series_str[$chart["series"][0]["attr" . $i]] = rtrim($series_str[$chart["series"][0]["attr" . $i]], ",");
// }
//var_dump($series_str);
?>

<script type="text/javascript">
    $(function () {
        $('#tooltip1').tooltip({
            title:
                    'Non-global data I/O: The amount of time this job spent in function calls to read/write its files not accessed by all processes.'
        });
        $('#tooltip2').tooltip({
            title:
                    'Non-global Metadata: The amount of time this job spent in metadata function calls (open, close, seek, etc.) for non-global files, i.e., files that one or more but not all processes opened.'
        });
        $('#tooltip3').tooltip({
            title:
                    'Global data I/O: The amount of time this job spent in function calls to read/write global files, i.e., files that all processes opened.'
        });
        $('#tooltip4').tooltip({
            title:
                    'Global Metadata: The amount of time this job spent in metadata function calls (open, close, seek, etc.) for global files, i.e., files that all processes opened.'
        });
        $('#tooltip5').tooltip({
            title:
                    'Not I/O: The amount of time this job spent outside of I/O function calls (data and metadata).'
        });
        $('#tooltip6').tooltip({
            title:
                    '# of Processes: The number of processes this job had.'
        });
        $('#tooltip7').tooltip({
            title:
                    'Total Bytes Read/Written: The total number of bytes this job read and wrote.'
        });


        $('#chart-container').highcharts({
<?php echo getHighchartSafeJson($chart["highchart-confs"]); ?>



            series: [{
                    name: '<?php echo $chart["series"][0]["title1"] ?>',
                    type: 'column',
                    color: '#00CCFF',
                    stacking: 'percent',
                    index: 4,
//                    yAxis: 1,
                    data: [<?php echo nullSafe($series_str[1]); ?>]
                },
                {
                    name: '<?php echo $chart["series"][0]["title2"] ?>',
                    type: 'column',
                    color: '#33CC00',
                    stacking: 'percent',
                    index: 3,
//                    yAxis: 1,
                    data: [<?php echo nullSafe($series_str[2]); ?>]
//                    tooltip: {
//                        valueSuffix: ' mm'
//                    }
                },
                {
                    name: '<?php echo $chart["series"][0]["title3"] ?>',
                    type: 'column',
                    color: '#FFFF00',
                    stacking: 'percent',
                    index: 2,
//                    yAxis: 1,
                    data: [<?php echo nullSafe($series_str[3]); ?>]
                },
                {
                    name: '<?php echo $chart["series"][0]["title4"] ?>',
                    type: 'column',
                    color: '#FF6600',
                    stacking: 'percent',
                    index: 1,
//                    yAxis: 1,
                    data: [<?php echo nullSafe($series_str[4]); ?>]
                },
                {
                    name: '<?php echo $chart["series"][0]["title5"] ?>',
                    type: 'column',
                    color: '#F00000',
                    stacking: 'percent',
                    index: 0,
//                    yAxis: 1,
                    data: [<?php echo nullSafe($series_str[1]); ?>]
                },
                {
                    name: '<?php echo $chart["series"][0]["title6"] ?>',
                    type: 'scatter',
                    yAxis: 1,
                    data: [<?php echo $series_str[6]; ?>],
                    lineWidth: 0,
                    visible: true,
                    marker: {
                        symbol: 'diamond',
                        enabled: true,
                        radius: 3,
                        fillColor: '#0033FF'
                    },
                    dashStyle: 'shortdot'
                },
                {
                    name: '<?php echo $chart["series"][0]["title7"] ?>',
                    type: 'scatter',
                    lineWidth: 0,
                    visible: true,
                    marker: {
                        symbol: 'circle',
                        enabled: true,
                        fillColor: '#000033',
                        radius: 3
                    },
                    yAxis: 1,
                    data: [<?php echo $series_str[7] ?>],
                }]
        });

        var chart = $('#chart-container').highcharts();
        var color = false;

        var stacking = false;
        chart.yAxis[0].setExtremes(0, 100);
        console.log(">>>>>>>>>>>");
        console.log(chart);


        var category = {
            "1KB/s": 1024,
            "32KB/s": 32768,
            "1MB/s": 1048576,
            "32MB/s": 33554432,
            "1GB/s": 1073741824,
            "32GB/s": 34359738368,
            "1TB/s": 1099511627776
        };

//        chart.yAxis[1].labels.formatter = function () {
//
//            return categoryLinks[this.value];
//        }




// Toggle abs/%
        $('#toggle-percentage').click(function () {

            for (var i = 0; i < 5; i++) {
                chart.series[i].update({
                    stacking: stacking ? "normal" : "percent"
                });
            }

//            chart.yAxis[0].labels.update({
//                format: stacking ? "{value}" : "{value}%"
//            });

            chart.yAxis[0].axisTitle.attr({
                text: stacking ? "Distribution of time (s)" : "Percentage of time (%)"
            });
            if (!stacking) {
                chart.yAxis[0].setExtremes(0, 100);
            } else {
                chart.yAxis[0].setExtremes(null, null);
            }
            stacking = !stacking;
//            chart.series[0].update({
//                color: color ? null : Highcharts.getOptions().colors[1]
//            });
//            color = !color;

        });
        var chart = $("#chart-container").highcharts();
        var max = findMax(chart)

        // chart.yAxis[0].tickInterval = 25;
        chart.yAxis[0].max = 100;

    });

    findMax = function (chart)
    {
        var max = 0;
        for (var i = 0; i < chart.yAxis[0].series.length; i++)
        {
            for (var x = 0; x < chart.yAxis[0].series[i].data.length; x++)
            {
                max = (max < chart.yAxis[0].series[i].data[x]) ? chart.yAxis[0].series[i].data[x] : max;
            }
        }
        return (max < 100) ? 100 : max;
    }
</script>
