<?php
$this->breadcrumbs=array(
	'Kegiatan Penilais'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List KegiatanPenilai','url'=>array('index')),
array('label'=>'Create KegiatanPenilai','url'=>array('create')),
array('label'=>'Update KegiatanPenilai','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete KegiatanPenilai','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage KegiatanPenilai','url'=>array('admin')),
);
?>

<h1>View KegiatanPenilai #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'id_kegiatan',
		'id_penilai_peran',
		'id_pegawai',
),
)); ?>
