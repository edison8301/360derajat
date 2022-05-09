<?php
$this->breadcrumbs=array(
	'Penilai Perans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List PenilaiPeran','url'=>array('index')),
	array('label'=>'Create PenilaiPeran','url'=>array('create')),
	array('label'=>'View PenilaiPeran','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage PenilaiPeran','url'=>array('admin')),
	);
	?>

	<h1>Update PenilaiPeran <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>