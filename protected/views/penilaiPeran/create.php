<?php
$this->breadcrumbs=array(
	'Penilai Perans'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List PenilaiPeran','url'=>array('index')),
array('label'=>'Manage PenilaiPeran','url'=>array('admin')),
);
?>

<h1>Create PenilaiPeran</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>