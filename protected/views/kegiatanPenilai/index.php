<?php
$this->breadcrumbs=array(
	'Kegiatan Penilais',
);

$this->menu=array(
array('label'=>'Create KegiatanPenilai','url'=>array('create')),
array('label'=>'Manage KegiatanPenilai','url'=>array('admin')),
);
?>

<h1>Kegiatan Penilais</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
