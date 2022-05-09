<?php
$this->breadcrumbs=array(
	'Kompetensi'=>array('admin'),
	'Detail Kompetensi'
);
?>

<h1>Kompetensi </h1>

<div class="well">

<?php $this->widget('booster.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => 'striped bordered condensed',
	'attributes'=>array(
			[
				'name'=>'id_kompetensi_jenis',
				'value'=>$model->getRelation("kompetensiJenis","nama"),
			],
			'level',
			'uraian',
	),
)); ?>

<div>&nbsp;</div>
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Kembali ke Jenis Kompetensi',
		'icon'=>'arrow-left',
		'context'=>'warning',
		'htmlOptions' => array('class'=>'btn-raised'),
		'url'=>array('kompetensiJenis/view','id'=>$model->id_kompetensi_jenis)
)); ?>&nbsp;
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Daftar Seluruh Kompetensi',
		'icon'=>'list',
		'context'=>'success',
		'htmlOptions' => array('class'=>'btn-raised'),
		'url'=>array('admin')
)); ?>&nbsp;

<div>&nbsp;</div>
<hr>

<h3>Kompetensi Rincian</h3>



	<?php $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Tambah Data Rincian',
			'icon'=>'plus',
			'context'=>'primary',
			'htmlOptions' => array('class'=>'btn-raised'),
			'url'=>array('kompetensiRincian/create','id_kompetensi'=>$model->id)
	)); ?>&nbsp;

	<div>&nbsp;</div>

	<table class="table table-bordered table-condensed table-hover table-hover">
		<tr>
		<thead>
			<th style="width:4%;text-align:center">No</th>
			<th>Uraian</th>
			<th style="width: 8%">&nbsp;</th>
		</thead>
		</tr>	
		<?php $i=1; foreach($model->findAllKompetensiRincian() as $data) { ?>
		<tr>
			<td style="text-align:center"><?= $i; ?></td>
			<td><?= $data->uraian; ?></td>
			<td style="text-align:center">
				<?php print CHtml::link("<i class='glyphicon glyphicon-eye-open'></i>",array('kompetensiRincian/view','id'=>$data->id),array('class'=>'dim','data-toggle'=>'tooltip','title'=>'Lihat')); ?>
				<?php print CHtml::link("<i class='glyphicon glyphicon-pencil'></i>",array('kompetensiRincian/update','id'=>$data->id),array('class'=>'dim','data-toggle'=>'tooltip','title'=>'Sunting Data')); ?>
				<?php print CHtml::link("<i class='glyphicon glyphicon-trash'></i>",array('kompetensiRincian/directDelete','id'=>$data->id),array('class'=>'dim','data-toggle'=>'tooltip','title'=>'Hapus Data','onclick'=>'return confirm("Yakin akan menghapus data?")')); ?>	
			</td>
		</tr>

		<?php $i++; } ?>

	</table>
</div>