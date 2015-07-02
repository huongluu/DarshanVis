<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('fbid')); ?>:
	<?php echo GxHtml::encode($data->fbid); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>:
	<?php echo GxHtml::encode($data->name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('start_time')); ?>:
	<?php echo GxHtml::encode($data->start_time); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('end_time')); ?>:
	<?php echo GxHtml::encode($data->end_time); ?>
	<br />

</div>