<?php
$this->breadcrumbs=array(
	'Kompetensi'=>array('kompetensi/admin'),
	'Detail Kompetensi'=>array('kompetensi/view','id'=>$model->id_kompetensi),
	'Kompetensi Rincian'
);

$this->menu=array();
?>

<h1>Detail Kompetensi Rincian</h1>

	<?php $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Detail '.$model->getRelation('kompetensi','uraian'),
			'icon'=>'list',
			'context'=>'primary',
			'htmlOptions' => array('class'=>'btn-raised'),
			'url'=>array('kompetensi/view','id'=>$model->id_kompetensi)
	)); ?>&nbsp;

<div>&nbsp;</div>

<div class="well">

	<?php $this->widget('booster.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(		
			array(
				'name' => 'id_kompetensi',
				'value' => $model->getRelation('kompetensi','uraian')),
			'uraian',
	),
	)); ?>
</div>
