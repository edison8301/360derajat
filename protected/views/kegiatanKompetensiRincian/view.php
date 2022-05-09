<?php
$this->breadcrumbs=array(
	'Kegiatan Kompetensi Rincian'=>array('admin'),
	'Detail',
);
?>

<h1>Komptensi Rincian : <b><?php echo $model->uraian; ?></b></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'type' => 'striped bordered condensed',
'attributes'=>array(
		array(
			'name' => 'id_kegiatan_kompetensi',
			'value' => $model->getRelation('kegiatan_kompetensi','uraian')),
		'uraian',
		'cpr',
		'fpr',
),
)); ?>
