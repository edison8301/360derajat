<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'surat-keluar-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<div class="row">
	<div class="col-md-9">
		<?php echo $form->select2Group($model,'barang',array(
				'wrapperHtmlOptions' => array('class' => 'col-sm-12	'),
				'widgetOptions' => array(
					'asDropDownList' => false,
      				 'options' => array(
                       'minimumInputLength'=>'2',
                       'placeholder'=> 'Pilih Barang',
                       'separator' => ';',
                       'allowClear' => TRUE,
                       'ajax' => array(
                           'url'       => Yii::app()->controller->createUrl('barang/selectBarang'),
                           'dataType'  => 'json',
                           'data'      => 'js:function(term, page) { return {q: term }; }',
                           'results'   => 'js:function(data) { return {results: data}; }',
                        ),
                       	'tags' => 'js:function(data) { return {results: data}; }',
                    ),
				),
		)); ?>
	</div>
	<div class="col-md-3">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'context'=>'danger',
				'icon'=>'plus',
				'label'=>'Tambahkan Barang',
		)); ?>
	</div>
</div>


<?php $this->endWidget(); ?>