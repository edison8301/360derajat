<?php
$this->breadcrumbs=array(
	'User'=>array('admin'),
	'Detail'
);
?>

<h1>User <b><?php echo $model->username; ?></b></h1>

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Sunting',
		'icon'=>'pencil',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'context'=>'primary',
		'url'=>array('update','id'=>$model->id)
)); ?>&nbsp;

<div>&nbsp;</div>

<div class="well">

	<?php $this->widget('booster.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => 'striped bordered condensed',
	'attributes'=>array(		
			'username',
			'password',
	),
	)); ?>

</div>