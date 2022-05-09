<div class="rater">

<div style="text-transform: uppercase; font-weight: bold">Kompetensi : <?= $kompetensi->uraian; ?></div>
<table width="100%" border="1" style="border-collapse: collapse" cellpadding="3">
	<thead class="bg-blue-100">
	<tr class="bg-blue-100">
		<th style="text-align:center;text-transform:uppercase;vertical-align:middle" rowspan="3" colspan="2">Item Pertanyaan</th>
		<th colspan="<?php print $model->countPenilai()*2; ?>" style="text-align:center;text-transform:uppercase;vertical-align:middle">Rater</th>
	</tr>
	<tr class="bg-blue-100">
		<?php foreach($model->findAllPenilai() as $penilai) { ?>
		<th colspan="2" style="text-align:center; width: 50px"><?php print $penilai->getRelation('penilai_peran','nama'); ?></th>
		<?php } ?>
	</tr>
	<tr class="bg-blue-100">
		<?php foreach($model->findAllPenilai() as $penilai) { ?>
		<th style="text-align:center" width="25px">CP</th>
		<th style="text-align:center" width="25px">CPR</th>

		<?php } ?>
	</tr>
	</thead>
    <?php
        $total_cp = 0;
        $total_cpr = 0;
        $jumlah_rincian = 0;
    ?>
	<?php $i=1; foreach($kompetensi->findAllRincian() as $rincian) { ?>
	<tr>
		<td width="30px" style="text-align:center"><?= $i; ?></td>
		<td><?= $rincian->uraian; ?></td>
		<?php $x=1;foreach($model->findAllPenilai() as $penilai) { ?>
		<td style="text-align:center"><?= $rincian->getCpByIdPenilai($penilai->id); ?>&nbsp;</td>
		<td style="text-align:center"><?= $rincian->getCprByIdPenilai($penilai->id); ?>&nbsp;</td>

		<?php

		if (!($model->hasPenilaiSelf() AND $x == 1)) {
			$total_cp += $rincian->getCpByIdPenilai($penilai->id);
			$total_cpr += $rincian->getCprByIdPenilai($penilai->id);
		}
		$x++;
		?>

		<?php } ?>		
	</tr>	
	<?php $i++;  $jumlah_rincian++; } ?>
</table>

</div>

<div class="esc">

<?php 
	$jumlah_rater = $model->countAllPenilai();
	$jumlah_rater_exc_self = $model->countExcSelf();
	$jumlah_rincian = $kompetensi->countAllRincian();

	$total_seluruh = $total_cp + $total_cpr;

	$pembagi = $jumlah_rincian*$jumlah_rater_exc_self;
	if($pembagi == 0){
		$cpall_nilai = 0;
		$cpr_nilai = 0;
	}
	else
	{
		$cpall_nilai = $total_cp/($pembagi);
		$cpr_nilai = $total_cpr/($pembagi);
	}

	$total_gap =  $cpall_nilai - $cpr_nilai;

	if($total_gap >= 1) 
	{
		$status = "STRENGTH";
	}
	elseif(1 > $total_gap AND $total_gap > -1)
	{
		$status = "MEET EXPECTATION";
	}
	elseif($total_gap <= -1)
	{
		$status = "DEVELOPMENTAL AREA";
	}
	elseif($total_gap == null)
	{
		$status = "";
	}
?>


