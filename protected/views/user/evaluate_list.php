<style>
    .nspace {
        padding-bottom: 10px;
    }

    .bspace {
        border-top-width: 1px;
        border-bottom-width: 1px;
        border-right-width: 1px;
        border-left-width: 1px;
        margin-left: 4px;
        margin-right:4px;
        padding-left: 20px;
        padding-right : 3px;
        border-color: black;
        width: 20px;
    }

    .topdiv {
        border:6px solid #B5B0B1; 
        margin:3px; 
        margin-bottom:24px; 
        border-radius:6px; 
        padding:5px; 
        background-color: white;
    }

</style>

<script>
    $(document).ready(function() {
        $('#topelement').css("position", "");
        $(window).scroll(function() {
            $('#topelement').css('top', ($(this).scrollTop()) + "px");
            var topstr = $('#topelement').css('top');
            //alert(topstr.);
            var len = topstr.length;
            var top = topstr.substring(0, len - 2);
            //alert(top);
            if (top < 200) {
                $('#topelement').css("position", "");
            } else {
                $('#topelement').css("position", "absolute");
            }
        });

        $(".bspace").click(function() {
            var col = $(this).attr('col');
            var btns = new Array();
            btns[0] = "btn-danger";
            btns[1] = "btn-info";
            btns[2] = "btn-success";

            if (!$(this).hasClass(btns[col])) {
                $(this).attr('class', 'bspace btn ' + btns[col]);
            }

            $(this).siblings().attr('class', 'bspace btn ');



            //**********change border width**********

            /* var width = $(this).css("border-top-width");
             //alert(width);
             if (width == "4px") {
             setBorder($(this), "1px");
             setBorder($(this).siblings(), "1px");
             //$(this).siblings().css("border-width", "1px");
             
             }
             else if (width == "1px") {
             setBorder($(this).siblings(), "1px");
             setBorder($(this), "4px");
             
             //$(this).siblings().css("border-width", "1px");
             //$(this).css("border-width", "4px");
             }
             else
             alert("not valid! " + width + "salam");
             */
        });
    });

    function setBorder(b, value) {
        b.css("border-top-width", value);
        b.css("border-bottom-width", value);
        b.css("border-right-width", value);
        b.css("border-left-width", value);
    }
</script>
<?php

function getList($f_list, $c, $b_color) {

    // echo sizeof($f_list[$c])." ".sizeof($names[$c])."<br>";
    for ($k = 0; $k < count($f_list[$c]); $k++) {
        if ($f_list[$c][$k]['chosen'] != 0) {

            echo "<div style='border:1px solid #B5B0B1; margin:3px; margin-bottom:24px; border-radius:6px; padding:5px; height:80px;'>";
            echo "<div style='float:left; margin:5px; width:100px'><a href='https://facebook.com/" . $f_list[$c][$k]['fbid'] . "'><img width=70px src='https://graph.facebook.com/" . $f_list[$c][$k]['fbid'] . "/picture'></a></div>";
            echo "<div class='nspace' style='margin:5px;'>" . $f_list[$c][$k]['name'] . "&nbsp;&nbsp;</div>";
            echo "<div>";
            // echo "<button class='bspace btn btn-danger'><i class='icon-star-empty'></i></button>";
            //echo "<button class='bspace btn btn-info'><i class='icon-star-empty'></i><i class='icon-star-empty'></i></button>";
            //echo "<button class='bspace btn btn-success'><i class='icon-star-empty'></i><i class='icon-star-empty'></i><i class='icon-star-empty'></i></button>";
            echo CHtml::ajaxButton(
                    '', array('User/updateList', 'fid' => $f_list[$c][$k]['id'], 'value' => '0'), // Yii URL
                    array(), array('class' => 'bspace btn ' . $b_color[0], 'style' => 'border-color: #F06141;', 'col' => '0')
            );
            echo CHtml::ajaxButton(
                    '', array('User/updateList', 'fid' => $f_list[$c][$k]['id'], 'value' => '1'), // Yii URL
                    array(), array('class' => 'bspace btn ' . $b_color[1], 'style' => 'border-color: #45C3ED; ', 'col' => '1')
            );
            echo CHtml::ajaxButton(
                    '', array('User/updateList', 'fid' => $f_list[$c][$k]['id'], 'value' => '2'), // Yii URL
                    array(), array('class' => 'bspace btn ' . $b_color[2], 'style' => 'border-color: #63BF63;', 'col' => '2')
            );
            echo "</div>";
            //    echo "<div><select width='50' style='width: 100px'><option value='empty'></option><option value='low'>Low</option><option value='medium'>Medium</option><option value='high'>High</option></select></div>";
            echo "</div>";
        }
    }
}
?>
<div style="margin-left:10%;margin-right:10%">
    <div id="topelement"  class="row" style="text-align: center; font-weight: bold; position: absolute;">
        <div class="span4">
            <div class="topdiv" style='border-color:#F06141;'>
                <h3>Rarely Seen</h3>
                <div style="padding:2px;margin-bottom:5px;margin-top:-5px;"></div>
            </div>
        </div>
        <div class="span4">
            <div class="topdiv" style='border-color:#45C3ED;'>
                <h3>Sometimes Seen</h3>
                <div style="padding:2px;margin-bottom:5px;margin-top:-5px;"></div>

            </div>
        </div>
        <div class="span4">
            <div class="topdiv" style='border-color:#63BF63;'>
                <h3>Mostly Seen</h3>
                <div style="padding:2px;margin-bottom:5px;margin-top:-5px;"></div>

            </div>
        </div>
    </div>



    <div class="row" style="text-align: center; font-weight: bold;">
        <div class="span4">
            <?php echo getList($friends_list, 0, array('btn-danger', '', '')); ?>
        </div>
        <div class="span4">
            <?php echo getList($friends_list, 1, array('', 'btn-info', '')); ?>
        </div>
        <div class="span4">
            <?php echo getList($friends_list, 2, array('', '', 'btn-success')); ?>
        </div>
    </div>

</div>
<hr>
<div>
    <center>
        <?php
        echo CHtml::button('Next', array('class' => 'btn btn-primary btn-large', 'submit' => array('user/evaluatePosts')));
        ?>
    </center>
</div>


