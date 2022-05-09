
<h3>Daftar Kompetensi</h3>

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah Kompetensi',
		'icon'=>'plus',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'context'=>'primary',
		'url'=>array('kegiatanKompetensi/create','id_kegiatan'=>$model->id)
)); ?>&nbsp;

<?php
/* $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah Dari Bank Kompetensi',
		'icon'=>'plus',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'context'=>'primary',
		'url'=>array('kegiatan/bankKompetensi','id'=>$model->id)
)); */
?>&nbsp;

<?php $this->widget('booster.widgets.TbButton', array(
		'buttonType'=>'link',
		'url'=>'#',
		'icon'=>'plus',
		'context'=>'success',
		'label'=>'Tambah Dari Bank Kompetensi',
		'htmlOptions'=>array(
			'class'=>'btn-raised',
			'onclick'=>'$("#bankKompetensi").modal("show"); return false;',
		),
		
)); ?>
<div>&nbsp;</div>

<table class="table table-condensed table-hover table-bordered">
	<thead>
	<tr>
		<th width="5%">&nbsp;</th>
		<th width="1%" style="text-align: center">No</th>
		<th>Uraian</th>
		<th style="text-align:center" width="8%">CPRO</th>
		<th style="text-align:center" width="8%">FPRO</th>
	</tr>
	</thead>
	<?php $i=1; foreach($model->findAllKompetensi() as $kompetensi) { ?>
	<tr class="info">
		<th>
			<?php $this->widget('booster.widgets.TbButtonGroup',array(
				'size'=>'small',
	        	'context'=>'primary',
	            'encodeLabel'=>false,
	       	 	'buttons' => array(
	            	array(
	                	'label' => '',
	                	'items' => array(
	                        array(
	                        	'label' => '<i class="glyphicon glyphicon-plus"></i> Tambah Rincian', 
	                        	'url'=>array('kegiatanKompetensiRincian/create','id_kegiatan_kompetensi'=>$kompetensi->id),
	                        ),
							array(
								'label' => '<i class="glyphicon glyphicon-pencil"></i> Sunting', 
								'url'=>array('kegiatanKompetensi/update','id'=>$kompetensi->id),
							),
							array(
								'label' => '<i class="glyphicon glyphicon-trash"></i> Hapus', 
								'url'=>array('kegiatanKompetensi/directDelete','id'=>$kompetensi->id),
								'linkOptions'=>array('onclick'=>'return confirm("Yakin akan menghapus Kompetensi?")')
							),
	                    )
	            	),
	        	),
			)); ?>
			
		</th>
		<th style="text-align:center"><?= $i; ?></th>
		<th style="font-weight: bold"><?= $kompetensi->uraian; ?></th>
		<th style="text-align:center"><?= $kompetensi->cpro; ?></th>
		<th style="text-align:center"><?= $kompetensi->fpro; ?></th>
	</tr>

	<?php foreach($kompetensi->findAllRincian() as $rincian) { ?>
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
								'url'=>array('kegiatanKompetensiRincian/update','id'=>$rincian->id),
							),
							array(
								'label' => '<i class="glyphicon glyphicon-trash"></i> Hapus', 
								'url'=>array('kegiatanKompetensiRincian/directDelete','id'=>$rincian->id),
								'linkOptions'=>array('onclick'=>'return confirm("Yakin akan menghapus Rincian Kompetensi?")')
							),
	                    )
	            	),
	        	),
			)); ?>
		</td>
		<td>&nbsp;</td>
		<td><?= $rincian->uraian; ?></td>
		<td style="text-align:center">&nbsp;</td>
		<td style="text-align:center">&nbsp;</td>
	</tr>	
	<?php } ?>
	<?php $i++; } ?>
</table>

<?php  $this->renderPartial('_bank_kompetensi_modal',['model'=>$model]); ?>