<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_kegiatan_kompetensi')); ?>:</b>
	<?php echo CHtml::encode($data->id_kegiatan_kompetensi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uraian')); ?>:</b>
	<?php echo CHtml::encode($data->uraian); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpr')); ?>:</b>
	<?php echo CHtml::encode($data->cpr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fpr')); ?>:</b>
	<?php echo CHtml::encode($data->fpr); ?>
	<br />


</div>