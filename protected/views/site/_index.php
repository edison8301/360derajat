<?php 
	
	$class = 'alert alert-success'; 
	$surat = 'list_white.png';


?>

<div class="item">
	<ul class="media-list">
		<li class="media <?php print $class; ?>" style="padding:10px;">
			<a class="pull-left" href="<?php echo Yii::app()->createUrl('kegiatan/view', array('id' => $data->id))?>">
				<img class="media-object" style="width: 90px" alt="" src="<?php print Yii::app()->baseUrl; ?>/images/list_white.png">
			</a>
			<div class="media-body">

				<h4 class="media-heading">
					<span style="font-weight:bold"><?php print CHtml::link($data->kegiatanInduk->nama,array('kegiatan/view','id'=>$data->id)); ?></span>
				</h4>
				
				<span style="font-weight:bold">Kode: </span><?php print $data->kegiatanInduk->kode; ?><br>
				<span style="font-weight:bold">Yang Dinilai: </span><?php print $data->getSelfNama(); ?><br>
				<span style="font-weight:bold">Jabatan: </span><?php print $data->getSelfJabatan(); ?><br>
				<span style="font-weight:bold">Waktu Pelaksanaan: </span><?php print Helper::getTanggal($data->kegiatanInduk->tanggal_mulai); ?> sd. <?php print Helper::getTanggal($data->kegiatanInduk->tanggal_selesai); ?>
			</div>
		</li>
	</ul>
</div>
