<?php
Yii::import('application.extensions.timepicker.timepicker');
$this->breadcrumbs = array(
    'Check Queue',
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
<div class = "control-group">
    <label class = "control-label" for = "Customers_C_time">
        เวลา
        <span class = "required"> * </span>
    </label>
    <div class = "controls">
        <table>
            <tr align="center">
                <th>ชัวโมง</th>
                <th width = 20px></th>
                <th>นาที</th>
                <th width = 20px></th>
                <th>จำนวนที่ว่าง</th>
            </tr>
            <tr>
                <td>
                    <div id="hour">
                        <?php
                        echo $form->dropDownList($model, 'C_time', $this->HH(), array(
                            'class' => 'input-small',
                            'id' => 'C_time',
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => CController::createUrl('Customers/MM'),
                                'update' => '#Customers_drpMinute',
                                'data' => array('hour' => 'js:this.value'),
                            ), 'multiple' => true,
                            'style' => 'height:180px;'
                        ));
                        ?>
                    </div>
                </td>
                <td></td>
                <td>
                    <div id="minute">
                        <?php
                        echo $form->dropDownList($model, 'drpMinute', array(), array('class' => 'input-small',
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => CController::createUrl('Customers/All'),
                                'update' => '#seats',
                                'data' => array('hour' => 'js:$("#C_time").val()', 'minutes' => 'js:this.value'),
                            ),
                            'multiple' => true, 'style' => 'height:180px;
                        '));
                        ?>
                    </div>
                </td>
                <td></td>
                <td>
                    <div id="seats"></div>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->error($model, 'C_time'); ?></td>
                <td></td>
                <td><?php echo $form->error($model, 'drpMinute'); ?></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
</div>  
<?php
$this->widget('widgets.CJuiDateTimePicker.CJuiDateTimePicker', array(
    'model' => $model,
    'attribute' => 'C_name',
    'mode' => 'time',
    'options' => array(
        'timeOnlyTitle' => 'เลือกเวลา',
        'hourMin' => (int) $hr_open,
        'hourMax' => (int) $hr_close,
        'hourGrid' => 1,
        'minuteGrid' => 10,
        'timeFormat' => 'hh : mm นาฬิกา',
        'buttonText' => 'Select',
        'showAnim' => 'slideDown',
        'showButtonPanel' => true,
        'showOn' => 'button',
        'addSliderAccess' => array('touchonly' => true),
    ),
    'htmlOptions' => array(
        'readonly' => true,
        'class' => 'input-small',
        'style' => 'height:20px;background-color:white;',
    ),
));
$this->endWidget();
?>




