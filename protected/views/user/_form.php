<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="well">

	<?php echo $form->textFieldGroup($model,'username',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-6'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255)
			)
		)
	); ?>
	

	<?php if ($model->isNewRecord) {
		 echo $form->passwordFieldGroup($model,'password',array(
			'wrapperHtmlOptions'=>array('class'=>'col-sm-6'),
			'widgetOptions'=>array(
				'htmlOptions'=>array(
					'class'=>'span5',
					'maxlength'=>255)
				)
			)
		);
	} ?>

	<?php if (User::isSuperAdmin()) {
		echo $form->select2Group($model,'role_id',array(
			'wrapperHtmlOptions'=>array('class'=>'col-sm-3'),
			'prepend' => '',
			'widgetOptions'=>array(
				'data' => User::getRoleList(),
				'htmlOptions'=>array(
					'class'=>'span5'
					)
				)
			)
		);
	} ?>

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
