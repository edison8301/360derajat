<?php /* @var $this Controller */ ?>

<?php $this->beginContent('/layouts/main'); ?>

<div class="box-breadcumbs">
        <?php if(isset($this->breadcrumbs)) {
                if ( Yii::app()->controller->route !== 'site/index' )

                    $this->breadcrumbs = array_merge(array (Yii::t('zii','<i class="icon-home"></i>')=>Yii::app()->homeUrl.'?r=site/index'), $this->breadcrumbs);
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links'=>$this->breadcrumbs,
                            'homeLink'=>false,
                            'encodeLabel'=>false,
                            'htmlOptions'=>array ('class'=>'breadcrumb')
                    ));
        } ?>
</div>

<h2>Halaman Administrator</h2>
<?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Grafik Barang',
        'context'=>'primary',
        'url'=>array('/admin/index')
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Grafik Total Harga',
        'context'=>'primary',
        'url'=>array('/admin/totalHargaPerTahun')
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Grafik Jumlah Barang per Kondisi',
        'context'=>'primary',
        'url'=>array('/admin/jumlahBarangPerKondisi')
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Grafik Jumlah Barang per Lokasi',
        'context'=>'primary',
        'url'=>array('/admin/jumlahBarangPerLokasi')
)); ?>&nbsp;

<div class="row">
    <div id="content" class="col-xs-12">

        <?php echo $content; ?>

    </div>

</div>



<?php $this->endContent(); ?>
