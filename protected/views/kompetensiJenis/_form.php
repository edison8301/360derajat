<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'kompetensi-jenis-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
<div class="well">
	<?php echo $form->textFieldGroup($model,'nama',array(
			'wrapperHtmlOptions'=>array('class'=>'col-sm-4'),
			'widgetOptions'=>array(
				'htmlOptions'=>array(
					'class'=>'span5',
					'maxlength'=>255
				)
			)
		)
	); ?>
</div>

<div class="form-actions well">
	<div class="row">
		<div class="col-sm-3 col-sm-offset-3">
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