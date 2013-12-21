<!-- this use bootstrap form -->
<?php
$this->breadcrumbs = array(
    'Book',
);
?>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'book',
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ))
);
/* if ($isNew)
  echo $form->errorSummary($model);
 */
echo $form->textFieldRow($model, 'C_name', array('value' => $namefield));
?>
<div class="control-group">
    <label class="control-label" for="Customers_C_time">
        เวลาที่จะเข้าบริการ 
        <span class="required"> * </span>
    </label>
    <div class="controls">
        <?php
        echo $form->dropDownList($model, 'C_time', $this->HH(), array('empty' => 'เลือก',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('Customers/MM'),
                'update' => '#Customers_drpMinute',
                'data' => array('hour' => 'js:this.value'),
            ), 'class' => 'input-small',
        ));

        echo " : ";
        echo $form->dropDownList($model, 'drpMinute', array('empty' => 'เลือก'), array('class' => 'input-small'));
        echo $form->error($model, 'C_time');
        echo $form->error($model, 'drpMinute');
        ?>
    </div>
</div>  
<?php
echo $form->dropDownListRow($model, 'C_seats', $this->getSeat(), array('empty' => 'เลือก', 'class' => 'input-small'));
?>
<div class="control-group">
    <div class="controls">
        <?php
        echo $form->error($model, 'status');
        ?>
    </div>
</div>

<div class="controls" id="submit"> 
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Book',
        'buttonType' => 'submit',
        'htmlOptions' => array(
            'name' => 'submit',
        ),
    ));
    ?>
</div>
<?php
$this->endWidget();
?>