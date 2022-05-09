<?php 
if (isset($model->referrer))
 	$referrer = $model->referrer;
else
 	$referrer = Yii::app()->request->urlReferrer;
?>
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'kompetensi-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>true,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="well">
	
	<?php echo $form->select2Group($model,'id_kompetensi_jenis',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-3'),
		'prepend' => '',
		'widgetOptions'=>array(
			'data' => CHtml::listData(KompetensiJenis::model()->findAll(),'id','nama'),
			'htmlOptions'=>array(
				'class'=>'span5'
				)
			)
		)
	); ?>

	<?php echo $form->select2Group($model,'level',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-2'),
		'prepend' => '',
		'widgetOptions'=>array(
			'data' => [1=>1,2=>2,3=>3,4=>4,5=>5],
			'htmlOptions'=>array(
				'class'=>'span5'
				)
			)
		)
	); ?>

	<?php echo $form->hiddenField($model, 'referrer', ['value'=>$referrer]) ?>

	<?php echo $form->textAreaGroup($model,'uraian', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

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
