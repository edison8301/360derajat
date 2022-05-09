<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'kegiatan-kompetensi-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>


<?php echo $form->errorSummary($model); ?>

<div class="well">	

	<?php echo $form->textAreaGroup($model,'uraian',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'rows'=>'3',
				'maxlength'=>255)
				)
			)
		); ?>

	<?php
	/* echo $form->numberFieldGroup($model,'cpro',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-2'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255)
				)
			)
		); ?>

	<?php echo $form->numberFieldGroup($model,'fpro',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-2'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255)
				)
			)
		); */
	?>

	<?php echo $form->numberFieldGroup($model,'urutan',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-2'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255)
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
	