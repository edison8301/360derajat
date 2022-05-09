<h1>Pilih Kompetensi</h1>

<div class="well">

	<?php print CHtml::beginForm(array('kegiatan/saveBankKompetensi','id_kegiatan'=>$id)); ?>


	<table class="table table-condensed table-stripped table-hover table-bordered table-striped">
		<thead>
		<tr>
			<th width="1%" style="text-align: center">No</th>
			<th>Uraian</th>
			<th width="15%"><?php print CHtml::checkBox('cek_semua'); ?> Ceklis Semua</th>
		</tr>
		</thead>
		<?php $i=1; foreach(Kompetensi::model()->findAll() as $kompetensi) { ?>
		<tr>
			<td><?= $i; ?></td>
			<td style="font-weight: bold"><?= $kompetensi->uraian; ?></td>
			<td><?php print CHtml::checkBox('Kompetensi['.$kompetensi->id.']',false); ?></td>
		</tr>

		<?php foreach(KompetensiRincian::model()->findAllByAttributes(array('id_kompetensi'=>$kompetensi->id)) as $rincian) { ?>
		<tr>
			<td>&nbsp;</td>
			<td>--<?= $rincian->uraian; ?></td>
			<td></td>
		</tr>	
		<?php } ?>
		<?php $i++; } ?>
	</table>

	<div>&nbsp;</div>

	<div style="text-align: right">

				<?php $this->widget('booster.widgets.TbButton',array(
						'buttonType'=>'submit',
						'htmlOptions'=>array('class'=>'dim'),
						'htmlOptions'=>array('class'=>'btn-raised'),
						'context'=>'success',
						'label'=>'Simpan',
						'icon'=>'ok'
				)); ?> &nbsp;
	</div>	

</div>
	<?php print CHtml::endForm(); ?>



	<!-- print CHtml::checkBox('RoleAkses['.$data->id.']',$akses->cekAksesLink($_GET['id'])); -->


	<script>

 $("#cek_semua").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });

</script>