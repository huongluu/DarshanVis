<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-3 sidebar">
            <?php
            include '_menu.php';
            ?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 main">
            <?php
            include '_charts.php';
            ?>
        </div>  
    </div>
</div>

<?php

$this->breadcrumbs = array(
	Jobs::label(2),
	Yii::t('app', 'Index'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Jobs::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Jobs::label(2), 'url' => array('admin')),
);
?>
