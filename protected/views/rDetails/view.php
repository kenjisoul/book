<?php
$this->breadcrumbs=array(
	'Rdetails'=>array('index'),
	$model->R_seats,
);

$this->menu=array(
	array('label'=>'List RDetails','url'=>array('index')),
	array('label'=>'Create RDetails','url'=>array('create')),
	array('label'=>'Update RDetails','url'=>array('update','id'=>$model->R_seats)),
	array('label'=>'Delete RDetails','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->R_seats),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RDetails','url'=>array('admin')),
);
?>

<h1>View RDetails #<?php echo $model->R_seats; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'R_seats',
		'R_tables',
		'R_name',
		'Z_id',
	),
)); ?>
