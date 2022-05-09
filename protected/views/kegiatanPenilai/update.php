<?php
$this->breadcrumbs=array(
	'Penilai Kegiatan'=>array('admin'),	
	'Sunting Data',
);

	?>

<h1>Sunting Penilai : <b><?php echo $model->getRelation('pegawai','nama'); ?></b></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>