<?php
$this->breadcrumbs=array(
	'Kompetensi Jenises',
);

$this->menu=array(
array('label'=>'Create KompetensiJenis','url'=>array('create')),
array('label'=>'Manage KompetensiJenis','url'=>array('admin')),
);
?>

<h1>Kompetensi Jenises</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
