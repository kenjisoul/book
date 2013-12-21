<?php
$this->breadcrumbs=array(
	'Rdetails'=>array('index'),
	$model->R_seats=>array('view','id'=>$model->R_seats),
	'Update',
);

$this->menu=array(
	array('label'=>'List RDetails','url'=>array('index')),
	array('label'=>'Create RDetails','url'=>array('create')),
	array('label'=>'View RDetails','url'=>array('view','id'=>$model->R_seats)),
	array('label'=>'Manage RDetails','url'=>array('admin')),
);
?>

<h1>Update RDetails <?php echo $model->R_seats; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>