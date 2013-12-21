<?php
$this->breadcrumbs = array(
    'จัดการข้อมูลผู้จอง'
);
?>
<div class="span8">
    <?php
    $this->widget('bootstrap.widgets.TbTabs', array(
        'type' => 'tabs',
        'placement' => 'above', // 'above', 'right', 'below' or 'left'
        'tabs' => array(
            array('label' => 'รายชื่อผู้ที่ยืนยันตัวแล้ว', 'content' => $this->renderPartial('_atvbooker', [], true), 'active' => true),
            array('label' => 'รายชื่อผู้ที่ยังไม่ได้ยืนยันตัว', 'content' => $this->renderPartial('_nonatvbooker', [], true)),
        ),
    ));
    ?>
</div>
