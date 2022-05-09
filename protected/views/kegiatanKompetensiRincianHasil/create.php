<?php
$this->breadcrumbs=array(
	'Kegiatan Kompetensi Rincian Hasils'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List KegiatanKompetensiRincianHasil','url'=>array('index')),
array('label'=>'Manage KegiatanKompetensiRincianHasil','url'=>array('admin')),
);
?>

<h1>Create KegiatanKompetensiRincianHasil</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>