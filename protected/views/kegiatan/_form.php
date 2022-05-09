<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'kegiatan-form',
	'type' => 'horizontal'
,	'enableAjaxValidation'=>false,
)); ?>


<?php echo $form->errorSummary($model); ?>

<div class="well">

	<?php echo $form->textFieldGroup($model,'kode',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-4'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255)
				)
			)
		); ?>

	<?php echo $form->textFieldGroup($model,'nama',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-4'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255)
				)
			)
		); ?>

	<?php echo $form->textFieldGroup($model,'target',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-4'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255)
				)
			)
		); ?>

	<?php echo $form->datePickerGroup($model,'tanggal_mulai',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
		'widgetOptions'=>array(
			'options'=>array(
				'format' => 'yyyy-mm-dd',
				'autoclose' => 'true'),
			'htmlOptions'=>array('class'=>'span5')),
			'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

	<?php echo $form->datePickerGroup($model,'tanggal_selesai',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
		'widgetOptions'=>array(
			'options'=>array(
				'format' => 'yyyy-mm-dd',
				'autoclose' => 'true'),
			'htmlOptions'=>array('class'=>'span5')),
			'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

	<?php echo $form->textAreaGroup($model,'keterangan',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
		'widgetOptions'=>array(
			'htmlOptions'=>array('rows'=>'3')
		)
	)); ?>

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
