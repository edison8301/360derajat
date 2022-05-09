<?php
$this->breadcrumbs=array(
	'Profil'=>array('profil'),
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
							return CHtml::link('Link Login Menggunakan Token',['site/login','token'=>$data->token]);
						}
					]
			),
	)); ?>

	<?= CHtml::link('<i class="glyphicon glyphicon-refresh"></i> Generate Token',['pegawai/generateToken','id'=>$model->id,'fromProfil'=>true],['class'=>'btn btn-success btn-raised','onclick'=>'return confirm("Yakin Akan Generate Token Ulang?")']) ?>
</div>