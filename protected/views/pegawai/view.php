<?php
$this->breadcrumbs=array(
	'Pegawai'=>array('admin'),
	'Detail Pegawai'
);

?>

<h1><?php echo $model->nama; ?></h1>

<div class="well">

	<?php $this->widget('booster.widgets.TbDetailView',array(
			'data'=>$model,
			'type' => 'striped bordered condensed',
			'attributes'=>array(		
					'nama',
					'username',
					[
						'label'=>'Lembaga',
						'value'=>$model->getRelation('lembaga','nama')
					],
					[
						'name'=>'token',
						'type'=>'raw',
						'value'=>function($data){
							return CHtml::link('Link Login Menggunakan Token',['site/login','token'=>$data->token],['id'=>'foo']);
						}
					]
			),
	)); ?>

	<div>&nbsp;</div>

	<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Sunting',
		'icon'=>'pencil',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'context'=>'primary',
		'url'=>array('update','id'=>$model->id)
	)); ?>&nbsp;

	<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Set Password',
		'icon'=>'lock',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'context'=>'primary',
		'url'=>array('setPassword','id'=>$model->id)
	)); ?>&nbsp;

	<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Generate Token',
		'icon'=>'refresh',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'context'=>'warning',
		'url'=>array('generateToken','id'=>$model->id)
	)); ?>&nbsp;

</div>