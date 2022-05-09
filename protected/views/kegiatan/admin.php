<?php
$this->breadcrumbs=array(
	'Kegiatan'=>array('admin'),
	'Kelola',
);

?>

<h1>Daftar Kegiatan</h1>

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah Kegiatan',
		'icon'=>'plus',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'context'=>'primary',
		'url'=>array('create')
)); ?>&nbsp;

<div>&nbsp;</div>

<div class="well">

<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'kegiatan-grid',
		'type' => 'striped bordered condensed',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
				array(
					'header'=>'No',
					'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1',
					'headerHtmlOptions'=>array('style'=>'width:30px;text-align:center'),
					'htmlOptions'=>array('style'=>'width:30px;text-align:center'),
				),
				array(
					'name'=>'kode',
					'header'=>'Kode',
					'headerHtmlOptions'=>['style'=>'width:120px;text-align:center'],
					'htmlOptions'=>['style'=>'text-align:center'],
				),
				[
					'name'=>'nama',
					'headerHtmlOptions'=>['style'=>'text-align:center'],
					'htmlOptions'=>['style'=>'text-align:left'],
				],
				array(
					'name' => 'tanggal_mulai',
					'value' => 'Helper::getTanggal($data->tanggal_mulai)',
					'headerHtmlOptions'=>array('style'=>'text-align:center'),
					'htmlOptions'=>array('style'=>'text-align:center'),
				),
				array(
					'name' => 'tanggal_selesai',
					'value' => 'Helper::getTanggal($data->tanggal_selesai)',
					'headerHtmlOptions'=>array('style'=>'text-align:center'),
					'htmlOptions'=>array('style'=>'text-align:center'),
				),
				'keterangan',
				/*
				'id_kegiatan_status',
				*/
		array(
		'class'=>'booster.widgets.TbButtonColumn',
		),
		),
)); ?>
</div>