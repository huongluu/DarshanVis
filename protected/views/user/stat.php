<style>
</style>
<?php
$query = Yii::app()->db->createCommand()
        ->select('f.fbid, f.name, p.seen, p.not_seen, (p.seen / (p.seen + p.not_seen)) percent')
        ->from('friend f, post p, user u')
        ->where('u.id=f.user and f.id=p.friend and p.category=8 and u.id=:userid', array(':userid' => $user->id))
        ->order('percent desc');
$data_seen = $query->queryAll();
$text = $query->text;

//echo $text . '<br>';

$cat = array();
$tooltip = array();
for ($i = 0; $i <= 100; $i+=10) {
    $cat[$i] = 0;
    $tooltip[$i] = "";
}
$friends1 = array();
$friends = array();
$percent1 = array();
$seen1 = array();
$not_seen1 = array();
foreach ($data_seen as $key => $value) {
    $friends1[] = '"' . $value['name'] . '"';
    $friends[] = $value['name'];
    $percent1[] = $value['percent'];
    $seen1[] = $value['seen'];
    $not_seen1[] = $value['not_seen'];
}

$max_line = 15;
for ($i = 0; $i < count($friends1); $i++) {
//    echo $friends1[$i] . " " . $percent1[$i] . " " . $seen1[$i] . " " . ($seen1[$i] + $not_seen1[$i]) . "<br>";
    if (($seen1[$i] >= 0) && ($not_seen1[$i] >= 0)) {
        if (!($seen1[$i] == 0 && $not_seen1[$i] == 0)) {
            $cat_id = floor($percent1[$i] * 10) * 10;
            $cat[$cat_id]++;
            if ($cat[$cat_id] <= $max_line)
                $tooltip[$cat_id].=$friends[$i] . " (" . $seen1[$i] . "/" . ($seen1[$i] + $not_seen1[$i]) . ") " . number_format($percent1[$i] * 100, 2) . "%<br>";
        }
    }
}

$data_str = array();

//echo 'Categories:<br>';
//foreach ($cat as $key => $value) {
//    echo $key . ' ' . $value . '<br>';
//    echo $tooltip[$key] . '<br>';
//}
foreach ($cat as $key => $value) {
    if ($value > $max_line) {
        $tooltip[$key] .= " and " . ($value - $max_line) . " more";
    }
}
foreach ($cat as $key => $value) {
    $data_str[$key] = "{y:" . $value . ",text:\"" . $tooltip[$key] . "\"}";
}
?>


<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Facebook Posts Histogram'
            },
            xAxis: {
                title: {
                    text: 'Seen/All (%)'
                },
                categories: [<?php echo implode(",", array_keys($cat)) ?>]//,
                //   labels: {
                //       rotation: 45,
                //       align : 'left'
                //   }
            },
            yAxis: {
                min: 0,
                allowDecimals: false,
                title: {
                    text: 'Number of Friends'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                useHTML: true,
                formatter: function() {
                    return '<b>'+ this.x +'%</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>' +
                        this.point.text;
                }
            },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
            series: [{
                    name: 'Friends',
                    data: [<?php echo implode(",", array_values($data_str)) ?>]
                }]
        });
    });
    
</script>


<script src="http://code.highcharts.com/highcharts.js"></script>

<div id="container" style="min-width: 600px; height: 450px; margin: 0 auto; z-index: 1000;"></div>

<center>
<?php 
echo CHtml::button('Next', array('class' => 'btn btn-primary btn-large', 'submit' => array('user/posts')));      
?>
</center>