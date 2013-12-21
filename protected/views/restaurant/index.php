<?php
$this->breadcrumbs=array(
	'Restaurants',
);

$this->menu=array(
	array('label'=>'Create Restaurant','url'=>array('create'), 'visible'=>$this->showMenu()),
);
?>

<h1>Restaurants</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'restaurant-grid',
    'dataProvider'=>$model->search(),
    'columns'=>array(
        'R_name',
        'R_logo',
        'R_open',
        'R_close',
        'R_service',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>
