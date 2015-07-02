<?php
$data_seen = Yii::app()->db->createCommand()
        ->select('f.fbid, f.name, p.seen')
        ->from('friend f, post p, user u')
        ->where('u.id=f.user and f.id=p.friend and p.category=8 and p.seen>0 and u.id=:userid', array(':userid' => $user->id))
        ->order('p.seen desc')
        //   ->limit(10)
        ->queryAll();

$data_not_seen = Yii::app()->db->createCommand()
        ->select('f.fbid, f.name, p.not_seen')
        ->from('friend f, post p, user u')
        ->where('u.id=f.user and f.id=p.friend and p.category=8 and p.not_seen>0 and u.id=:userid', array(':userid' => $user->id))
        ->order('p.not_seen desc')
        //  ->limit(10)
        ->queryAll();

$data_all = Yii::app()->db->createCommand()
        ->select('f.fbid, f.name, p.seen, p.not_seen, (p.seen + p.not_seen) all_')
        ->from('friend f, post p, user u')
        ->where('u.id=f.user and f.id=p.friend and p.category=8 and u.id=:userid', array(':userid' => $user->id))
        ->order('all_ desc')
        //->limit(10)
        ->queryAll();

$friends_seen = array();
$seen = array();
$seen_rank = 0;

foreach ($data_seen as $key => $value) {
    $seen_rank++;
    $friends_seen[] = '"' . $value['name'] . '"';
    //$friends_seen[] = $seen_rank;
    $seen[] = $value['seen'];
}

$friends_not_seen = array();
$not_seen = array();
$not_seen_rank = 0;

foreach ($data_not_seen as $key => $value) {
    $not_seen_rank++;
    $friends_not_seen[] = '"' . $value['name'] . '"';
    // $friends_not_seen[] = $not_seen_rank;
    $not_seen[] = $value['not_seen'];
}

$friends_all = array();
$all = array();
foreach ($data_all as $key => $value) {
    if ($value['all_'] > 0) {
        $friends_all[] = '"' . $value['name'] . '"';
        $all[] = $value['all_'];
    }
}
?>


<script type="text/javascript">
    $(function () {
        $('#container-seen').highcharts({
            chart: {
                type: 'column'
            },
            colors: [ 
                '#CB00FF',
                '#8201A5' 
                
            ],
            title: {
                text: 'Facebook Friends Post#'
            },
            xAxis: {
                categories: [<?php echo implode(",", $friends_seen) ?>],
                max: 8
                //   labels: {
                //       rotation: 45,
                //       align : 'left'
                //   }
            },
            yAxis: {
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
            
            scrollbar: {
                enabled: true
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>';//'Total: '+ this.point.stackTotal;
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
                    data: [<?php echo implode(",", $seen) ?>]
                }]
        });
        
        //***********************Not Seen Chart**********************
        $('#container-not_seen').highcharts({
            chart: {
                type: 'column'
            },
            colors: [
                '#2f7ed8', 
                '#0d233a',
            ],
            title: {
                text: 'Facebook Friends Not Seen Posts#'
            },
            xAxis: {
                categories: [<?php echo implode(",", $friends_not_seen) ?>],
                max: 8
            },
            yAxis: {
                title: {
                    text: 'Number of Not Seen Posts'
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
            scrollbar: {
                enabled: true
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>'//;+ 'Total: '+ this.point.stackTotal;
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
                    name: 'Not Seen',
                    data: [<?php echo implode(",", $not_seen) ?>]
                }]
        });
        
        //***********************All Chart**********************
        $('#container-all').highcharts({
            chart: {
                type: 'column'
            },
            colors: [
                '#4AD44A', 
                '#fd233a',
            ],
            title: {
                text: 'Facebook Friends All Posts#'
            },
            xAxis: {
                categories: [<?php echo implode(",", $friends_all) ?>],
                max: 8
            },
            yAxis: {
                title: {
                    text: 'Number of All Posts'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            scrollbar: {
                enabled: true
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
                        this.series.name +': '+ this.y +'<br/>'//;+ 'Total: '+ this.point.stackTotal;
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
                    name: 'All',
                    data: [<?php echo implode(",", $all) ?>]
                }]
        });
    });
    
</script>


<script src="http://code.highcharts.com/stock/highstock.js"></script>


<div id="container-seen" style="height: 430px;"></div>
<br>
<div id="container-not_seen" style="height: 430px;"></div>
<br>
<div id="container-all" style="height: 430px;"></div>

<br>
<center>
    <?php
    echo CHtml::button('Next', array('class' => 'btn btn-primary btn-large', 'submit' => array('user/stat')));
    ?>
</center>
