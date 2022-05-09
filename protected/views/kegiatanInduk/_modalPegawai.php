<?php $this->beginWidget('booster.widgets.TbModal',array(
		'id' => 'pegawai'
)); ?>
	
	<div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Pilih Pegawai</h4>
    </div>

    <div class="modal-body">
		<?php $this->widget('booster.widgets.TbGridView',array(
			'id'=>'pegawai-grid',
			'dataProvider'=>$pegawai->search(),
			'type' => 'striped bordered condensed',
			'filter'=>$pegawai,
			'columns'=>array(
				array(
					'header'=>'No',
					'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1',
					'headerHtmlOptions'=>array('style'=>'width:5%;text-align:center'),
					'htmlOptions'=>array('style'=>'width:5%;text-align:center'),
				),
				'nama',
				array(
					'name'=>'id_lembaga',
					'headerHtmlOptions'=>array('style'=>'text-align:center'),
					'value'=>'$data->getRelation("lembaga","nama")',
					'htmlOptions'=>array('style'=>'text-align:center'),
					'filter'=>Lembaga::getList()
				),
				array(
					'header'=>'Pilih',
					'type'=>'raw',
					'value'=> function($data) use ($model){
						return CHtml::link("<i class=\"glyphicon glyphicon-check\"></i>",["tambahTargetPenilaian","id"=>$model->id,"id_pegawai"=>$data->id],["class"=>"btn btn-primary btn-s ","data-toggle"=>"tooltip","title"=>"Pilih"]);
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