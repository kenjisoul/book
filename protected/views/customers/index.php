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
        วันที่
        <span class="required"> * </span>
    </label>
    <div class="controls">
        <?php
        $form->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'jdate',
            'options' => array(
                'dateFormat' => 'dd / mm / yy',
                'selectOtherMonths' => true,
                'autoSize' => true,
                'minDate' => 0,
                'maxDate' => "+1M",
                'showAnim' => 'slideDown',
            ),
            'htmlOptions' => array(
                'class' => 'input-small',
                'value' => date('d / m / Y'),
            ),
        ));
        ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="Customers_C_time">
        เวลา
        <span class="required"> * </span>
    </label>
    <div class="controls">
        <?php
        echo $form->dropDownList($model, 'C_time', $this->HH(), array('empty' => 'เลือก',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('Customers/MM'),
                'update' => '#Customers_drpMinute',
                'data' => array('hour' => 'js:this.value')
            ),
            'class' => 'input-small',
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
<!-- check status button -->
<div class="control-group" id="status">
    <label class="control-label" for="Customers_C_time">
        ตรวจสอบที่นั่ง
        <span class="required"> * </span>
    </label>
    <div class="controls" > 
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'button',
            'type' => '',
            'label' => 'ตรวจสอบ',
            'htmlOptions' => array(
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('Customers/Status'),
                    'update' => '#submit',
                    'data' => array(
                        'jdate'=> 'js:$("#Customers_jdate").val()',
                        'hour' => 'js:$("#Customers_C_time").val()',
                        'minutes' => 'js:$("#Customers_drpMinute").val()',
                        'seats' => 'js:$("#Customers_C_seats").val()',
                    )
                )
            )
        ));
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
        'disabled' => true,
    ));
    ?>
</div>
<?php
$this->endWidget();
?>