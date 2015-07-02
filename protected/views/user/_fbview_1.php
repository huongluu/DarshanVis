<?php
if ($data->seen == 1)
    $bcolor = '#DFE3EE';
else
    $bcolor = 'white';
?>
<div class="row fbpost"  style =" background-color: <?php echo $bcolor ?>">
    <?php // echo $data->id; ?>
    <div class="span1"><div><a href="https://facebook.com/<?php echo $data->from_id; ?>"><img src="https://graph.facebook.com/<?php echo $data->from_id; ?>/picture"></a></div></div>
    <div>
        <div class="nameDiv"><a href="https://facebook.com/<?php echo $data->from_id; ?>"><?php echo $data->from_name; ?></a></div>
        <?php
        if (isset($data->story)) {
            if (strlen($data->story) > 60) {
                echo "<div class='fbspacer'>" . $data->story . "</div>";
            } else {
                echo "<div class='muted fbspacer'>" . $data->story . "</div>";
            }
        }
        ?>
        <?php
        if (isset($data->message)) {
            echo "<div class='fbbox fbspacer'>" . $data->message . "</div>";
        } else if (isset($data->description)) {
            echo "<div class='fbbox fbspacer'>" . $data->description . "</div>";
        }
        ?>
        <?php
        if (isset($data->picture)) {
            $picture = str_replace("_s.jpg", "_n.jpg", $data->picture);
            echo "<img width='300px' src='" . $picture . "'></img>";
        }
        ?>
        <?php
        if (isset($data->created_time)) {
            // echo $data->created_time.'<br>';
            //echo date("l jS of F g:i A.", $data->created_time);   
            echo '<br>' . date("l jS F g:i A.", strtotime($data->created_time));
        }
        ?>

        <!--<div class="btn-toolbar" style="float:right; margin:5px;">
            <div class="btn-group toggleMe">
                <?php
                /*
                echo $data->id;
                echo CHtml::ajaxButton(
                        '', array('User/updatePosts', 'pid' => $data->id, 'value' => '1'), // Yii URL
                        array(), array('class' => 'btn toggleRemove', 'encode' => false)
                );
                 
                 */
                ?>

            </div>
        </div>
        -->


        <?php
        /* function facebook_style_date_time($timestamp) {
          $difference = time() - $timestamp;
          $periods = array("sec", "min", "hour", "day", "week", "month", "years", "decade");
          $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

          if ($difference > 0) { // this was in the past time
          $ending = "ago";
          } else { // this was in the future time
          $difference = -$difference;
          $ending = "to go";
          }
          for ($j = 0; $difference >= $lengths[$j]; $j++)
          $difference /= $lengths[$j];

          $difference = round($difference);
          if ($difference != 1)
          $periods[$j].= "s";
          $text = "$difference $periods[$j] $ending";
          return $text;
          }

          $my_time_stamp = "1326106176";
          echo facebook_style_date_time($my_time_stamp); */
        ?>


    </div>
</div>
