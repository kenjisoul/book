<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('A_user')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->A_user),array('view','id'=>$data->A_user)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('A_pass')); ?>:</b>
	<?php echo CHtml::encode($data->A_pass); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('A_name')); ?>:</b>
	<?php echo CHtml::encode($data->A_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('R_name')); ?>:</b>
	<?php echo CHtml::encode($data->R_name); ?>
	<br />


</div>