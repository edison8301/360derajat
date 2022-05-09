<?php
$this->breadcrumbs=array(
	'User'=>array('admin'),	
	'Sunting Data',
);

	$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'View User','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage User','url'=>array('admin')),
	);
	?>

	<h1>Sunting User : <b><?php echo $model->username; ?></b></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>