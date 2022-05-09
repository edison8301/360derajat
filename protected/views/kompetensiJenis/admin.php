<?php
$this->breadcrumbs=array(
	'Jenis Kompetensi'=>array('index'),
	'Manage',
);

?>

<h1>Kelola Jenis Kompetensi</h1>

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tampilkan Seluruh Kompetensi',
		'icon'=>'list',
		'context'=>'warning',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'url'=>array('kompetensi/admin')
)); ?>&nbsp;
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah Jenis Kompetensi',
		'icon'=>'plus',
		'context'=>'primary',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'url'=>array('create')
)); ?>&nbsp;

<div>&nbsp;</div>

<div class="well">
	<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'kompetensi-jenis-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			array(
				'header'=>'No',
				'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1',
				'headerHtmlOptions'=>array('style'=>'width:5%;text-align:center'),
				'htmlOptions'=>array('style'=>'width:5%;text-align:center'),
			),
			array(
				'name'=>'nama',
				'type'=>'raw',
				'value'=>'CHtml::link($data->nama,["view","id"=>$data->id])',
			),
			array(
			'class'=>'booster.widgets.TbButtonColumn',
			),
		),
	)); ?>
	
</div>
