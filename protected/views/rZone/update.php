<?php
$this->breadcrumbs=array(
	'Rzones'=>array('index'),
	$model->Z_id=>array('view','id'=>$model->Z_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RZone','url'=>array('index')),
	array('label'=>'Create RZone','url'=>array('create')),
	array('label'=>'View RZone','url'=>array('view','id'=>$model->Z_id)),
	array('label'=>'Manage RZone','url'=>array('admin')),
);
?>

<h1>Update RZone <?php echo $model->Z_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>