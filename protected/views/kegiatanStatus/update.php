<?php
$this->breadcrumbs=array(
	'Kegiatan Statuses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List KegiatanStatus','url'=>array('index')),
	array('label'=>'Create KegiatanStatus','url'=>array('create')),
	array('label'=>'View KegiatanStatus','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage KegiatanStatus','url'=>array('admin')),
	);
	?>

	<h1>Update KegiatanStatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>