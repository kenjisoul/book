<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->R_name),array('view','id'=>$data->R_name)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_logo')); ?>:</b>
	<?php echo CHtml::encode($data->R_logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_open')); ?>:</b>
	<?php echo CHtml::encode($data->R_open); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_close')); ?>:</b>
	<?php echo CHtml::encode($data->R_close); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_service')); ?>:</b>
	<?php echo CHtml::encode($data->R_service); ?>
	<br />


</div>