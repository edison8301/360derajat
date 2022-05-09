<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'kegiatan-penilai-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<div class="well">


	<?php echo $form->errorSummary($model); ?>	

	<?php echo $form->select2Group($model,'id_penilai_peran',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-3'),
		'prepend' => '',
		'widgetOptions'=>array(
			'data' => CHtml::listData(PenilaiPeran::model()->findAll(),'id','nama'),
			'htmlOptions'=>array(
				'class'=>'span5'
				)
			)
		)
	); ?>

	<?php echo $form->select2Group($model,'id_pegawai',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
		'prepend' => '',
		'widgetOptions'=>array(
			'data' => CHtml::listData(Pegawai::model()->findAll(),'id','nama'),
			'htmlOptions'=>array(
				'class'=>'span5'
				)
			)
		)
	); ?>

	<?php echo $form->textFieldGroup($model,'jabatan',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-4'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255)
				)
			)
		); ?>

	<?php echo $form->textFieldGroup($model,'divisi',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-4'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255)
				)
			)
		); ?>

	<?php echo $form->textFieldGroup($model,'departemen',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-4'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255)
				)
			)
		); ?>

	<?php echo $form->dropDownListGroup($model,'status_hitung',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
		'prepend' => '',
		'widgetOptions'=>array(
			'data' => [1=>'Hitung',0=>'Tidak Dihitung'],
			'htmlOptions'=>array(
				'class'=>'span5'
				)
			)
		)
	); ?>

</div>


<div class="form-actions well">
	<div class="row">
		<div class="col-sm-3">&nbsp;</div>
		<div class="col-sm-9">
			<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'htmlOptions'=>array('class'=>'btn-raised'),
				'context'=>'primary',
				'icon'=>'ok',
				'label'=>'Simpan',
			)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
