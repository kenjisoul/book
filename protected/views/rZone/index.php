<?php
$this->breadcrumbs=array(
	'Rzones',
);

$this->menu=array(
	array('label'=>'Create RZone','url'=>array('create')),
	array('label'=>'Manage RZone','url'=>array('admin')),
);
?>

<h1>Rzones</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
