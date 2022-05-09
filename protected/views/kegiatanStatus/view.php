<?php
$this->breadcrumbs=array(
	'Kegiatan Statuses'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List KegiatanStatus','url'=>array('index')),
array('label'=>'Create KegiatanStatus','url'=>array('create')),
array('label'=>'Update KegiatanStatus','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete KegiatanStatus','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage KegiatanStatus','url'=>array('admin')),
);
?>

<h1>View KegiatanStatus #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'nama',
),
)); ?>
