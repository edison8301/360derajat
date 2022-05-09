<?php
$this->breadcrumbs=array(
	'Kegiatan Kompetensis',
);

$this->menu=array(
array('label'=>'Create KegiatanKompetensi','url'=>array('create')),
array('label'=>'Manage KegiatanKompetensi','url'=>array('admin')),
);
?>

<h1>Kegiatan Kompetensis</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
