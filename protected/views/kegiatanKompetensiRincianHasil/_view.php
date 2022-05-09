<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_kegiatan_kompetensi_rincian')); ?>:</b>
	<?php echo CHtml::encode($data->id_kegiatan_kompetensi_rincian); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_kegiatan_penilai')); ?>:</b>
	<?php echo CHtml::encode($data->id_kegiatan_penilai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hasil')); ?>:</b>
	<?php echo CHtml::encode($data->hasil); ?>
	<br />


</div>