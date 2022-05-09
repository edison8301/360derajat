<?php
$this->breadcrumbs=array(
	'Penilai Perans'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List PenilaiPeran','url'=>array('index')),
array('label'=>'Create PenilaiPeran','url'=>array('create')),
array('label'=>'Update PenilaiPeran','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete PenilaiPeran','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage PenilaiPeran','url'=>array('admin')),
);
?>

<h1>View PenilaiPeran #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'nama',
),
)); ?>
