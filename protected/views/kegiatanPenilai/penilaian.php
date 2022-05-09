<?php

$self = $model->findPenilaiSelf();

?>

<div>&nbsp;</div>

<div class="row">
	<div class="col-sm-12">
		<?= $model->getAlert() ?>
	</div>
</div>

<h1><?php print $model->getRelation('kegiatanInduk','nama'); ?></h1>

<?php if ($model->countRincian() == 0) { ?>
	<div class="alert alert-info" style="margin-top: 20px">
		Kegiatan ini Belum mempunyai Kompetensi	
	</div>
<?php } ?>



<div class="well">
	<div class="row">
		<div class="col-sm-6">
			<table class="table-condensed">
				<tr>
					<th>IDENTITAS YANG DINILAI</th>
				</tr>
				<tr>
					<td>Nama yang Dinilai</td>
					<td>:</td>
					<th><?= $model->getNamaPenilaiSelf(); ?></th>
				</tr>
				<tr>
					<td>Jabatan</td>
					<td>:</td>
					<th><?= $model->getJabatanPenilaiSelf(); ?></th>
				</tr>
				<tr>
					<td>Unit Kerja</td>
					<td>:</td>
					<th><?= $model->getDivisiPenilaiSelf(); ?></th>
				</tr>
				<tr>
					<td>Instansi</td>
					<td>:</td>
					<th><?= $model->getDepartemenPenilaiSelf(); ?></th>
				</tr>
				<tr>
					<td>Target Job</td>
					<td>:</td>
					<th><?= $model->getRelation("kegiatanInduk","target") ?></th>
				</tr>
			</table>
		</div>
		<div class="col-sm-6">
			<table class="table-condensed">
				<tr>
					<th>IDENTITAS PENILAI</th>
				</tr>
				<tr>
					<td>Nama Penilai</td>
					<td>:</td>
					<th><?= $model->getRelation("pegawai","nama"); ?></th>
				</tr>
				<tr>
					<td>Jabatan</td>
					<td>:</td>
					<th><?= $model->jabatan; ?></th>
				</tr>
				<tr>
					<td>Unit Kerja</td>
					<td>:</td>
					<th><?= $model->divisi; ?></th>
				</tr>
				<tr>
					<td>Instansi</td>
					<td>:</td>
					<th><?= $model->departemen; ?></th>
				</tr>
				<tr>
					<td>Kode Rater</td>
					<td>:</td>
					<th><?= $model->getRelation("penilai_peran","nama"); ?></th>
				</tr>
				<tr>
					<td>Status Penilaian</td>
					<td>:</td>
					<th><?= $model->getLabelStatusPengisian() ?></th>
				</tr>
			</table>
		</div>
	</div>
	<?php /*
	<div class="row">
		<div class="col-sm-6">
			<?= $model->getButtonStatusPenilaian() ?>			

			<?php $this->widget('booster.widgets.TbButton',array(
				'buttonType'=>'submit',
				'htmlOptions'=>array(),
				'context'=>'primary',
				'htmlOptions'=>array('class'=>'btn-raised'),
				'label'=>'Simpan Penilaian',
				'icon'=>'floppy-disk'
			)); ?>
		</div>
	</div>
	<input id="kirim-penilaian" type="hidden" name="kirim_penilaian" value="0">
	*/ ?>
</div>

<h3>Panduan Penilaian</h3>

<div class="well">
	<ol>
		<li>
			Untuk mulai menilai, klik pilihan 1 - 10 pada form penilaian di bawah ini. 
		</li>
		<li>
			Jika sudah selesai, klik tombol <b>Simpan Penilaian</b> untuk menyimpan dn mengirimkan hasil.
		</li>
		<li>
			Klik menu Beranda untuk melihat daftar penilaian yang lain atau klik Logout untuk keluar.
		</li>
	</ol>
</div>	

<h3>Form Penilaian</h3>