<table width="100%" border="1" style="border-collapse: collapse" cellpadding="3" cellpadding="2">
	<tr class="bg-blue-100">
		<th colspan="6">EXECUTIVE SUMMARY COMPETENCY</th>
	</tr>
	<tr class="bg-blue-100">
		<th style="text-align:center;text-transform:uppercase;vertical-align:middle" rowspan="2">kompetensi</th>
		<th style="text-align:center;text-transform:uppercase;vertical-align:middle" rowspan="2">Jumlah Item</th>
		<th style="text-align:center;text-transform:uppercase;vertical-align:middle" rowspan="2">Rater exc Self</th>
		<th colspan="3" style="text-align:center;text-transform:uppercase;">Nilai</th>
	</tr>
	<tr class="bg-blue-100">
		<th style="text-align:center;text-transform:uppercase;">cp all</th>
		<th style="text-align:center;text-transform:uppercase;">cpr</th>
		<th style="text-align:center;text-transform:uppercase;">gap</th>
	</tr>

	<tr>
		<td style="text-transform: uppercase;"><?= $kompetensi->uraian; ?></td>
		<td><?= $jumlah_rincian; ?></td>
		<td><?= $jumlah_rater_exc_self; ?></td>
		<td><?=number_format($cpall_nilai,2); ?></td>
		<td><?= number_format($cpr_nilai,2); ?></td>
		<td><?= number_format($total_gap,2); ?></td>
	</tr>

	<tr class="bg-blue-100">
		<td style="text-transform: uppercase; font-weight: bold">Kategori</td>
		<td colspan="2" style="text-transform: uppercase; font-weight: bold">kriteria</td>
		<td colspan="3" style="text-transform: uppercase; font-weight: bold">gap kompetensi</td>
	</tr>
	<tr>
		<td style="text-transform: uppercase;">Strength</td>
		<td colspan="2">GAP >=1</td>
		<td colspan="3" rowspan="3"><?= $status ?></td>
	</tr>
	<tr>
		<td style="text-transform: uppercase;">Meet Expectation</td>
		<td colspan="2">1 > GAP > -1</td>		
	</tr>
	<tr>
		<td style="text-transform: uppercase;">Developmental Area</td>
		<td colspan="2">GAP &lt;= -1</td>		
	</tr>
	<tr >
		<th colspan="2" style="text-transform: uppercase; " class="bg-blue-100">jumlah lainnya</th>
	</tr>
	<tr>
		<td style="text-transform: uppercase">cp self</td>
		<td><?php //number_format($kompetensi->getAverageCpByIdPeran(KegiatanPenilai::PERAN_SELF,$kompetensi->id),2) ?></td>
	</tr>
	<tr>
		<td style="text-transform: uppercase">cp superior</td>
		<td><?php //number_format($kompetensi->getAverageCpByIdPeran(KegiatanPenilai::PERAN_SUPERIOR,$kompetensi->id),2) ?></td>
	</tr>
	<tr>
		<td style="text-transform: uppercase">cp peer</td>
		<td><?php //number_format($kompetensi->getAverageCpByIdPeran(KegiatanPenilai::PERAN_PEER,$kompetensi->id),2) ?></td>
	</tr>
	<tr>
		<td style="text-transform: uppercase">cp sub</td>
		<td><?php //number_format($kompetensi->getAverageCpByIdPeran(KegiatanPenilai::PERAN_SUB,$kompetensi->id),2) ?></td>
	</tr>

</table>

</div>

<div class="kbr">

<table class="print-friendly" width="100%" border="1" style="border-collapse: collapse" cellpadding="3">
	<thead>
		<tr class="bg-blue-100">	
			<th style="text-transform: uppercase" colspan="9">key behavior report</th>
		</tr>
		<tr class="bg-blue-100">
			<th style="text-align:center;text-transform:uppercase;vertical-align:middle" rowspan="2">No. Item</th>
			<th style="text-align:center;text-transform:uppercase;vertical-align:middle" rowspan="2">jml rater all</th>
			<th style="text-transform: uppercase" colspan="7">nilai</th>
		</tr>
		<tr class="bg-blue-100">
			<th style="text-transform: uppercase">self</th>
			<th style="text-transform: uppercase">Cp Spr</th>
			<th style="text-transform: uppercase">Cp Peer</th>
			<th style="text-transform: uppercase">Cp Sub</th>
			<th style="text-transform: uppercase">Cp All</th>
			<th style="text-transform: uppercase">CPR</th>
			<th style="text-transform: uppercase">GAP</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($kompetensi->findAllRincian() as $rincian) { ?>
		<tr>
			<td><?= $rincian->uraian; ?></td>
			<td style="text-align: center"><?= $model->countAllPenilai(); ?></td>
			<td style="text-align: center"><?php //number_format($rincian->getCp(1),2); ?></td>
			<td style="text-align: center"><?php //number_format($rincian->getCp(2),2); ?></td>
			<td style="text-align: center"><?php //number_format($rincian->getCp(3),2); ?></td>
			<td style="text-align: center"><?php //number_format($rincian->getCp(4),2); ?></td>
			<td style="text-align: center"><?php //number_format($rincian->getCp(),2); ?></td>
			<td style="text-align: center"><?php //number_format($rincian->getCpr(),2); ?></td>
			<td style="text-align: center"><?php //number_format($rincian->getCp()-$rincian->getCpr(),2); ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

</div>