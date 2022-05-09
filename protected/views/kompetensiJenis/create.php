<?php
$this->breadcrumbs=array(
	'Jenis Kompetensi'=>array('admin'),
	'Tambah',
);

?>

<h1>Tambah Jenis Kompetensi</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>