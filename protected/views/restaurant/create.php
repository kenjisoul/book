<?php
$this->breadcrumbs=array(
	'Restaurants'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Restaurant','url'=>array('index')),
);
?>

<h1>Create Restaurant</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>