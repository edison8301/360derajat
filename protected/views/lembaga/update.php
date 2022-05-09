<?php
$this->breadcrumbs=array(
	'Lembagas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Sunting Lembaga</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>