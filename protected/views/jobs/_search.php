<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'nprocs'); ?>
		<?php echo $form->textField($model, 'nprocs'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'total_bytes'); ?>
		<?php echo $form->textField($model, 'total_bytes', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'runtime'); ?>
		<?php echo $form->textField($model, 'runtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'unique_iotime'); ?>
		<?php echo $form->textField($model, 'unique_iotime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'start_time'); ?>
		<?php echo $form->textField($model, 'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'end_time'); ?>
		<?php echo $form->textField($model, 'end_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'uid'); ?>
		<?php echo $form->textField($model, 'uid', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'projid'); ?>
		<?php echo $form->textField($model, 'projid', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'real_exe'); ?>
		<?php echo $form->textField($model, 'real_exe', array('maxlength' => 50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'agg_perf_MB'); ?>
		<?php echo $form->textField($model, 'agg_perf_MB'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
