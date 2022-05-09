<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h2>Selamat Datang di Aplikasi Self Assessment Sikap dan Perilaku Peserta Pelatihan Kepemimpinan Lembaga Administrasi Negara</h2>

<?php $this->renderPartial('_grafik_kegiatan',array()); ?>

<hr>

<h2>Daftar Kegiatan Penilaian Berjalan</h2>

<?php $this->widget('booster.widgets.TbListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_index',
		'ajaxUpdate'=>false
)); ?>

