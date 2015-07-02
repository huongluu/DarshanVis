<style>
    body {
        color: #333333;
        direction: ltr;
        line-height: 1.28;
        text-align: left;
    }
    h4, h5, h6 {
        font-size: 11px;
    }
    h1, h2, h3, h4, h5, h6 {
        color: #333333;
        font-size: 13px;
    }
    body, button, input, label, select, td, textarea {
        font-family: 'lucida grande',tahoma,verdana,arial,sans-serif;
        font-size: 11px;
    }
    a:hover {
        text-decoration: underline;
    }
    .nameDiv a {
        color: #3B5998;
        cursor: pointer;
        font-size: 13px;
        line-height: 1.38;
        font-weight: bold;
    }

    .fbbox {
        cursor: pointer;
        display: block;
        padding-top: 8px;
        text-decoration: none;
    }

    .fbpost {
        border-color: #E9E9E9;
        border-style: solid;
        border-width: 1px 0 0;
        padding-top:13px;
        margin-top:16px;
    }
    .fbspacer {
        padding-bottom: 6px;
    }

    .blue {
        color: blue;
    }
</style>

<script type="text/javascript" >
    $(function() {
        $(".toggleOK").click(function(e) {

            var cls = $(this).attr("class");
            //alert(cls);
            if (cls == "btn toggleOK") {
                $(this).attr("class", "btn toggleOK btn-success");
                $(this).siblings(".toggleRemove").attr("class", "btn toggleRemove");
            }
            else {
                $(this).attr("class", "btn toggleOK");
            }
        });

        $(".toggleRemove").click(function(e) {

            var cls = $(this).attr("class");
            //alert(cls);
            if (cls == "btn toggleRemove") {
                $(this).attr("class", "btn toggleRemove btn-danger");
                $(this).siblings(".toggleOK").attr("class", "btn toggleOK");
            }
            else {
                $(this).attr("class", "btn toggleRemove");
            }
        });
    });
</script>


<div class="span5">
    <h2>Hidden Stories</h2>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $notSeenPosts,
        'itemView' => '_fbview_eval_notseen',
        'template' => '{items}',
    ));
    ?>
</div>

<div class="span1"></div>

<div class="span5">
    <h2>Shown Stories</h2>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $seenPosts,
        'itemView' => '_fbview_eval_seen',
        'template' => '{items}',
    ));
    ?>
</div>

<hr>
<center>
    <?php
    echo CHtml::button('Next', array('class' => 'btn btn-primary btn-large', 'submit' => array('user/finish')));
    ?>
</center>