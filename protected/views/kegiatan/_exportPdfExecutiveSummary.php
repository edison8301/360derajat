<div class="rater">

<div style="text-transform: uppercase; font-weight: bold">Kompetensi : <?= $kompetensi->uraian; ?></div>
</div>

<div class="esc">

<?php 
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
		<td style="text-transform: uppercase">cp superior</td>
		<td><?= $model->getAverageCpByIdPeran(KegiatanPenilai::PERAN_SUPERIOR,$kompetensi->id) ?></td>
	</tr>
	<tr>
		<td style="text-transform: uppercase">cp self</td>
		<td><?= $model->getAverageCpByIdPeran(KegiatanPenilai::PERAN_SELF,$kompetensi->id) ?></td>
	</tr>
	<tr>
		<td style="text-transform: uppercase">cp others</td>
		<td><?= $model->getAverageCpByIdPeran(KegiatanPenilai::PERAN_OTHERS,$kompetensi->id) ?></td>
	</tr>

</table>

</div>
<html>
<head>