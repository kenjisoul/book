<?php
$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	$model->A_user=>array('view','id'=>$model->A_user),
	'Update',
);

$this->menu=array(
	array('label'=>'List Account','url'=>array('index')),
	array('label'=>'Create Account','url'=>array('create')),
	array('label'=>'View Account','url'=>array('view','id'=>$model->A_user)),
	array('label'=>'Manage Account','url'=>array('admin')),
);
?>

<h1>Update Account <?php echo $model->A_user; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>