<?php
$this->breadcrumbs=array(
	'User'=>array('admin'),	
	'Tambah Data',
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Manage User','url'=>array('admin')),
);
?>

<h1>Tambah Data User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>