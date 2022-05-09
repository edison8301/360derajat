<?php
$this->breadcrumbs=array(
	'Kegiatan'=>array('admin'),
	'Detail Kegiatan'
);

?>

<h1>Kegiatan : <b><?php echo $model->kegiatanInduk->nama; ?></b></h1>
<h2>Target Penilaian : <b><?= $model->getSelfNama() ?></b></h2>

<div>&nbsp;</div>

<?php if (!$model->hasKegiatanKompetensi()) { ?>
    <div class="alert alert-info" style="margin-top: 20px">
        Kegiatan ini Belum mempunyai Kompetensi !
    </div>
<?php } ?>


<div class="well">

<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'type' => 'striped bordered condensed',
		'attributes'=>array(
            [
                'label'=>'Kode',
                'value' => $model->kegiatanInduk->kode
            ],
            [
                'label'=>'Nama',
                'value' => $model->kegiatanInduk->nama
            ],
			array(
				'name' => 'tanggal_mulai',
				'value' => Helper::getTanggalSingkat($model->kegiatanInduk->tanggal_mulai)
            ),
			array(
				'name' => 'tanggal_selesai',
				'value' => Helper::getTanggalSingkat($model->kegiatanInduk->tanggal_selesai)
            ),
			[
                'label'=>'Keterangan',
                'value' => $model->kegiatanInduk->keterangan
            ],
            array(
                'name' => 'id_kegiatan_status',
                'type'=>'raw',
                'value' => $model->kegiatanInduk->getLabelKegiatanStatus()
            ),
            [
                'attribute'=>'bobot_spr',
                'label'=>'Bobot Spr',
                'value'=> $model->kegiatanInduk->bobot_spr.' %',
            ],
            [
                'attribute'=>'bobot_peer',
                'label'=>'Bobot Peer',
                'value'=> $model->kegiatanInduk->bobot_peer.' %',
            ],
            [
                'attribute'=>'bobot_sub',
                'label'=>'Bobot Sub',
                'value'=> $model->kegiatanInduk->bobot_sub.' %',
            ],
		),
)); ?>


<div>&nbsp;</div>

<?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Kembali ke Kegiatan Induk',
        'icon'=>'arrow-left',
        'context'=>'warning',
        'htmlOptions'=>array('class'=>'btn-raised'),
        'url'=>array('kegiatanInduk/view','id'=>$model->id_kegiatan_induk)
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Sunting Kegiatan',
		'icon'=>'pencil',
		'context'=>'primary',
		'htmlOptions'=>array('class'=>'btn-raised'),
		'url'=>array('kegiatanInduk/update','id'=>$model->id_kegiatan_induk,'id_kegiatan'=>$model->id)
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'encodeLabel'=>false,
        'label'=>'<i class="fa fa-file-excel-o"></i> Export Excel',
        'context'=>'primary',
        'htmlOptions'=>array('class'=>'btn-raised'),
        'url'=>array('exportExcelIsian','id'=>$model->id)
)); ?>&nbsp;


<?php $this->widget('booster.widgets.TbButtonGroup',array(
			'context'=>'primary',			
    		'buttons' => array(
        		array('label' => 'Export PDF','encodeLabel'=>false, 'htmlOptions'=>array('class'=>'btn-raised','target'=>'_blank'), 'icon'=>'download-alt','items'=>array(
        			array(
        				'label'=>'<i class="fa fa-file-pdf-o"></i> Export PDF Isian',
        				'url'=>array('exportPdfIsian','id'=>$model->id),        				
        				'linkOptions'=>['target'=>'_blank']
        			),
                    array(
                        'label'=>'<i class="fa fa-file-pdf-o"></i> Export PDF Executive Summary',
                        'url'=>array('exportPdfExecutiveSummary','id'=>$model->id),                       
                        'linkOptions'=>['target'=>'_blank']
                    ),
                    array(
                        'label'=>'<i class="fa fa-file-pdf-o"></i> Export PDF Individual',
                        'url'=>array('exportPdfIndividual','id'=>$model->id),   
                        'linkOptions'=>['target'=>'_blank']                     
                    ),
        		))
        	),
)); ?>&nbsp;

<div>&nbsp;</div>

<?php 
	
    if(isset($_GET['tab']))
	{
		$tab = $_GET['tab'];

		$kompetensi = false;
		$penilai = false;
		$isian = false;

		switch ($tab) {
			case 'kompetensi':
				$kompetensi = true;
				break;

			case 'penilai':
				$penilai = true;				
				break;

			case 'isian':
				$isian = true;				
				break;
		}

	} else {
		$kompetensi = true;
		$penilai = false;
		$isian = false;		
	}

?>

<?php $this->widget('booster.widgets.TbTabs',array(
    	'type' => 'tabs',
		'tabs'=> array(
            array(
                'label' => 'Kompetensi',
                'content' => $this->renderPartial('_kegiatan_kompetensi',array('model'=>$model),true),
                'active' => $kompetensi
            ),
            array(
                'label' => 'Penilai',
                'content' => $this->renderPartial('_kegiatan_penilai',array('model'=>$model),true),
                'active' => $penilai
            ),
            array(
                'label' => 'Hasil Isian',
                'content' => $this->renderPartial('_kegiatan_isian',array('model'=>$model),true),
                'active' => $isian
            ),
  		)
)); ?>


</div>