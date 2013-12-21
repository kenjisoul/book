<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_seats')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->R_seats),array('view','id'=>$data->R_seats)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_tables')); ?>:</b>
	<?php echo CHtml::encode($data->R_tables); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_name')); ?>:</b>
	<?php echo CHtml::encode($data->R_name); ?>
	<br />


</div>