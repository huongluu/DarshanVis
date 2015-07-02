<?php
if ($data->from_id % 2 == 0) {
    $f = 'filter1';
} else {
    $f = 'filter2';
}
?>
<div class="item fbhighlight <?php echo $data->filters; ?>" data-category="f1">
    <?php // echo $data->id; ?>
    <span class="crit1 " style="visibility: hidden; display: none;"><?php echo randStr(); ?></span>
    <span class="crit2" style="visibility: hidden; display: none;"><?php echo randStr(); ?></span>
    <span class="crit3" style="visibility: hidden; display: none;"><?php echo randStr(); ?></span>
    <span class="crit4" style="visibility: hidden; display: none;"><?php echo randStr(); ?></span>

    <div class="span1">

        <div class="nameDiv sender">
            <a href="https://facebook.com/<?php echo $data->from_id; ?>">
                <img width="32px" src="http://graph.facebook.com/<?php echo $data->from_id; ?>/picture">
            </a>
            <a href="https://facebook.com/<?php echo $data->from_id; ?>"><?php echo $data->from_name; ?></a></div>
    </div>
    <div>

        <?php
        if (isset($data->story)) {
            if (strlen($data->story) > 60) {
                echo "<div class='fbspacer type'>" . trunct($data->story) . "</div>";
            } else {
                echo "<div class='muted fbspacer'>" . trunct($data->story) . "</div>";
            }
        }
        ?>
        <?php
        if (isset($data->message)) {
            echo "<div class='fbbox fbspacer'>" . trunct($data->message) . "</div>";
        } else if (isset($data->description)) {
            echo "<div class='fbbox fbspacer'>" . trunct($data->description) . "</div>";
        }
        ?>
        <?php
        if (isset($data->picture)) {
            $picture = str_replace("_s.jpg", "_n.jpg", $data->picture);
            echo "<img width='150px' src='" . $picture . "'></img>";
        }
        ?>
        <?php
        if (isset($data->created_time)) {
            // echo $data->created_time.'<br>';
            //echo date("l jS of F g:i A.", $data->created_time);   
            echo '<br><div class="date">' . date("l jS F g:i A.", strtotime($data->created_time)) . "</div>";
        }
        ?>
    </div>
</div>
