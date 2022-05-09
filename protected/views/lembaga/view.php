<?php
$this->breadcrumbs=array(
	'Lembaga'=>array('admin'),
	$model->nama,
);

?>

<h1>Lihat Lembaga</h1>

<div class="well">

	<?php $this->widget('booster.widgets.TbDetailView',array(
			'data'=>$model,
			'attributes'=>array(
					'nama',
					'alamat',
					'telepon',
			),
	)); ?>

	<div>&nbsp;</div>
	
	<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Sunting',
		'icon'=>'pencil',
		'context'=>'primary',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'url'=>array('update','id'=>$model->id)
)); ?>&nbsp;


</div>
