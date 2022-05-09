<style type="text/css">

.bg-blue-100 {
	background: #BBDEFB;
}

.rater
{
	float: left;
	width: 100%;
}

.esc
{
	float: left;
	width: 100%;	
	margin-top: 20px;
}

.esc td
{
	text-align: center;
}

.kbr
{
	float: left;
	width: 100%;	
	margin-top: 20px;
}

</style>

<?php

	$total_seluruh = 0;
	$cp_other = 0;
	$cp_all = 0;
	$cpr = 0;
	$gap = 0;
	$total_cpr =0;
	$total_fpr =0;

?>

<table>
	<tr>
		<th colspan="3" style="font-size: 15px">RATERS INPUT FOR SPECIFIC TARGET</th>
	</tr>
	<tr>
		<td style="font-weight: bold">Tanggal Survey</td>
		<td style="font-weight: bold">:</td>
		<td style="font-weight: bold"><?= Helper::getTanggal($model->kegiatanInduk->tanggal_mulai); ?></td>
	</tr>
	<tr>
		<td style="font-weight: bold">Target Job</td>
		<td style="font-weight: bold">:</td>
		<td style="font-weight: bold"><?= $model->kegiatanInduk->target ?></td>
	</tr>

</table>

<div>&nbsp;</div>

<?php foreach($model->findAllKompetensi() as $kompetensi) { ?>


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
	
	<?php $i=1; foreach($kompetensi->findAllRincian() as $rincian) { ?>
	<tr>
		<td width="30px" style="text-align:center"><?= $i; ?></td>
		<td><?= $rincian->uraian; ?></td>
		<?php foreach($model->findAllPenilai() as $penilai) { ?>
		<td style="text-align:center"><?= $rincian->getCpByIdPenilai($penilai->id); ?>&nbsp;</td>
		<td style="text-align:center"><?= $rincian->getCprByIdPenilai($penilai->id); ?>&nbsp;</td>

		<?php

		$total_cpr = $total_cpr + $rincian->getCpByIdPenilai($penilai->id);
		$total_fpr = $total_fpr + $rincian->getCprByIdPenilai($penilai->id);
		?>

		<?php } ?>		
	</tr>	
	<?php $i++; } ?>
</table>

</div>

<div class="esc">

<?php 

$jumlah_rincian = $model->countAllRincian();
$jumlah_rater = $model->countAllPenilai();
$total_seluruh = $total_cpr + $total_fpr;


$pembagi = $jumlah_rincian*$jumlah_rater;
if($pembagi == 0){
	$cpall_nilai = 0;
	$cpr_nilai = 0;
}
else
{
	$cpall_nilai = $total_cpr/($pembagi);
	$cpr_nilai = $total_fpr/($pembagi);
}

$total_gap = $cpall_nilai - $cpr_nilai;

$jumlah_rater_exc_self = $model->countExcSelf();

if($gap >= 1) 
{
	$status = "STRENGTH";
}
elseif(1 > $gap AND $gap > -1)
{
	$status = "MEET EXPECTATION";
}
elseif($gap <= -1)
{
	$status = "DEVELOPMENTAL AREA";
}
elseif($gap == null)
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
		<td style="text-transform: uppercase;">Kerjasama</td>
		<td><?= $jumlah_rincian; ?></td>
		<td><?= $jumlah_rater_exc_self; ?></td>
		<td><?= $cpall_nilai; ?></td>
		<td><?= number_format($cpr_nilai); ?></td>
		<td><?= number_format($total_gap); ?></td>
	</tr>

	<tr class="bg-blue-100">
		<td style="text-transform: uppercase; font-weight: bold">Kategori</td>
		<td colspan="2" style="text-transform: uppercase; font-weight: bold">kriteria</td>
		<td colspan="3" style="text-transform: uppercase; font-weight: bold">gap kompetensi</td>
	</tr>
	<tr>
		<td style="text-transform: uppercase;">Strength</td>
		<td colspan="2">gap >=1</td>
		<td colspan="3" rowspan="3">developmental area (statis)</td>
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
		<td style="text-transform: uppercase">cp superior</td>
		<td>2 (statis)</td>
	</tr>
	<tr>
		<td style="text-transform: uppercase">cp self</td>
		<td>2 (statis)</td>
	</tr>
	<tr>
		<td style="text-transform: uppercase">cp others</td>
		<td>2 (statis)</td>
	</tr>

</table>

</div>

<div class="kbr">



<table width="100%" border="1" style="border-collapse: collapse" cellpadding="3">
	<tr class="bg-blue-100">	
		<th style="text-transform: uppercase" colspan="8">key behavior report</th>
	</tr>
	<tr class="bg-blue-100">
		<th style="text-align:center;text-transform:uppercase;vertical-align:middle" rowspan="2">No. Item</th>
		<th style="text-align:center;text-transform:uppercase;vertical-align:middle" rowspan="2">jml rater all</th>
		<th style="text-transform: uppercase" colspan="6">nilai</th>
	</tr>
	<tr class="bg-blue-100">
		<th style="text-transform: uppercase">self</th>
		<th style="text-transform: uppercase">Cp Spr</th>
		<th style="text-transform: uppercase">Cp Oth</th>
		<th style="text-transform: uppercase">Cp All</th>
		<th style="text-transform: uppercase">CPR</th>
		<th style="text-transform: uppercase">GAP</th>
	</tr>
	<?php foreach($kompetensi->findAllRincian() as $rincian) { ?>
	<?php

		foreach($model->findAllExcSelf() as $excSelf)
		{
			$cp_all = $cp_all + $rincian->getCpByIdPenilai($excSelf->id)/$jumlah_rater;
			$cpr = $cpr + $rincian->getCprByIdPenilai($excSelf->id)/$jumlah_rater;
		}

		foreach($model->findAllPenilaiOther() as $other)
		{
			$cp_other = ($cp_other + $rincian->getCprByIdPenilai($other->id)/$jumlah_rater)-1;
		}

		foreach($model->findAllPenilaiPeran(1) as $penilaiSelf)
		{
			$cp_self = $rincian->getCprByIdPenilai($penilaiSelf->id);
		}

	$gap = $cpr-$cp_all;
	 ?>
	<tr>
		<td><?= $rincian->uraian; ?></td>
		<td style="text-align: center"><?= number_format($jumlah_rater,2); ?></td>
		<td style="text-align: center"><?= number_format($cp_self,2); ?></td>
		<td style="text-align: center"><?= number_format($rincian->getCprByIdPenilai($penilai->id),2); ?></td>
		<td style="text-align: center"><?= number_format($cp_other,2); ?></td>
		<td style="text-align: center"><?= number_format($cp_all,2); ?></td>
		<td style="text-align: center"><?= number_format($cpr,2); ?></td>
		<td style="text-align: center"><?= number_format($gap,2); ?></td>
	</tr>
	<?php } ?>
</table>


</div>


<?php } ?>

