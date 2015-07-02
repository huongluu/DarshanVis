<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    GxHtml::valueEx($model),
);

$this->menu = array(
    array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
    array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
    array('label' => Yii::t('app', 'Update') . ' ' . $model->label(), 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('app', 'Delete') . ' ' . $model->label(), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'fbid',
        'name',
        'start_time',
        'end_time',
    ),
));
?>

<h2><?php //echo GxHtml::encode($model->getRelationLabel('friends'));    ?></h2>
<?php
/*
  echo GxHtml::openTag('ul');
  foreach ($model->friends as $relatedModel) {
  echo GxHtml::openTag('li');
  echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('friend/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
  echo GxHtml::closeTag('li');
  }
  echo GxHtml::closeTag('ul'); */
?>

<?php
/*echo "Posts <br>";
$seen_chosen = 0;
$notseen_chosen = 0;
$seen_to_notseen = 0;
$notseen_to_seen = 0;
$count_seen = 0;

foreach ($model->postDatas as $pd) {
     
    //Check chosen or not
    if ($pd->chosen == 1) {

        if ($pd->seen == 0) {
            $notseen_chosen ++;
            if ($pd->changed == 1) {
                $notseen_to_seen ++;
            }
        } else {
            $seen_chosen ++;
            if ($pd->changed == 1) {
                $seen_to_notseen ++;
            }
        }
    }
    
    if ($pd->seen == 1){
        $count_seen ++;
    }   
}

$percent_seen = $count_seen / sizeof ($model->postDatas);

echo "Seen Chosen : " . $seen_chosen . "<br>";
echo "Seen to Not Seen: " . $seen_to_notseen . "<br><br>";

echo "Not Seen Chosen: " . $notseen_chosen . "<br>";
echo "Not Seen to Seen: " . $notseen_to_seen . "<br>";

echo "Seen%: ". $percent_seen. "<br>";
 * 
 */
?>

<?php
/*
 echo "<br> Friends <br>";
$rare = 0;
$rare_to_sometimes = 0;
$rare_to_almost = 0;

$sometimes = 0;
$sometimes_rare = 0;
$sometimes_almost = 0;

$almost = 0;
$almost_rare = 0;
$almost_sometimes = 0;

foreach ($model->friends as $fr) {
    if ($fr->chosen == 1) {
        if ($fr->initial == 0) {
            $rare++;
            if ($fr->changed == 1) {
                $rare_to_sometimes ++;
            } else if ($fr->changed == 2) {
                $rare_to_almost ++;
            }
        } else if ($fr->initial == 1) {
            $sometimes++;
            if ($fr->changed != NULL) {
                if ($fr->changed == 0) {
                    //echo "changed: " . $fr->changed . "<br>";
                    $sometimes_rare ++;
                } else if ($fr->changed == 2) {
                    $sometimes_almost ++;
                }
            }
        } else if ($fr->initial == 2) {
            $almost++;
            if ($fr->changed != NULL) {
                if ($fr->changed == 0) {
                    $almost_rare ++;
                } else if ($fr->changed == 1) {
                    $almost_sometimes ++;
                }
            }
        }
    }
}
echo "#rare: " . $rare . "<br>";
echo "#rare to sometimes: " . $rare_to_sometimes . "<br>";
echo "#rare to almost: " . $rare_to_almost . "<br><br>";

echo "#sometimes: " . $sometimes . "<br>";
echo "#sometimes to rare: " . $sometimes_rare . "<br>";
echo "#sometimes to almost: " . $sometimes_almost . "<br><br>";

echo "#almost: " . $almost . "<br>";
echo "#almost to rare: " . $almost_rare . "<br>";
echo "#almost to sometimes: " . $almost_sometimes . "<br>";
 * 
 */
?>
