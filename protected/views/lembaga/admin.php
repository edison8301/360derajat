<?php
$this->breadcrumbs=array(
	'Lembaga'=>array('admin'),
	'Kelola Lembaga',
);


?>

<h1>Kelola Lembaga</h1>

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah Lembaga',
		'icon'=>'plus',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'context'=>'primary',
		'url'=>array('create')
)); ?>&nbsp;

<div>&nbsp;</div>

<div class="well">
	<?php $this->widget('booster.widgets.TbGridView',array(
			'id'=>'lembaga-grid',
			'type'=>'striped bordered condensed',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				array(
					'header'=>'No',
					'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1',
					'headerHtmlOptions'=>array('style'=>'width:5%;text-align:center'),
					'htmlOptions'=>array('style'=>'width:5%;text-align:center'),
				),
				'nama',
				'alamat',
				'telepon',
				array(
					'class'=>'booster.widgets.TbButtonColumn',
				),
			),
	)); ?>
</div>
