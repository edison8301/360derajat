<?php $this->widget('booster.widgets.TbButtonGroup',array(
        	'size' => 'extra_small',
        	'context'=>'primary',
            'htmlOptions'=>array('target'=> '_blank'),
            'encodeLabel'=>false,
       	 	'buttons' => array(
            	array(
                	'label' => '',
                	'items' => array(
                    	array('label' =>'<i class="glyphicon glyphicon-print"></i> Laporan Isian', 'url' => array('KegiatanKompetensiRincianHasil/exportIsianExcel','id_kompetensi'=>$kegiatan_kompetensi->id)),
                    	array('label' => '<i class="glyphicon glyphicon-print"></i> Laporan Individual', 'url' => array('kegiatanKompetensiRincianHasil/exportIndividual','id_kompetensi'=>$kegiatan_kompetensi->id)),
                    )
            	),
        	),
)); ?>