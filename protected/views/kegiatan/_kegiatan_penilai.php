
<h3>Daftar Penilai</h3>

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah Data Penilai',
		'icon'=>'plus',
		'context'=>'primary',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'url'=>array('kegiatanPenilai/create','id'=>$model->id)
)); ?>&nbsp;

<div>&nbsp;</div>

<table class="table table-condensed table-stripped table-hover table-bordered">
	<tr>
	<thead>
		<th width="5%">&nbsp;</th>
		<th width="1%" style="text-align: center">No</th>
		<th>Nama Penilai</th>
		<th style="text-align:center">Peran</th>
		<th style="text-align:center">Jabatan</th>
		<th style="text-align:center">Unit</th>
		<th style="text-align:center">Instansi</th>
		<th style="text-align:center">Status Pengisian</th>
		<th style="text-align:center">Status Hitung</th>
		<th style="text-align:center">Uraian</th>
		<?php /*
		<th style="text-align:center">Nilai</th>
		*/ ?>
	</thead>
	</tr>
	<?php $i=1; foreach($model->findAllPenilai(0) as $data) { ?>
	<tr>
		<td>
			<?php $this->widget('booster.widgets.TbButtonGroup',array(
				'size'=>'small',
	        	'context'=>'primary',
	            'encodeLabel'=>false,
	       	 	'buttons' => array(
	            	array(
	                	'label' => '',
	                	'items' => array(
	                        array(
	                        	'label' => '<i class="glyphicon glyphicon-pencil"></i> Sunting', 
	                        	'url'=>array('kegiatanPenilai/update','id'=>$data->id)
	                        ),
							array(
								'label' => '<i class="glyphicon glyphicon-trash"></i> Hapus', 
								'url'=>array('kegiatanPenilai/directDelete','id'=>$data->id),
								'linkOptions'=>array('onclick'=>'return confirm("Yakin Akan Menghapus Penilai?")')
							),
							array(
								'label' => '<i class="glyphicon glyphicon-edit"></i> Ubah Status Hitung', 
								'url'=>array('kegiatanPenilai/ubahStatusHitung','id'=>$data->id),
								'linkOptions'=>array('onclick'=>'return confirm("Yakin Akan Mengubah Status Hitung?")')
							),
							array(
								'label' => '<i class="glyphicon glyphicon-star"></i> Lihat Penilaian', 
								'url'=>array('kegiatanPenilai/penilaian','id'=>$data->id,'id_kegiatan'=>$model->id),
								'visible'=>User::isSuperAdmin(),
							),
	                    )
	            	),
	        	),
			)); ?>
		</td>
		<td style="text-align:center"><?= $i; ?></td>
		<td><?= CHtml::link($data->getRelation('pegawai','nama'),array('pegawai/view','id'=>$data->id_pegawai)); ?></td>	
		<td style="text-align:center"><?= $data->getRelation('penilai_peran','nama'); ?></td>
		<td style="text-align:center"><?= $data->jabatan; ?></td>
		<td style="text-align:center"><?= $data->divisi; ?></td>
		<td style="text-align:center"><?= $data->departemen; ?></td>
		<td style="text-align:center">
			<?php print $data->getLabelStatusPengisian(); ?>
		</td>
		<td style="text-align: center;">
			<?= $data->getLabelStatusHitung() ?>
		</td>
		<td style="text-align: center;">
			<?= CHtml::link('<i class="glyphicon glyphicon-eye-open"></i>','#',[
				'title'=>'Lihat Uraian/Deskripsi',
				'data-toggle' => 'modal tooltip',
		        'data-target' => '#deskripsi-'.$data->id,
		    ]) ?>
		</td>


		<?php $this->beginWidget(
		    'booster.widgets.TbModal',
		    array('id' => 'deskripsi-'.$data->id)
		); ?>
		 
		    <div class="modal-header">
		        <a class="close" data-dismiss="modal">&times;</a>
		        <h4>Uraian / Deskripsi: <?= $data->getRelation('pegawai','nama') ?></h4>
		    </div>
		 
		    <div class="modal-body">
		        <p><?= $data->getUraianDeskripsi() ?></p>
		    </div>
		 
		    <div class="modal-footer">
		        <?php $this->widget(
		            'booster.widgets.TbButton',
		            array(
		                'context' => 'primary',
		                'label' => 'Save changes',
		                'url' => '#',
		                'htmlOptions' => array('data-dismiss' => 'modal','class'=>'btn-raised'),
		            )
		        ); ?>
		        <?php $this->widget(
		            'booster.widgets.TbButton',
		            array(
		                'label' => 'Close',
		                'url' => '#',
		                'htmlOptions' => array('data-dismiss' => 'modal','class'=>'btn-raised'),
		            )
		        ); ?>
		    </div>
		 
		<?php $this->endWidget(); ?>


		<?php /*
		<td style="text-align:center">
			<?php $this->widget('booster.widgets.TbButton',array(
					'buttonType'=>'link',
					'label'=>'Nilai',
					'icon'=>'ok',
					'context'=>'primary',
					'htmlOptions'=>array('class'=>'btn-raised'),
					'size' => 'extra_small',
					'url'=>array('kegiatanPenilai/penilaian','id_penilai'=>$data->id,'id_kegiatan'=>$model->id)
			)); ?>&nbsp;
		</td>
		*/ ?>
	</tr>

	<?php $i++; } ?>
</table>

<?php //print ord('Z'); ?>