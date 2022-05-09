<?php
$this->breadcrumbs=array(
	'Kegiatan Kompetensi'=>array('admin'),
	'detail'
);

?>

<h1><?php echo $model->uraian; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'type' => 'striped bordered condensed',
'attributes'=>array(		
		array(
			'name' => 'id_kegiatan',
			'value' => $model->getRelation('kegiatan','nama')),
		'uraian',
		'cpr',
		'fpr',
),
)); ?>
