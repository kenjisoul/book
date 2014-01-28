<?php
$this->breadcrumbs=array(
	'Rzones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RZone','url'=>array('index')),
	array('label'=>'Manage RZone','url'=>array('admin')),
);
?>

<h1>Create RZone</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>