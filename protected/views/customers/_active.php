<?php
$this->breadcrumbs = array(
    'จัดการข้อมูลผู้จอง'
);
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ))
);
?>

<div class="row">
    <label class="control-label" for="Customers_C_time">
        PIN
        <span class="required"> * </span>
    </label>
    <div class="controls" >
        <?php
        echo $form->textField(Customers::model(), 'PIN', array());
        echo "\t";
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'button',
            'type' => '',
            'id' => 'search',
            'label' => 'ตรวจสอบการจอง',
            'htmlOptions' => array(
                'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('Customers/Bookdetails'),
                    'update' => '#detail',
                    'data' => array(
                        'pin' => 'js:$("#Customers_PIN").val()',
                    )
                )
            )
        ));
        ?>
    </div>
</div>
<div class="grid-view"></div>
<div id="detail">
    <table width="100%" border="0" class="items table-striped table-condensed">
        <thead>
            <tr>
                <th width="20%" style="color: #0080ee">ชื่อ</th>
                <th width="20%" style="color: #0080ee">รายละเอียดการจอง</th>
                <th width="20%" style="color: #0080ee">เวลา</th>
                <th width="20%" style="color: #0080ee">PIN</th>
                <th></th>
            </tr>
        </thead> 
    </table>
</div>

<?php
$this->endWidget();
?>