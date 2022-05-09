<?php $this->beginWidget('booster.widgets.TbModal',array(
		'id' => 'bankKompetensi'
)); ?>
	
	<div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Pilih Bank Kompetensi <?= $model->id ?></h4>
    </div>

    <div class="modal-body">
    	<?php 
    		$kompetensi = new Kompetensi('search');
    		$kompetensi->unsetAttributes();  // clear any default values
			if(isset($_GET['Kompetensi']))
				$kompetensi->attributes=$_GET['Kompetensi'];
		?>
		<?php $this->widget('booster.widgets.TbGridView',array(
			'id'=>'kompetensi-grid',
			'type' => 'striped bordered condensed',
			'dataProvider'=>$kompetensi->modal(),
			'filter'=>$kompetensi,
			'columns'=>array(		
				array(
					'header'=>'No',
					'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1',
					'headerHtmlOptions'=>array('style'=>'width:5%;text-align:center'),
					'htmlOptions'=>array('style'=>'width:5%;text-align:center'),
				),
				array(
					'name'=>'id_kompetensi_jenis',
					'filter' => KompetensiJenis::getList(),
			        'htmlOptions'=>['class'=>'input-field'],
					'value'=>'$data->getRelation("kompetensiJenis","nama")',
				),
				array(
					'name'=>'level',
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:15%'),
					'htmlOptions'=>array('style'=>'text-align:center'),
				),
				array(
					'name'=>'uraian',
					'headerHtmlOptions'=>array('style'=>'')
				),
				array(
					'header'=>'Pilih',
					'type'=>'raw',
					'value'=> function($data) use ($model){
						return CHtml::link("<i class=\"glyphicon glyphicon-plus\"></i>",["tambahBankKompetensi","id_kegiatan"=>$model->id,"id_kompetensi"=>$data->id],["class"=>"btn btn-primary btn-xs ","data-toggle"=>"tooltip","title"=>"Pilih"]);
					},
					'headerHtmlOptions'=>array('style'=>'text-align:center;width:8%;'),
					'htmlOptions'=>array(
						'style'=>'text-align:center',						
					),
				),
			),
	)); ?>
	</div><!-- .modal-body -->
	
<?php $this->endWidget(); ?>