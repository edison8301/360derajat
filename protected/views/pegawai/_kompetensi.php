<?php
	$kompetensi_class = "alert-info";

	$ikon = "disposisi.png";

?>

<div style="padding:10px" class="media <?php print $kompetensi_class; ?>">

<a class="pull-left" href="#">
	<img class="media-object" style="width: 70px" alt="" src="<?php print Yii::app()->baseUrl; ?>/images/<?php print $ikon; ?>">
</a>
<div class="media-body">
	<div class="media-body">
		<h4 class="media-heading">
			<span style="font-weight:bold">Kompetensi : <?php print CHtml::link($kompetensi->uraian,array('kegiatanKompetensi/view','id'=>$kompetensi->id_kegiatan)); ?></span>
		</h4>
		
		<span style="font-weight:bold">CPR: </span><?php print $kompetensi->cpr; ?><br>
		<span style="font-weight:bold">FPR: </span><?php print $kompetensi->fpr; ?>
	</div>	
</div>
</div>