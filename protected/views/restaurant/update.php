<?php
$this->breadcrumbs=array(
	'Restaurants'=>array('index'),
	$model->R_name=>array('view','id'=>$model->R_name),
	'Update',
);

$this->menu=array(
	array('label'=>'List Restaurant','url'=>array('index')),
	array('label'=>'Create Restaurant','url'=>array('create'), 'visible'=>$this->showMenu()),
	array('label'=>'View Restaurant','url'=>array('view','id'=>$model->R_name)),
);
?>

<h1>Update Restaurant <?php echo $model->R_name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>