<?php
$this->breadcrumbs=array(
	'Kegiatan'=>array('admin'),
	'Tambah',
);

?>

<h1>Tambah Kegiatan </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>