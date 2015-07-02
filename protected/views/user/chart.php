<?php
$data_seen = Yii::app()->db->createCommand()
        ->select('f.fbid, f.name, p.seen, p.not_seen')
        ->from('friend f, post p, user u')
        ->where('u.id=f.user and f.id=p.friend and p.category=8 and u.id=:userid', array(':userid' => $user->id))
        ->order('p.seen desc')
        ->limit(10)
        ->queryAll();

$data_all_seen = Yii::app()->db->createCommand()
        ->select('f.fbid, f.name, p.seen, p.not_seen, (p.seen + p.not_seen) all_seen')
        ->from('friend f, post p, user u')
        ->where('u.id=f.user and f.id=p.friend and p.category=8 and u.id=:userid', array(':userid' => $user->id))
        ->order('all_seen desc')
        ->limit(10)
        ->queryAll();

$friends1 = array();
$seen1 = array();
$not_seen1 = array();
foreach ($data_seen as $key => $value) {
    //$friends1[] = '"' . Yii::app()->facebook->getFullName($value['fbid']) . '"';
    $friends1[] = '"' . $value['name'] . '"';
    $seen1[] = $value['seen'];
    $not_seen1[] = -1 * $value['not_seen'];
}


$friends2 = array();
$seen2 = array();
$not_seen2 = array();
foreach ($data_all_seen as $key => $value) {
    //$friends2[] = '"' . Yii::app()->facebook->getFullName($value['fbid']) . '"';
    $friends2[] = '"' . $value['name'] . '"';
    $seen2[] = $value['seen'];
    $not_seen2[] = -1 * $value['not_seen'];
}
?>


<script type="text/javascript">
    $(function () {
        $('#container-seen').highcharts({
            chart: {
                type: 'column'
            },
            colors: [ 
                '#8201A5',
                '#CB00FF'
                 
                
            ],
            title: {
                text: 'Facebook Top-10 Seen Friends'
            },
            xAxis: {
                categories: [<?php echo implode(",", $friends1) ?>]//,
                //   labels: {
                //       rotation: 45,
                //       align : 'left'
                //   }
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Number of Posts'
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
                align: 'right',
                x: -100,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>';
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
            series: [{
                    name: 'Seen',
                    data: [<?php echo implode(",", $seen1) ?>]
                }, {
                    name: 'Not Seen',
                    data: [<?php echo implode(",", $not_seen1) ?>]
                }]
        });
        
        
        $('#container-all').highcharts({
            chart: {
                type: 'column'
            },
            colors: [ 
                '#0d233a',
                '#2f7ed8',
            ],
            title: {
                text: 'Facebook Top-10 Active Friends'
            },
            xAxis: {
                categories: [<?php echo implode(",", $friends2) ?>]
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Number of Posts'
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
                align: 'right',
                x: -100,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>';
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
            series: [{
                    name: 'Seen',
                    data: [<?php echo implode(",", $seen2) ?>]
                }, {
                    name: 'Not Seen',
                    data: [<?php echo implode(",", $not_seen2) ?>]
                }]
        });
    });
    
</script>



<div id="container-seen" style="min-width: 600px; height: 430px; margin: 0 auto"></div>

<div style="margin-left:80px;">
    <table>
        <tr>
            <?php
            for ($i = 0; $i < count($friends1); $i++)
                echo "<td><input type='checkbox'></td>"
                ?>
        </tr>
    </table>
</div>
<br>
<div id="container-all" style="min-width: 600px; height: 430px; margin: 0 auto"></div>

<center>
    <?php
    echo CHtml::button('Next', array('class' => 'btn btn-primary btn-large', 'submit' => array('user/friends_posts')));
    ?>
</center>

<script src="http://code.highcharts.com/highcharts.js"></script>
