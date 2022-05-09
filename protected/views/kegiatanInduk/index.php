<?php
$this->breadcrumbs=array(
	'Kegiatan Induks',
);

$this->menu=array(
array('label'=>'Create KegiatanInduk','url'=>array('create')),
array('label'=>'Manage KegiatanInduk','url'=>array('admin')),
);
?>

<h1>Kegiatan Induks</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
