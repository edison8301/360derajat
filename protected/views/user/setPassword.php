
<h1 style="font-size: 30px; text-align: left">Set Password</h1>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($SetPasswordForm); ?>

	<div class="well">

	<?php echo $form->passwordFieldGroup($SetPasswordForm,'password_baru',array(
			'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
			'widgetOptions'=>array(
					'htmlOptions'=>array('class'=>'span5')
			), 		
			'prepend'=>'<i class="glyphicon glyphicon-lock"></i>'
	)); ?>
	<?php echo $form->passwordFieldGroup($SetPasswordForm,'password_baru_konfirmasi',array(
			'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
			'widgetOptions'=>array(
					'htmlOptions'=>array('class'=>'span5')
			), 		
			'prepend'=>'<i class="glyphicon glyphicon-lock"></i>'
	)); ?>

	<div>&nbsp;</div>

	</div>

	<div class="form-actions well">
		<div class="row">
			<div class="col-sm-3">&nbsp;</div>
			<div class="col-sm-9">
				<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'htmlOptions' => array('class'=> 'btn-raised'),
					'icon'=>'ok',
					'label'=>'Simpan',
				)); ?>
			</div>
		</div>
	</div>

	
<?php $this->endWidget(); ?>