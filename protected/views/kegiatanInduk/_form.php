<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'kegiatan-induk-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

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

	<?php echo $form->select2Group($model,'id_kegiatan_status',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-3'),
		'prepend' => '',
		'widgetOptions'=>array(
			'data' => [
				1=>'Aktif',
				0=>'Tidak Aktif',
			],
			'htmlOptions'=>array(
				'class'=>'span5'
				)
			)
		)
	); ?>

	<?php echo $form->textAreaGroup($model,'keterangan',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
		'widgetOptions'=>array(
			'htmlOptions'=>array('rows'=>'3')
		)
	)); ?>

</div>

<div class="well">
	<?php echo $form->textFieldGroup($model,'bobot_spr',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-4'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255)
				)
			)
		); ?>

	<?php echo $form->textFieldGroup($model,'bobot_peer',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-4'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255)
				)
			)
		); ?>

	<?php echo $form->textFieldGroup($model,'bobot_sub',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-4'),
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