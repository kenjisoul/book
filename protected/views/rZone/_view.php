<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Z_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Z_id),array('view','id'=>$data->Z_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zone')); ?>:</b>
	<?php echo CHtml::encode($data->zone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zone_img')); ?>:</b>
	<?php echo CHtml::encode($data->zone_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_name')); ?>:</b>
	<?php echo CHtml::encode($data->R_name); ?>
	<br />


</div>