<!-- Booking Now -->
<?php
date_default_timezone_set('Asia/Bangkok');
?>
<div class="span6">
    <?php
    $r_zone = new RZone();
    $zone = $r_zone->getName();
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
    echo $form->textFieldRow($model, 'C_name', array('class' => 'input-medium'));
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
                    'autoSize' => true,
                    'minDate' => 0,
                    'maxDate' => 'today',
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
            $HH = date('H');
            $MM = date('i');
            echo $form->dropDownList($model, 'C_time', array($HH => $HH), array('class' => 'input-small'));
            echo " : ";
            echo $form->dropDownList($model, 'drpMinute', array($MM => $MM), array('class' => 'input-small'));
            echo $form->error($model, 'C_time');
            echo $form->error($model, 'drpMinute');
            ?>
        </div>
    </div>
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
                            'jdate' => 'js:$("#Customers_jdate").val()',
                            'hour' => 'js:$("#Customers_C_time").val()',
                            'minutes' => 'js:$("#Customers_drpMinute").val()',
                        ),
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
</div>
<div class="span5">
    <!-- show zone images -->
    <?php
    foreach ($zone as $value) {
        echo '<b>' . $value['zone'] . '</b><br/>';
        $image = Yii::app()->baseUrl . '/zone%20image/' . $value['zone_img'];
        echo "<img src=" . $image . " ><br/><br/>";
    }
    ?>
</div>
