<?php
$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	$model->A_user,
);

$this->menu=array(
	array('label'=>'List Account','url'=>array('index')),
	array('label'=>'Create Account','url'=>array('create')),
	array('label'=>'Update Account','url'=>array('update','id'=>$model->A_user)),
	array('label'=>'Delete Account','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->A_user),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Account','url'=>array('admin')),
);
?>

<h1>View Account #<?php echo $model->A_user; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'A_user',
		'A_pass',
		'A_name',
		'R_name',
	),
)); ?>
