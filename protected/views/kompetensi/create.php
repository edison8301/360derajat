<?php
$this->breadcrumbs=array(
	'Kompetensis'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Kompetensi','url'=>array('index')),
array('label'=>'Manage Kompetensi','url'=>array('admin')),
);
?>

<h1>Tambah Data Kompetensi</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>