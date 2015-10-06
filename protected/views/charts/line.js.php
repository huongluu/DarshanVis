<?php
include_once 'utils2.php';  



// if (isset($_POST["application"]) && strlen($_POST["application"]) > 0) {
//     $q = Jobs::filter($q, "appname", $_POST["application"]);
// }


// $orderby = "start_time";
// if (isset($_POST["sort-level1"])) {
//     $orderby = $_POST["sort-level1"];
// }

// $mode1 = "desc";
// if (isset($_POST["mode-level1"])) {
// //    echo "set to ". $_POST["mode-level1"];
//     $mode1 = $_POST["mode-level1"];
// }


// $q = Jobs::OrderBy($q, $orderby, $mode1);
// $q = Jobs::Limit($q, 5000);

// if (isset($_POST["sort-level2"])) {
//     $sortlevel2 = $_POST["sort-level2"];
//     $mode2 = "desc";
//     if (isset($_POST["mode-level2"])) {
//         $mode1 = $_POST["mode-level2"];
//     }
//     $q = Jobs::addSortingLevel($q, $sortlevel2, $mode2);
// }

// if (isset($_POST["sort-level3"])) {
//     $sortlevel3 = $_POST["sort-level3"];
//     $mode3 = "desc";
//     if (isset($_POST["mode-level3"])) {
//         $mode1 = $_POST["mode-level3"];
//     }
//     $q = Jobs::addSortingLevel($q, $sortlevel3, $mode3);
// }


// if (isset($_POST["user"]) && strlen($_POST["user"]) > 0) {
//     $q = Jobs::filter($q, "uid", $_POST["user"]);
// }



$data1 = Jobs::execSQLQuery($chart["series"][0]["query1"]);
$data2= Jobs::execSQLQuery($chart["series"][0]["query2"]);








$cat_str = "";
$series_str = "";
$index = 1;
foreach ($data1 as $d) {
    $cat_str .= '\'' . $index . '\'' . ',';
    $series_str .= $d[$chart["series"][0]["attribute1"]] . ',';
    $index++;
}
$cat_str = rtrim($cat_str, ",");
$series_str = rtrim($series_str, ",");

$cat_str2 = "";
$series_str2 = "";
$index2 = 1;
foreach ($data2 as $d2) {
    $cat_str2 .= '\'' . $index2 . '\'' . ',';
    $series_str2 .= $d2[$chart["series"][0]["attribute2"]] . ',';
    $index2++;
}
$cat_str2 = rtrim($cat_str, ",");
$series_str2 = rtrim($series_str, ",");




//var_dump($series_str);
?>

<script type="text/javascript">
    $(function() {

        var globalCallback = function(chart) {
            // Specific event listener
            Highcharts.addEvent(chart.container, 'click', function(e) {
                e = chart.pointer.normalize();
                console.log('Clicked chart at ' + e.chartX + ', ' + e.chartY);
            });
            // Specific event listener
            Highcharts.addEvent(chart.xAxis[0], 'afterSetExtremes', function(e) {
                console.log('Set extremes to ' + e.min + ', ' + e.max);
            });
            Highcharts.addEvent(chart, 'load', function(e) {
//                e = chart.pointer.normalize();
                console.log('loaded');
                var chart = this,
                        legend = chart.legend;
                for (var i = 0, len = legend.allItems.length; i < len; i++) {
                    (function(i) {
                        var item = legend.allItems[i].legendItem;
                        item.on('mouseover', function(e) {
                            //show custom tooltip here
                            console.log("mouseover" + i);
//                            $('#tooltips').tooltip();
                            $("#tooltip" + (i + 1)).tooltip('show');
                        }).on('mouseout', function(e) {
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

            series: [{
                    name: '<?php echo $chart["series"][0]["title1"]; ?>',
                    data: [<?php echo $series_str ?>],

                },
                {
                    name: '<?php echo $chart["series"][0]["title2"]; ?>',
                    data: [<?php echo $series_str2 ?>],
                    color:'<?php echo $chart["series"][0]["color2"]; ?>'

                }

                ]
        });
    });
</script>