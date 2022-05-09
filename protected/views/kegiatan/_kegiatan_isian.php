
<h3>Daftar Hasil Isian</h3>



<table class="table table-condensed table-hover table-bordered">
	<thead>
	<tr>
		<th width="1%" style="text-align: center;text-transform:uppercase;vertical-align:middle" rowspan="3">No</th>
		<th style="text-align:center;text-transform:uppercase;vertical-align:middle" rowspan="3">Item Pertanyaan</th>
		<th style="text-align:center;text-transform:uppercase;vertical-align:middle" rowspan="3">CPRO</th>
		<th style="text-align:center;text-transform:uppercase;vertical-align:middle" rowspan="3">FPRO</th>
		<th colspan="<?php print $model->countPenilai()*2; ?>" style="text-align:center;text-transform:uppercase;vertical-align:middle">Rater</th>
	</tr>
	<tr>
		<?php foreach($model->findAllPenilai() as $penilai) { ?>
		<th colspan="2" style="text-align:center"><?php print $penilai->getRelation('penilai_peran','nama'); ?></th>
		<?php } ?>
	</tr>
	<tr>
		<?php foreach($model->findAllPenilai() as $penilai) { ?>
		<th style="text-align:center" width="25px">CP</th>
		<th style="text-align:center" width="25px">CPR</th>
		<?php } ?>
	</tr>
	</thead>
	<?php $i=1; foreach($model->findAllKompetensi() as $kompetensi) { ?>
	<tr class="info">
		<th style="text-align:center;"><?= $i; ?></th>
		<th style="font-weight: bold"><?= $kompetensi->uraian; ?></th>
		<th style="text-align:center"><?= $kompetensi->cpro; ?></th>
		<th style="text-align:center"><?= $kompetensi->fpro; ?></th>
		<?php foreach($model->findAllPenilai() as $penilai) { ?>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<?php } ?>
	</tr>

	<?php foreach($kompetensi->findAllRincian() as $rincian) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><?= $rincian->uraian; ?></td>
		<td style="text-align:center"><?= $rincian->cpro; ?></td>
		<td style="text-align:center"><?= $rincian->fpro; ?></td>
		<?php foreach($model->findAllPenilai() as $penilai) { ?>
		<td style="text-align:center"><?= $rincian->getCpByIdPenilai($penilai->id); ?>&nbsp;</td>
		<td style="text-align:center"><?= $rincian->getCprByIdPenilai($penilai->id); ?>&nbsp;</td>
		<?php } ?>
		
	</tr>	
	<?php } ?>
	<?php $i++; } ?>
</table>