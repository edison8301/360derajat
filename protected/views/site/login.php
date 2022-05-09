<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>


	<?php $this->beginWidget('booster.widgets.TbPanel',array(
	   'title' => 'Sign In',
		'context'=>'primary',
	 	'padContent' => false,
	     'htmlOptions' => array(
	     		'class' => 'bootstrap-widget-table',
	     		'style'=>'margin-bottom:0px;height:290px;'
	     	)
	));?>


	<div style="text-align: center" id="site-login" style="margin:0px;">
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'htmlOptions'=>array('class'=>'well'),
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>

		<img src="<?php echo Yii::app()->baseUrl; ?>/images/makarti2.png" width="70px">
				
			<?php echo $form->textFieldGroup($model,'username',array(
					'prepend'=>'<i class="glyphicon glyphicon-user"></i>',
					'widgetOptions'=>array(
						'label'=>'ok'
						)
			)); ?>

			<?php echo $form->passwordFieldGroup($model,'password',array(
					'prepend'=>'<i class="glyphicon glyphicon-lock"></i>'
			)); ?>
			
			
			<hr>

			<div class="buttons">
				<?php $this->widget('booster.widgets.TbButton', array(
						'buttonType'=>'submit',
						'context'=>'primary',
						'label'=>'Login',
						'icon'=>'lock white',
						'htmlOptions'=>array('style'=>'width:100%','class'=>'btn-raised')
				)); ?>
			</div>


		<?php $this->endWidget(); ?>

	</div>

</div>

<?php $this->endWidget(); ?>