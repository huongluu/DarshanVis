<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'jobs-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
		<?php echo $form->error($model,'id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'nprocs'); ?>
		<?php echo $form->textField($model, 'nprocs'); ?>
		<?php echo $form->error($model,'nprocs'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'total_bytes'); ?>
		<?php echo $form->textField($model, 'total_bytes', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'total_bytes'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'runtime'); ?>
		<?php echo $form->textField($model, 'runtime'); ?>
		<?php echo $form->error($model,'runtime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'unique_iotime'); ?>
		<?php echo $form->textField($model, 'unique_iotime'); ?>
		<?php echo $form->error($model,'unique_iotime'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php echo $form->textField($model, 'start_time'); ?>
		<?php echo $form->error($model,'start_time'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?php echo $form->textField($model, 'end_time'); ?>
		<?php echo $form->error($model,'end_time'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model, 'uid', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'uid'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'projid'); ?>
		<?php echo $form->textField($model, 'projid', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'projid'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'real_exe'); ?>
		<?php echo $form->textField($model, 'real_exe', array('maxlength' => 50)); ?>
		<?php echo $form->error($model,'real_exe'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'agg_perf_MB'); ?>
		<?php echo $form->textField($model, 'agg_perf_MB'); ?>
		<?php echo $form->error($model,'agg_perf_MB'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->