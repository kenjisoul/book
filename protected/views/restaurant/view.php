<?php
$this->breadcrumbs=array(
	'Restaurants'=>array('index'),
	$model->R_name,
);

$this->menu=array(
	array('label'=>'List Restaurant','url'=>array('index')),
	array('label'=>'Create Restaurant','url'=>array('create'), 'visible'=>$this->showMenu()),
	array('label'=>'Update Restaurant','url'=>array('update','id'=>$model->R_name)),
	array('label'=>'Delete Restaurant','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->R_name),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Restaurant #<?php echo $model->R_name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'R_name',
		'R_logo',
		'R_open',
		'R_close',
		'R_service',
	),
)); ?>
