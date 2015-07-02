<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('nprocs')); ?>:
	<?php echo GxHtml::encode($data->nprocs); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('total_bytes')); ?>:
	<?php echo GxHtml::encode($data->total_bytes); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('runtime')); ?>:
	<?php echo GxHtml::encode($data->runtime); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('unique_iotime')); ?>:
	<?php echo GxHtml::encode($data->unique_iotime); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('start_time')); ?>:
	<?php echo GxHtml::encode($data->start_time); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('end_time')); ?>:
	<?php echo GxHtml::encode($data->end_time); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('uid')); ?>:
	<?php echo GxHtml::encode($data->uid); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('projid')); ?>:
	<?php echo GxHtml::encode($data->projid); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('real_exe')); ?>:
	<?php echo GxHtml::encode($data->real_exe); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('agg_perf_MB')); ?>:
	<?php echo GxHtml::encode($data->agg_perf_MB); ?>
	<br />
	*/ ?>

</div>