<?php print CHtml::beginForm(
	null,null,['id'=>'kegiatan-penilaian']
); ?>

<div class="well">

	<table class="table table-condensed table-stripped table-bordered">
	<thead>
	<tr>
		<th style="text-align: center" width="1%" style="text-align: center">No</th>
		<th style="text-align: center" width="40%">Statements</th>
		<th colspan="2" style="text-align: center" width="40%" >Rating Tasks</th>
	</tr>
	</thead>
	<?php $i=1; foreach(KegiatanKompetensi::model()->findAllByAttributes(array('id_kegiatan'=>$id_kegiatan)) as $kompetensi) { ?>
	<tr class="info">
		<td style="text-align: center"><?= $i; ?></td>
		<td style="font-weight: bold"><?= $kompetensi->uraian; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php foreach($kompetensi->findAllRincian() as $rincian) { ?>
	<?php $class=''; if (!is_null($rincian->getCprByIdPenilai($id))) $class = 'success' ?>
	<tr>
		<td rowspan="2">&nbsp;</td>
		<td rowspan="2" style="vertical-align:middle; border-bottom: 2px solid black"><?= $rincian->uraian; ?></td>
		<td style="text-align:center">Kondisi Saat Ini</td>	
		<td id="cp-<?= $rincian->id ?>" style="text-align:center" class="<?= $class ?> bold">
			<?php echo CHtml::radioButtonList('KompetensiRincianCp['.$rincian->id.']',$rincian->getCpByIdPenilai($id),array(
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
	<script>
		$('#cp-'+<?= $rincian->id ?>).click(function() {
			if($('[id^=KompetensiRincianCp_'+<?= $rincian->id ?>+']').is(':checked')) { 
				$('#cp-'+<?= $rincian->id ?>).addClass('success');
			}
		   /**/
		});
	</script>
	<?php $class=''; if (!is_null($rincian->getCprByIdPenilai($id))) $class = 'success' ?>
	<tr>
		<td style="text-align:center; border-bottom: 2px solid black">Standar yang Diharapkan</td>	
		<td id="cpr-<?= $rincian->id ?>" style="text-align:center; border-bottom: 2px solid black" class="<?= $class ?> bold">
			<?php echo CHtml::radioButtonList('KompetensiRincianCpr['.$rincian->id.']',$rincian->getCprByIdPenilai($id),array(
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
			array( 
				'separator' => " | ",
			)
			); ?>	
		</td>
	</tr>
	<script>
		$('#cpr-'+<?= $rincian->id ?>).click(function() {
			if($('[id^=KompetensiRincianCpr_'+<?= $rincian->id ?>+']').is(':checked')) { 
				$('#cpr-'+<?= $rincian->id ?>).addClass('success');
			}
		   /**/
		});
	</script>
	<?php } //endforeach rincian ?>
	<?php $i++; } //endforeach kompetensi ?>
	</table>

	<div>&nbsp;</div>
	<div class="row">
		<div class="col-sm-7" style="text-align: right;">
			<?php echo CHtml::label('Uraian / Deskripsi :', 'uraian_deskripsi', ['style'=>'font-weight:bold; color: black;']) ?>
		</div>
		<div class="col-sm-5">
			<?php echo CHtml::textArea('uraian_deskripsi',$model->uraian_deskripsi,['rows'=>5,'style'=>'width: 100%']) ?>
		</div>
	</div>

	<div style="text-align: right">
		<?php //$model->getButtonStatusPenilaian() ?>

		<?php $this->widget('booster.widgets.TbButton',array(
				'buttonType'=>'submit',
				'htmlOptions'=>array('class'=>'dim'),
				'context'=>'primary',
				'htmlOptions'=>array('class'=>'btn-raised'),
				'label'=>'Simpan Penilaian',
				'icon'=>'ok'
		)); ?>
	</div>
</div>

<?php print CHtml::endForm(); ?>