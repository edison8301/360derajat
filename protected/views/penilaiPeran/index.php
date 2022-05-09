<?php
$this->breadcrumbs=array(
	'Penilai Perans',
);

$this->menu=array(
array('label'=>'Create PenilaiPeran','url'=>array('create')),
array('label'=>'Manage PenilaiPeran','url'=>array('admin')),
);
?>

<h1>Penilai Perans</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
