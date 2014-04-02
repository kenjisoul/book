<?php
Yii::import('application.extensions.timepicker.timepicker');
$this->breadcrumbs = array(
    'Cancel Booking',
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
?>
<div id="main">
    <div class="control-group">
        <div class="controls">
            <font size="5"><b>ยกเลิกการจอง</b></font>
            <br/>
            <span class="required">กรุณากรอกข้อมูลการจองให้ถูกต้อง</span>
        </div>
    </div>
    <?php
    echo $form->textFieldRow($model, 'PIN', array('class' => 'input-small',));
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
                'language' => 'th',
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
</div>
<?php
echo $form->textFieldRow($model, 'num_of_booking_table', array('class' => 'input-small',));
?>
<!-- check booking details status button -->
<div class="control-group" id="status">
    <label class="control-label" for="Customers_C_time">
        ตรวจสอบข้อมูล
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
                    'url' => CController::createUrl('Customers/Check_booking_status'),
                    'update' => '#submit',
                    'data' => array(
                        'jdate' => 'js:$("#Customers_jdate").val()',
                        'hour' => 'js:$("#Customers_C_time").val()',
                        'minutes' => 'js:$("#Customers_drpMinute").val()',
                        'table_amount' => 'js:$("#Customers_num_of_booking_table").val()',
                        'pin' => 'js:$("#Customers_PIN").val()',
                    ),
                )
            )
        ));
        echo '<br/><br/>';
        ?>
    </div>
    <div class="controls" id="submit">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'ยกเลิกการจอง',
            'buttonType' => 'submit',
            'htmlOptions' => array(
                'name' => 'submit_cancel',
            ),
            'disabled' => true,
        ));
        ?>
    </div>
</div>
<?php
$this->endWidget();
?>




