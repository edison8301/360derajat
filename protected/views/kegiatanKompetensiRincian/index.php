<?php
$this->breadcrumbs=array(
	'Kegiatan Kompetensi Rincians',
);

$this->menu=array(
array('label'=>'Create KegiatanKompetensiRincian','url'=>array('create')),
array('label'=>'Manage KegiatanKompetensiRincian','url'=>array('admin')),
);
?>

<h1>Kegiatan Kompetensi Rincians</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
