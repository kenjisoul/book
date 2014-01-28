<?php
$this->breadcrumbs=array(
	'Rzones'=>array('index'),
	$model->Z_id,
);

$this->menu=array(
	array('label'=>'List RZone','url'=>array('index')),
	array('label'=>'Create RZone','url'=>array('create')),
	array('label'=>'Update RZone','url'=>array('update','id'=>$model->Z_id)),
	array('label'=>'Delete RZone','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->Z_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RZone','url'=>array('admin')),
);
?>

<h1>View RZone #<?php echo $model->Z_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'Z_id',
		'zone',
		'zone_img',
		'R_name',
	),
)); ?>
