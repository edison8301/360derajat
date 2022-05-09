<?php
$this->breadcrumbs=array(
	'Kegiatan Kompetensi Rincian Hasils',
);

$this->menu=array(
array('label'=>'Create KegiatanKompetensiRincianHasil','url'=>array('create')),
array('label'=>'Manage KegiatanKompetensiRincianHasil','url'=>array('admin')),
);
?>

<h1>Kegiatan Kompetensi Rincian Hasils</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
