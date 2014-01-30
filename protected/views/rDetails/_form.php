<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'rdetails-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'R_name', $this->getRestaurant(), array('class' => 'input-small')); ?>

<?php echo $form->dropDownListRow($model, 'Z_id', $this->getZone(), array('class' => 'input-small')); ?>

<?php echo $form->textFieldRow($model, 'R_seats', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'R_tables', array('class' => 'span5', 'hint' => 'ใช้ , คั่นระหว่างหมายเลขโต๊ะ ตัวอย่าง มีหมายเลขโต๊ะ 1 2 3 4 ให้ใส่ในรูปแบบ 1,2,3,4')); ?>


<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
