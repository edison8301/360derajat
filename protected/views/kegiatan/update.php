<?php
$this->breadcrumbs=array(
	'Kegiatan'=>array('admin'),
	'Sunting Kegiatan',
);

?>

<h1>Sunting <?php echo $model->nama; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>