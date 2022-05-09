<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'kompetensi-rincian-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>
<?php /*
<div class="well">
	<h3>Info Kompetensi</h3>
	<table class="table table-condensed table-striped table-bordered">
		<tr>
			<th>Jenis Kompetensi</th>
			<td><?= $kompetensi->getRelation("kompetensiJenis","nama") ?></td>
		</tr>
		<tr>
			<th>Level</th>
			<td><?= $kompetensi->level ?></td>
		</tr>
		<tr>
			<th>Uraian</th>
			<td><?= $kompetensi->uraian ?></td>
		</tr>
	</table>
</div>
*/
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<h3><?= $kompetensi->getUraianLengkap() ?></h3>

<?php echo $form->errorSummary($model); ?>

<div class="well">

	<?php echo $form->textFieldGroup($model,'uraian',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-6'),
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
