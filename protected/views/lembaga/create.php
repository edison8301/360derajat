<?php
$this->breadcrumbs=array(
	'Lembaga'=>array('admin'),
	'Tambah',
);

?>

<h1>Tambah Lembaga</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>