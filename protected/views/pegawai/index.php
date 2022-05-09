<h3>Daftar Kegiatan</h3>

<div class="well">
	<?php $this->widget('booster.widgets.TbListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_index',
		'ajaxUpdate'=>false
	)); ?>
</div>