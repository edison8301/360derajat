<?php
$this->breadcrumbs=array(
	'Kompetensi'=>array('admin'),
	'Kelola',
);

$this->menu=array(
array('label'=>'List Kompetensi','url'=>array('index')),
array('label'=>'Create Kompetensi','url'=>array('create')),
);

?>

<h1>Bank Kompetensi</h1>

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah Kompetensi',
		'icon'=>'plus',
		'context'=>'primary',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'url'=>array('create')
)); ?>&nbsp;
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Kelola Jenis Kompetensi',
		'icon'=>'refresh',
		'context'=>'warning',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'url'=>array('kompetensiJenis/admin')
)); ?>&nbsp;

<div>&nbsp;</div>

<div class="well">

<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'kompetensi-grid',
		'type' => 'striped bordered condensed',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'ajaxUpdate'=>false,
		'columns'=>array(		
			array(
				'header'=>'No',
				'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1',
				'headerHtmlOptions'=>array('style'=>'width:5%;text-align:center'),
				'htmlOptions'=>array('style'=>'width:5%;text-align:center'),
			),
			array(
				'name'=>'id_kompetensi_jenis',
				'filter' => KompetensiJenis::getList(),
		        'htmlOptions'=>['class'=>'input-field'],
				'value'=>'$data->getRelation("kompetensiJenis","nama")',
			),

			array(
				'name'=>'level',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			'uraian',
			array(
				'class'=>'booster.widgets.TbButtonColumn',
			),
		),
)); ?>