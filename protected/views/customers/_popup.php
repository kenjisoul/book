<!-- set pop up -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Modal header</h4>
</div>

<div class="modal-body">
    <table width="100%" border="0" class="items table-striped table-condensed">
        <thead>
            <tr>
                <th width="20%" style="color: #0080ee">ชื่อ</th>
                <th width="20%" style="color: #0080ee">จำนวนคน</th>
                <th width="20%" style="color: #0080ee">เวลา</th>
                <th width="20%" style="color: #0080ee">PIN</th>
                <th></th>
            </tr>
        </thead>
        <tbody align="center">
            <tr>
                <?php
                if ($rs == NULL) {
                    ?>
                    <td colspan="5">ไม่พบข้อมูลการจอง</td>
                    <?php
                } else {
                    ?>
                    <td width = "20%" ><?php echo $rs['C_name']; ?></td>
                    <td width = "20%" ><?php echo $rs['C_seats']; ?></td>
                    <td width = "20%" ><?php echo $rs['C_time']; ?></td>
                    <td width = "20%" ><?php echo $rs['PIN']; ?></td>
                    <td width = "20%">
                        <?php
                        if ($rs['C_active'] == 1) {
                            $this->widget('bootstrap.widgets.TbButton', array(
                                'type' => '',
                                'label' => 'ยืนยันตัวแล้ว',
                                'disabled' => true,
                            ));
                        } else {
                            ;
                            $this->widget('bootstrap.widgets.TbButton', array(
                                'type' => '',
                                'label' => 'ยืนยันการจอง',
                                'buttonType' => 'submit',
                                'htmlOptions' => array(
                                    'ajax' => array(
                                        'type' => 'POST',
                                        'url' => CController::createUrl('Customers/Active'),
                                        'update' => '#side',
                                        'data' => array(
                                            'pin' => $rs['PIN'],
                                        )
                                    )
                                ),
                            ));
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>    
    </table>
</div>