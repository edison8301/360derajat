<?php
$this->breadcrumbs=array(
	'Kompetensi'=>array('kompetensi/admin'),	
	'Sunting Kompetensi Rincian',
);

	?>

	<h1>Sunting Rincian Kompetensi</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'kompetensi'=>$kompetensi)); ?>