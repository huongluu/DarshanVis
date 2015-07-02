<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'user-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'fbid'); ?>
		<?php echo $form->textField($model, 'fbid', array('maxlength' => 30)); ?>
		<?php echo $form->error($model,'fbid'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'name'); ?>
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

		<label><?php echo GxHtml::encode($model->getRelationLabel('friends')); ?></label>
		<?php echo $form->checkBoxList($model, 'friends', GxHtml::encodeEx(GxHtml::listDataEx(Friend::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->