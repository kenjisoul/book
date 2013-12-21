<?php
$this->breadcrumbs=array(
	'Rdetails',
);

$this->menu=array(
	array('label'=>'Create RDetails','url'=>array('create')),
	array('label'=>'Manage RDetails','url'=>array('admin')),
);
?>

<h1>Rdetails</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
