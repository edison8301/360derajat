<?php 
	
	$status = $data->getStatusPengisian();

	if($status == 1)
		$class = 'alert alert-success'; 
	
	if($status == 0)
		$class = 'alert alert-danger';

	if($status == 2)
		$class = 'alert alert-warning'; 

	if ($status == 3) 
		$class = 'alert alert-success';
	


	
?>

<div class="item">
	<ul class="media-list">
		<li class="media <?php print $class; ?>" style="padding:10px;">
			<a class="pull-left" href="<?php echo Yii::app()->createUrl('kegiatanPenilai/penilaian', array('id' => $data->id,'id_kegiatan'=>$data->id_kegiatan)); ?>">
				<img class="media-object" style="width: 90px" alt="" src="<?php print Yii::app()->baseUrl; ?>/images/list_white.png">
			</a>
			<div class="media-body">

				<h4 class="media-heading">
					<span style="font-weight:bold"><?php print CHtml::link($data->getRelation('kegiatanInduk','nama'),array('kegiatanPenilai/penilaian','id'=>$data->id,'id_kegiatan'=>$data->id_kegiatan)); ?></span>
				</h4>
				<span style="font-weight:bold">Status Pengisian: </span> <?php print $data->getTextStatusPengisian();  ?><br>
				<span style="font-weight:bold">Nama yang Dinilai: </span><?php print $data->getNamaPenilaiSelf() ?><br>
				<span style="font-weight:bold">Jabatan: </span><?php print $data->getJabatanPenilaiSelf(); ?><br>
				<span style="font-weight:bold">Divisi : </span><?php print $data->getDivisiPenilaiSelf(); ?><br>
				<span style="font-weight:bold">Tanggal Pelaksanaan: </span><?php print Helper::tanggal($data->getRelation('kegiatan','tanggal_mulai')); ?> s.d <?php print Helper::tanggal($data->getRelation('kegiatan','tanggal_selesai')); ?><br>
				
			</div>
		</li>
	</ul>
</div>
