<?php
$this->breadcrumbs=array(
	'Kegiatan Penilai'=>array('admin'),
	'Tambah Data',
);

?>

<h1>Tambah Data Penilai</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>