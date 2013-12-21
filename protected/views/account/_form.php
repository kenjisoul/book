<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'account-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'A_user', array('class' => 'span5', 'maxlength' => 255, 'readonly' => ($model->scenario == 'update') ? true : false)); ?>

<?php echo $form->passwordFieldRow($model, 'A_pass', array('value' => '', 'class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->passwordFieldRow($model, 'A_pass_repeat', array('class' => 'span5', 'maxlength' => 256)); ?>    

<?php echo $form->textFieldRow($model, 'A_name', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'R_name', array('class' => 'span5', 'maxlength' => 255)); ?>

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
