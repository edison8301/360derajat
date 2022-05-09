<?php
$this->breadcrumbs=array(
	'Jenis Kompetensi'=>array('admin'),
	'Sunting',
);

?>

<h1>Sunting Jenis Kompetensi: <?php echo $model->nama; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>