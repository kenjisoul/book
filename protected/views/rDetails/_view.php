<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('details_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->details_id),array('view','id'=>$data->details_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_seats')); ?>:</b>
	<?php echo CHtml::encode($data->R_seats); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_tables')); ?>:</b>
	<?php echo CHtml::encode($data->R_tables); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_name')); ?>:</b>
	<?php echo CHtml::encode($data->R_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Z_id')); ?>:</b>
	<?php echo CHtml::encode($data->Z_id); ?>
	<br />


</div>