<?php
$this->breadcrumbs = array(
    'จัดการข้อมูลผู้จอง'
);
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'book',
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ))
);
?>
<div class="row" >
    <div class="span"></div>
    <div class="span8" id="show">
        <?php
        $this->widget('bootstrap.widgets.TbTabs', array(
            'type' => 'tabs',
            'placement' => 'above', // 'above', 'right', 'below' or 'left'
            'tabs' => array(
                array('label' => 'รายชื่อผู้ที่ยืนยันตัวแล้ว', 'content' => $this->renderPartial('_atvbooker', [], true), 'active' => true),
                array('label' => 'รายชื่อผู้ที่ยังไม่ได้ยืนยันตัว', 'content' => $this->renderPartial('_nonatvbooker', [], true)),
                array('label' => 'ตรวจสอบการจอง', 'content' => $this->renderPartial('_active', [], true)),
            ),
        ));
        ?>
    </div>
    <div class="span3" style="vertical-align: central" id="side">
        asdfasdf
    </div>
</div>
<?php
$this->endWidget();
?>