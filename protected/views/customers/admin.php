<script type="text/javascript">
    window.onload = setupRefresh;

    function setupRefresh() {
        setTimeout("refreshPage();", 60000); // milliseconds
    }
    function refreshPage() {
        window.location = location.href;
    }
</script> 

<?php
require_once 'functions.php';
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
    <div class="span">&nbsp;</div>
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
    <div class="span3" style="text-align: center; margin-top: 36px">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'id' => 'search',
            'label' => 'เรียกคิว',
            'htmlOptions' => array(
                'style' => 'width: 125px',
                'data-toggle' => 'modal',
                'data-target' => '#call'
            )
        ));
        echo "<br/>";
        echo "<br/>";
        $this->widget('bootstrap.widgets.TbButton', array(
            'id' => 'search',
            'label' => 'เข้ารับบริการ(จองล่วงหน้า)',
            'htmlOptions' => array(
                'style' => 'width: 125px',
                'data-toggle' => 'modal',
                'data-target' => '#servicebook',
            )
        ));
        echo "<br/>";
        echo "<br/>";
        $this->widget('bootstrap.widgets.TbButton', array(
            'id' => 'search',
            'label' => 'เข้ารับบริการ(หน้าร้าน)',
            'htmlOptions' => array(
                'style' => 'width: 125px',
                'data-toggle' => 'modal',
                'data-target' => '#servicenonbook'
            )
        ));
        ?>
    </div>
</div>
<?php
$this->endWidget();
?>

<!-- Call Queue -->
<?php
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'call'));
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>เรียกคิว</h4>
</div>

<div class="modal-body">
    <?php
    $this->renderpartial('_pop1', array('model' => $model));
    ?>
</div>

<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'label' => 'Save changes',
        'htmlOptions' => array(
            'data-dismiss' => 'modal',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('Customers/Call'),
                'data' => array('pin' => 'js:$("#Customers_callbox:checked").serializeArray()'),
                "success" => 'js:function(){ location.reload(); }',
            )
        ),
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Close',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
</div>

<?php
$this->endWidget();
?>

<!-- Service (booking) -->
<?php
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'servicebook'));
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>เข้าใช้บริการ (จองล่วงหน้า)</h4>
</div>

<div class="modal-body">
    <?php $this->renderpartial('_pop2', array('model' => $model)); ?>
</div>

<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'label' => 'Save changes',
        'htmlOptions' => array(
            'data-dismiss' => 'modal',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('Customers/ServBook'),
                'data' => array('pin' => 'js:$("#Customers_servbookbox:checked").serializeArray()'),
                "success" => 'js:function(){ location.reload(); }',
            )
        ),
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Close',
        'url' => '#',
        'htmlOptions' => array(
            'data-dismiss' => 'modal',
        ),
    ));
    ?>
</div>

<?php
$this->endWidget();
?>

<!-- Service (non booking) -->
<?php
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'servicenonbook'));
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>เข้าใช้บริการ (หน้าร้าน)</h4>
</div>

<div class="modal-body">
    <?php $this->renderpartial('_pop3', array('model' => $model)); ?>
</div>

<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Close',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
</div>

<?php
$this->endWidget();
?>