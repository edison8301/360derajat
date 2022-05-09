<?php
$this->breadcrumbs=array(
	'Kegiatan Kompetensi Rincian Hasils'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List KegiatanKompetensiRincianHasil','url'=>array('index')),
	array('label'=>'Create KegiatanKompetensiRincianHasil','url'=>array('create')),
	array('label'=>'View KegiatanKompetensiRincianHasil','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage KegiatanKompetensiRincianHasil','url'=>array('admin')),
	);
	?>

	<h1>Update KegiatanKompetensiRincianHasil <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>