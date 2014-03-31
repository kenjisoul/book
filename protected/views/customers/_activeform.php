<?php
include 'functions.php';
?>

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
                <td width = "30%" align="left"><?php ShowBookingTableDetails($rs['C_seats']); ?></td>
                <td width = "10%"><?php echo $rs['C_time']; ?></td>
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
                        $this->widget('bootstrap.widgets.TbButton', array(
                            'type' => '',
                            'id' => 'active',
                            'label' => 'ยืนยัน',
                            'buttonType' => 'submit',
                            'htmlOptions' => array(
                                'name' => 'submit_active',
                            ),
                        ));
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>    
</table>

