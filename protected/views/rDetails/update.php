<?php
$this->breadcrumbs=array(
	'Rdetails'=>array('index'),
	$model->details_id=>array('view','id'=>$model->details_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RDetails','url'=>array('index')),
	array('label'=>'Create RDetails','url'=>array('create')),
	array('label'=>'View RDetails','url'=>array('view','id'=>$model->details_id)),
	array('label'=>'Manage RDetails','url'=>array('admin')),
);
?>

<h1>Update RDetails <?php echo $model->details_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>