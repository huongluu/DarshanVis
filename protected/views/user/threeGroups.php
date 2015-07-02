<style>
    .nspace {
        padding-bottom: 10px;
    }
</style>
<?php
/*
  $query = Yii::app()->db->createCommand()
  ->select('f.fbid, f.name, p.seen, p.not_seen, (p.seen / (p.seen + p.not_seen)) percent')
  ->from('friend f, post p, user u')
  ->where('u.id=f.user and f.id=p.friend and p.category=8 and u.id=:userid', array(':userid' => $user->id))
  ->order('percent desc');
  $data = $query->queryAll();
  $text = $query->text;
  //echo $text . '<br>';

  $friends = array();
  $classes = 3; // # of clasess of friends we want to discuss: 0-10% (low), 45-55% (medium), 90-100% (high)

  for ($i = 0; $i < count($data); $i++) {
  if ($data[$i]['percent'] < 0.1 && $data[$i]['not_seen'] > 0) { // to avoid the friends who didn't post anything.
  $friends[0][] = $data[$i];
  } elseif ($data[$i]['percent'] > 0.45 && $data[$i]['percent'] < 0.55) {
  $friends[1][] = $data[$i];
  } elseif ($data[$i]['percent'] > 0.9 && $data[$i]['percent'] <= 1) {
  $friends[2][] = $data[$i];
  }
  }

  for ($c = 0; $c < $classes; $c++) {
  for ($j = 0; $j < count($friends[$c]); $j++) {
  $friends[$c][$j]['chosen'] = 0;
  }
  }

  //***When refresh button is pressed:
  //**********Choosing 3 ($friends_num) people randomly from each Class **********

  $friends_num = 3;

  for ($c = 0; $c < $classes; $c++) {
  $rand_keys[$c] = array_rand($friends[$c], $friends_num);

  for ($k = 0; $k < $friends_num; $k++) {

  while ($friends[$c][$rand_keys[$c][$k]]['chosen'] == 1) {
  $rand_keys[$c][$k] = array_rand($friends[$c]);
  }

  $friends[$c][$rand_keys[$c][$k]]['chosen'] = 1;
  }
  }

  for ($c = 0; $c < $classes; $c++) {
  for ($f = 0; $f < $friends_num; $f++) {
  $names[$c][] = '"' . $friends[$c][$rand_keys[$c][$f]]['name'] . '"';

  $seen[$c][] = $friends[$c][$rand_keys[$c][$f]]['seen'];
  $seen_final[] = "" . $friends[$c][$rand_keys[$c][$f]]['seen'] . "";

  $not_seen[$c][] = $friends[$c][$rand_keys[$c][$f]]['not_seen'];
  $not_seen_final[] = "" . (-1 * $friends[$c][$rand_keys[$c][$f]]['not_seen']) . "";
  }
  }

 */

//***ToDo: Check if the number of remained not chosen entries less than 3, say somethig and return!
?>


<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/grouped-categories.js"></script>




<script>
    //<div id="chart" style="height: 300px"></div>
    /* window.chart = new Highcharts.Chart({
     chart: {
     renderTo: "chart",
     type: "column"
     },
     title: {
     text: null
     },
     series: [{
     data: [4, 14, 18, 5, 6, 5, 14, 15, 18]
     }],
     xAxis: {
     categories: [{
     name: "Low ",
     categories: ["Apple", "Banana", "Orange"]
     }, {
     name: "Medium (45%-55%)",
     categories: ["Carrot", "Potato", "Tomato"]
     }, {
     name: "High (90%-100%)",
     categories: ["Cod", "Salmon", "Tuna"]
     }]
     }
     });*/
</script>

<script type="text/javascript">
    $(function() {
        $('#container-seen').highcharts({
            chart: {
                type: 'column'

            },
            title: {
                text: '# of Seen & Not Seen Posts From a Sample of Friends'
            },
            xAxis: {
                categories: [{
                        name: "<b>Rarely Seen (0%-10%)</b>",
                        categories: [<?php echo implode(",", $names[0]); ?>]
                    }, {
                        name: "<b>Sometimes Seen (45%-55%)</br>",
                        categories: [<?php echo implode(",", $names[1]);
?>]
                    }, {
                        name: "<b>Mostly Seen (90%-100%)</b>",
                        categories: [<?php echo implode(",", $names[2]);
?>]
                    }]
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Number of Posts'
                },
                labels: {
                    formatter: function() {
                        if (this.value < 0)
                            return -1 * this.value;
                        else
                            return this.value;
                    }
                },
                stackLabels: {
                    formatter: function() {
                        if (this.total < 0)
                            return -1 * this.total;
                        else if (this.total > 0)
                            return this.total;
                        else
                            return "";
                    },
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                enabled: false,
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
                    return '<b>' + this.x + '</b><br/>' +
                            this.series.name + '<br/>';
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: false,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
            series: [{
                    name: 'Seen',
                    data: [<?php echo implode(",", $seen_final); ?>]

                }, {
                    name: 'Not Seen',
                    data: [<?php echo implode(",", $not_seen_final); ?>]

                }]
        });
    });

</script>

<div id="container-seen" style="min-width: 600px; height: 430px; margin: 0 auto"></div>

<?php

function getList($f_list, $c) {
    // echo sizeof($f_list[$c])." ".sizeof($names[$c])."<br>";
    for ($k = 0; $k < count($f_list[$c]); $k++) {
        if ($f_list[$c][$k]['chosen'] != 0) {
            echo "<div class='nspace'>" . $f_list[$c][$k]['name'] . "</div>";
        }
    }
}
?>

<div style="float: right; margin: 10px;">
    <?php
    echo CHtml::button('Refresh', array('class' => 'btn btn-primary btn-large', 'submit' => array('user/refreshList')));
    ?>
</div>
<hr>

<div class="row" style="text-align: center; font-weight: bold;">
    <div class="span6">
        <?php echo getList($friends_list, 0); ?>
    </div>
    <div class="span5">
        <?php echo getList($friends_list, 1); ?>
    </div>
    <div class="span5">
        <?php echo getList($friends_list, 2); ?>
    </div>
</div>



<center>
    <?php
    echo CHtml::button('Next', array('class' => 'btn btn-primary btn-large', 'submit' => array('user/evaluateList')));
    ?>
</center>


