<?php
$this->breadcrumbs=array(
	'Kegiatan'=>array('admin'),
	$model->kode=>array('view','id'=>$model->id),
	'Sunting',
);

?>

<h1>Update Kegiatan: <?php $model->nama ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>