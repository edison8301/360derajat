<?php
$this->breadcrumbs=array(
	'Pegawai'=>array('admin'),
	'Kelola Pegawai',
);

?>

<h1>Daftar Pegawai</h1>

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah Pegawai',
		'icon'=>'plus',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'context'=>'primary',
		'url'=>array('create')
)); ?>&nbsp;

<div>&nbsp;</div>

<div class="well">

	<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'pegawai-grid',
		'dataProvider'=>$model->search(),
		'type' => 'striped bordered condensed',
		'filter'=>$model,
		'columns'=>array(
			array(
				'header'=>'No',
				'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1',
				'headerHtmlOptions'=>array('style'=>'width:5%;text-align:center'),
				'htmlOptions'=>array('style'=>'width:5%;text-align:center'),
			),
			'nama',
			array(
				'name'=>'username',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center')
			),
			array(
				'name'=>'id_lembaga',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
				'value'=>'$data->getRelation("lembaga","nama")',
				'htmlOptions'=>array('style'=>'text-align:center'),
				'filter'=>Lembaga::getList()
			),
			array(
				'type'=>'raw',
				'header' => 'Set Password',
				'headerHtmlOptions' => array('style'=>'width: 10%'),
				'value'=>'CHtml::link("<i class=\"glyphicon glyphicon-lock\"></i>",array("pegawai/setPassword","id"=>"$data->id"),array("data-toggle"=>"tooltip","title"=>"Set Password"))',
				'htmlOptions'=>array('style'=>'text-align:center')
			),

		array(
		'class'=>'booster.widgets.TbButtonColumn',
		),
		),
	)); ?>

</div>