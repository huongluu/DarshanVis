<style>
	#sortable1, #sortable2 { list-style-type: none; margin-bottom:30px ; padding:0 0 0 0; float: left; margin-right: 1px; }
	#sortable1 li, #sortable2 li { margin: 1px 1px 1px 1px; padding: 1px; width: 60px; float: left;  }
</style>

<img src="
     <?php echo Yii::app()->facebook->getProfilePicture('normal'); ?>"
     />

<?php
$friends = Yii::app()->facebook->api(array(
    'method' => 'fql.query',
    'query' => 'SELECT uid1 from friend where uid2=me() limit 40',
        ));

$items1 = array();

$items2 = array();

foreach ($friends as $friend) {
      array_push($items1, "<img src=\"".Yii::app()->facebook->getProfilePictureById($friend["uid1"])."\"/>" );
}

foreach ($friends as $friend) {
      array_push($items2, "<img src=\"".Yii::app()->facebook->getProfilePictureById($friend["uid1"])."\"/>" );
}
$this->widget('zii.widgets.jui.CJuiSortable', array(
    'id' => 'sortable1',
    'items' => $items1
    ,
    // additional javascript options for the JUI Sortable plugin
    'options' => array(
        'connectWith' => '.connectedSortable'
    ),
    'htmlOptions'=>array(
        'class' => 'connectedSortable',
    ),
));
$this->widget('zii.widgets.jui.CJuiSortable', array(
    'id' => 'sortable2',
    'items' => $items2 ,
    // additional javascript options for the JUI Sortable plugin
    'options' => array(
        'connectWith' => '.connectedSortable' ,
        'update' =>  'print_r($items2[2]);'
         
    ),
    'htmlOptions'=>array(
        'class' => 'connectedSortable',
    ),
));

echo CHtml::ajaxButton('Submit Changes', '', array(
        'type' => 'POST',
        'data' => array(
            // Turn the Javascript array into a PHP-friendly string
            'Order' => 'js:$("ul#sortable2").sortable("toArray").toString()',
        )
    ));

//************Grivan-Newman************
$edges = Yii::app()->facebook->api(array(
    'method' => 'fql.query',
    'query' => 'SELECT uid1, uid2 FROM friend WHERE uid1 IN (SELECT uid2 FROM friend WHERE uid1=me()) AND uid2>uid1 AND uid2 IN (SELECT uid2 FROM friend WHERE uid1=me()) limit 10',
        ));

print_r($edges);
?>

