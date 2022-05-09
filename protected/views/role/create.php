<?php
/* @var $this RoleController */
/* @var $model Role */

$this->breadcrumbs=array(
	'Role'=>array('admin'),
	'Tambah data',
);

$this->menu=array(
	array('label'=>'List Role', 'url'=>array('index')),
	array('label'=>'Manage Role', 'url'=>array('admin')),
);
?>

<h1>Create Role</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>