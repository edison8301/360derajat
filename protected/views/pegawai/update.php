<?php
$this->breadcrumbs=array(
	'Pegawai'=>array('admin'),
	$model->nama=>array('view','id'=>$model->id),
	'Sunting',
);

?>

<h1>Sunting Pegawai</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>