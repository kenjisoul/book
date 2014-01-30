<?php
$this->breadcrumbs=array(
	'Rdetails'=>array('index'),
	$model->details_id,
);

$this->menu=array(
	array('label'=>'List RDetails','url'=>array('index')),
	array('label'=>'Create RDetails','url'=>array('create')),
	array('label'=>'Update RDetails','url'=>array('update','id'=>$model->details_id)),
	array('label'=>'Delete RDetails','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->details_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RDetails','url'=>array('admin')),
);
?>

<h1>View RDetails #<?php echo $model->details_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'details_id',
		'R_seats',
		'R_tables',
		'R_name',
		'Z_id',
	),
)); ?>
