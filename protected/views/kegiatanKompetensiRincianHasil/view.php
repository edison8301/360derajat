<?php
$this->breadcrumbs=array(
	'Kegiatan Kompetensi Rincian Hasils'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List KegiatanKompetensiRincianHasil','url'=>array('index')),
array('label'=>'Create KegiatanKompetensiRincianHasil','url'=>array('create')),
array('label'=>'Update KegiatanKompetensiRincianHasil','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete KegiatanKompetensiRincianHasil','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage KegiatanKompetensiRincianHasil','url'=>array('admin')),
);
?>

<h1>View KegiatanKompetensiRincianHasil #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'id_kegiatan_kompetensi_rincian',
		'id_kegiatan_penilai',
		'hasil',
),
)); ?>
