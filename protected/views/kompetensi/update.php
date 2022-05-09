<?php
$this->breadcrumbs=array(
	'Kompetensi'=>array('admin'),	
	'Sunting',
);

	?>

<h1>Sunting Kompetensi</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>