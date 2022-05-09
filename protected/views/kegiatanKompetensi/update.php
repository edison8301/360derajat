<?php
$this->breadcrumbs=array(
	'Kegiatan Kompetensi'=>array('index'),	
	'Sunting Data',
);

	?>

	<h1>Sunting Kegiatan Kompetensi</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>