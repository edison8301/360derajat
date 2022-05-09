<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_kegiatan')); ?>:</b>
	<?php echo CHtml::encode($data->id_kegiatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_penilai_peran')); ?>:</b>
	<?php echo CHtml::encode($data->id_penilai_peran); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pegawai')); ?>:</b>
	<?php echo CHtml::encode($data->id_pegawai); ?>
	<br />


</div>