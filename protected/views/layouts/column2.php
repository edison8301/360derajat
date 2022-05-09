<?php /* @var $this Controller */ ?>

<?php $this->beginContent('//layouts/admin/main'); ?>

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

<div class="row">
    <div id="content" class="col-xs-12">


        <?php echo $content; ?>

    </div>
</div>

<?php $this->endContent(); ?>

