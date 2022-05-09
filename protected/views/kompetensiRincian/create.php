<?php
$this->breadcrumbs=array(
	'Kompetensi'=>array('kompetensi/admin'),
	'Tambah Rincian Kompetensi',
);


?>

<h1>Tambah Rincian Kompetensi</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'kompetensi'=>$kompetensi)); ?>