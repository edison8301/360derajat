<?php
$this->breadcrumbs=array(
	'Kompetensis',
);

$this->menu=array(
array('label'=>'Create Kompetensi','url'=>array('create')),
array('label'=>'Manage Kompetensi','url'=>array('admin')),
);
?>

<h1>Kompetensis</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
