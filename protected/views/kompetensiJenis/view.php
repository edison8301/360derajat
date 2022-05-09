<?php
$this->breadcrumbs=array(
	'Jenis Kompetensi'=>array('admin'),
);
?>

<h1>Detail Kompetensi: <?php echo $model->nama; ?></h1>

<div class="well">
	<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
			'nama',
		),
	)); ?>
	<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Sunting',
		'icon'=>'pencil',
		'context'=>'primary',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'url'=>array('update','id'=>$model->id)
	)); ?>&nbsp;

	<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Kembali',
		'icon'=>'arrow-left',
		'context'=>'warning',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'url'=>array('admin')
	)); ?>&nbsp;
</div>

<h2>Daftar Kompetensi</h2>
<div class="well">
	<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah Kompetensi',
		'icon'=>'plus',
		'context'=>'success',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'url'=>array('kompetensi/create','id_kompetensi_jenis'=>$model->id),
	)); ?>&nbsp;
	<table class="table table-hover">
		<tr>
			<th>No</th>
			<th>Kompetensi</th>
			<th style="width: 8%"></th>
		</tr>
		<?php $i=1;foreach ($model->findAllKompetensi() as $kompetensi) { ?>
			<tr>
				<td style="text-align: center"><?= $i++ ?></td>
				<td><?= CHtml::link($kompetensi->getUraianLengkap(),['kompetensi/view','id'=>$kompetensi->id]) ?></td>
				<td>
					<?= CHtml::link('<i class="glyphicon glyphicon-eye-open"></i>',['kompetensi/view','id'=>$kompetensi->id],['data-toggle'=>'tooltip','title'=>'Detail']) ?>
					<?= CHtml::link('<i class="glyphicon glyphicon-pencil"></i>',['kompetensi/update','id'=>$kompetensi->id],['data-toggle'=>'tooltip','title'=>'Sunting']) ?>
					<?= CHtml::link('<i class="glyphicon glyphicon-trash"></i>',['kompetensi/delete','id'=>$kompetensi->id],['data-toggle'=>'tooltip','title'=>'Hapus']) ?>
				</td>
			</tr>
		<?php } ?>
	</table>
</div>