<?php
$this->breadcrumbs=array(
	'Kegiatan Statuses',
);

$this->menu=array(
array('label'=>'Create KegiatanStatus','url'=>array('create')),
array('label'=>'Manage KegiatanStatus','url'=>array('admin')),
);
?>

<h1>Kegiatan Statuses</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
