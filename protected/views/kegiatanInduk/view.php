<?php
$this->breadcrumbs=array(
	'Kegiatan Induk'=>array('admin'),
	$model->nama,
);

?>

<h1>Kegiatan : <b><?php echo $model->nama; ?></b></h1>

<div>&nbsp;</div>

<div class="well">

<?php $this->widget('booster.widgets.TbDetailView',array(
	'data'=>$model,
	'type' => 'striped bordered condensed',
	'attributes'=>array(
			'kode',
			'nama',
	        'target',
			array(
				'name' => 'tanggal_mulai',
				'value' => Helper::getTanggalSingkat($model->tanggal_mulai)
	        ),
			array(
				'name' => 'tanggal_selesai',
				'value' => Helper::getTanggalSingkat($model->tanggal_selesai)
	        ),
			'keterangan',
	        array(
	            'name' => 'id_kegiatan_status',
	            'type'=>'raw',
	            'value' => $model->getLabelKegiatanStatus()
	        ),
	        'bobot_self',
	        'bobot_spr',
	        'bobot_peer',
	        'bobot_sub'
	),
)); ?>

<div>&nbsp;</div>

<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'link',
		'url'=>['admin'],
		'icon'=>'list',
		'context'=>'warning',
		'label'=>'Daftar Kegiatan',
		'htmlOptions'=>array(
			'class'=>'btn-raised',
		),
)); ?> &nbsp;
<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'link',
		'url'=>['update','id'=>$model->id],
		'icon'=>'pencil',
		'context'=>'primary',
		'label'=>'Sunting Data',
		'htmlOptions'=>array(
			'class'=>'btn-raised',
		),
)); ?> &nbsp;
<?= $model->getButtonStatusKegiatan() ?>
<div>&nbsp;</div>
</div>

<div class="well">
	<h3>Target Penilaian</h3>
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'link',
			'url'=>['tambahTargetPenilaian','id'=>$model->id],
			'icon'=>'user',
			'context'=>'success',
			'label'=>'Tambah Target Penilaian',
			'htmlOptions'=>array(
				'class'=>'btn-raised',
			),
	)); ?>
	<table class="table table-hover">
	<thead>
		<tr>
			<th style="text-align: center;" width="5%">No</th>
			<th>Target</th>
			<th style="text-align: center;" width="8%"></th>
		</tr>
	</thead>
	<?php $i=1; foreach ($model->findAllKegiatan() as $kegiatan) { ?>
		<tr>
			<td style="text-align: center"><?= $i++ ?></td>
			<td><?= $kegiatan->getSelfNama() ?></td>
			<th style="text-align: center">
				<?= CHtml::link('<i class="glyphicon glyphicon-eye-open"></i>',['kegiatan/view','id'=>$kegiatan->id],['data-toggle'=>'tooltip','title'=>'Tampilkan Kegiatan']) ?>
				<?= CHtml::link('<i class="glyphicon glyphicon-pencil"></i>',['kegiatan/update','id'=>$kegiatan->id],['data-toggle'=>'tooltip','title'=>'Sunting Kegiatan']) ?>
				<?= CHtml::link('<i class="glyphicon glyphicon-trash"></i>',['kegiatan/directDelete','id'=>$kegiatan->id],['data-toggle'=>'tooltip','title'=>'Hapus Kegiatan','onclick'=>'return confirm("Yakin akan menghapus Kegiatan?")']) ?>
			</th>
		</tr>
	<?php } ?>
	</table>
</div>
