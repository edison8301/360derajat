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
		<td style="font-weight: bold"><?= Helper::getTanggal($model->kegiatanInduk->tanggal_mulai).' s.d '.Helper::getTanggal($model->kegiatanInduk->tanggal_selesai); ?></td>
	</tr>

</table>

<div>&nbsp;</div>

