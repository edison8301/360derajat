<div>&nbsp;</div>


<h2>Penilaian <?php print $kegiatan->nama; ?></h2>

<?php print CHtml::beginForm(); ?>

<table class="table table-condensed table-stripped table-hover table-bordered">
<thead>
<tr>
	<th style="text-align: center" width="1%" style="text-align: center">No</th>
	<th style="text-align: center" width="59%">Uraian</th>
	<th style="text-align: center" width="40%" >Penilaian</th>
</tr>
</thead>
<?php $i=1; foreach($kegiatan->findAllKompetensi() as $kompetensi) { ?>
<tr>
	<td style="text-align: center"><?= $i; ?></td>
	<td style="font-weight: bold"><?= CHtml::link($kompetensi->uraian,array('kegiatanKompetensi/view','id'=>$kompetensi->id)); ?></td>
	<td>&nbsp;</td>
</tr>
<?php foreach($kompetensi->findAllRincian() as $rincian) { ?>
<tr>
	<td>&nbsp;</td>
	<td><?= $rincian->uraian; ?></td>
	<td style="text-align:center">			
		<?php echo CHtml::radioButtonList('KompetensiRincian['.$rincian->id.']',$rincian->getHasilByIdPenilai(Pegawai::getIdByUserId()),array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
			'10' => '10'
		),
		array( 'separator' => " | ")); ?>
	</td>		
</tr>	

<?php } //endforeach rincian ?>
<?php $i++; } //endforeach kompetensi ?>
</table>


<div>&nbsp;</div>

<div class="well" style="text-align: right">

			<?php $this->widget('booster.widgets.TbButton',array(
					'buttonType'=>'submit',
					'htmlOptions'=>array('class'=>'dim'),
					'context'=>'success',
					'label'=>'Kirim Penilaian',
					'icon'=>'ok'
			)); ?>

</div>



<?php print CHtml::endForm(); ?>

