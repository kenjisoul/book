<?php
$this->breadcrumbs=array(
	'Rdetails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RDetails','url'=>array('index')),
	array('label'=>'Manage RDetails','url'=>array('admin')),
);
?>

<h1>Create RDetails</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>