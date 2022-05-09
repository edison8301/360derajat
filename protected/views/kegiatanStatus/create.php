<?php
$this->breadcrumbs=array(
	'Kegiatan Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List KegiatanStatus','url'=>array('index')),
array('label'=>'Manage KegiatanStatus','url'=>array('admin')),
);
?>

<h1>Create KegiatanStatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>