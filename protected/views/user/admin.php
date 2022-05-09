<?php
$this->breadcrumbs=array(
	'User'=>array('admin'),
	'Kelola',
);

?>

<h1>Kelola User</h1>

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah User',
		'icon'=>'plus',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'context'=>'primary',
		'url'=>array('create')
)); ?>&nbsp;

<div>&nbsp;</div>

<div class="well">

<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'user-grid',
		'type' => 'striped bordered condensed',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(		
			array(
				'header'=>'No',
				'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1',
				'headerHtmlOptions'=>array('style'=>'width:5%;text-align:center'),
				'htmlOptions'=>array('style'=>'width:5%;text-align:center'),
			),
			'username',
			[
				'name'=>'role_id',
				'value'=>'$data->getNamaRole()',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			],
			[
				'type'=>'raw',
				'header' => 'Set Password',
				'headerHtmlOptions' => array('style'=>'width: 10%'),
				'value'=>'CHtml::link("<i class=\"glyphicon glyphicon-lock\"></i>",array("user/setPassword","id"=>"$data->id"),array("data-toggle"=>"tooltip","title"=>"Set Password"))',
				'htmlOptions'=>array('style'=>'text-align:center')
			],
			[
				'class'=>'booster.widgets.TbButtonColumn',
			],
		),
	)
); ?>

</div>