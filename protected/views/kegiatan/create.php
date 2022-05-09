<?php
$this->breadcrumbs=array(
	'Kegiatan'=>array('admin'),
	'Kegiatan Baru',
);

$this->menu=array(
array('label'=>'List Kegiatan','url'=>array('index')),
array('label'=>'Manage Kegiatan','url'=>array('admin')),
);
?>

<h1>Tambah Kegiatan Baru</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>