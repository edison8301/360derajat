<?php
$this->breadcrumbs=array(
	'Kegiatan Kompetensi Rincian'=>array('admin'),	
	'Sunting',
);

	?>

	<h1>Sunting Rincian Kompetensi Kegiatan </h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>