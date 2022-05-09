<?php
$this->breadcrumbs=array(
	'Kompetensi Rincians',
);

$this->menu=array(
array('label'=>'Create KompetensiRincian','url'=>array('create')),
array('label'=>'Manage KompetensiRincian','url'=>array('admin')),
);
?>

<h1>Kompetensi Rincians</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
