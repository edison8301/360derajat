<?php
$this->breadcrumbs=array(
	'Lembagas',
);

$this->menu=array(
array('label'=>'Create Lembaga','url'=>array('create')),
array('label'=>'Manage Lembaga','url'=>array('admin')),
);
?>

<h1>Lembagas</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
