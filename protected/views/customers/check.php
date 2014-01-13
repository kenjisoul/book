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
                <th >ชัวโมง</th>
                <th width = 20px></th>
                <th >นาที</th>
                <th width = 20px></th>
                <th >จำนวนที่ว่าง</th>
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
                        echo $form->dropDownList($model, 'drpMinute', array('empty' => 'เลือก'), array('class' => 'input-small',
                            'ajax' => array(
                                'type' => 'POST',
                                'url' => CController::createUrl('Customers/All'),
                                'update' => '#seats',
                                'data' => array('hour' => 'js:$("#C_time").val()', 'minutes' => 'js:this.value'),
                            ),
                            'multiple' => true, 'style' => 'height:180px;')
                        );
                        ?>
                    </div>
                </td>
                <td></td>
                <td style="vertical-align: top;" width="60%">
                    <div id="seats">
                        <table border="1" width="100%" style="text-align: center">
                            <tr style="background-color: gainsboro">
                                <td width="50%"><b>จำนวนที่นั่ง (คน / โต๊ะ)</b></td>
                                <td width="50%"><b>ว่าง (โต๊ะ)</b></td>
                            </tr>
                        </table>
                    </div>
                    </tb>
            </tr>
            <tr>
                <td><?php echo $form->error($model, 'C_time'); ?></td>
                <td></td>
                <td><?php echo $form->error($model, 'drpMinute'); ?></td>
                <td></td>
                <td ></td>
            </tr>
        </table>
    </div>
</div>  
<?php
$this->endWidget();
?>




