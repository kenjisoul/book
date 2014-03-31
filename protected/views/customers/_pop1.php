<!-- call queue's -->
<?php
$rs = CustomersController::pop1();
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'call',));
?>

<table width="100%" border="0" class="items table-striped table-condensed">
    <thead>
        <tr>
            <th width="20%" style="color: #0080ee">ชื่อ</th>
            <th width="20%" style="color: #0080ee">รายละเอียดการจอง</th>
            <th width="20%" style="color: #0080ee">เวลา</th>
            <th width="20%" style="color: #0080ee">PIN</th>
            <th style="color: #0080ee">เลือก</th>
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
                foreach ($rs as $value) {
                    ?>
                    <td width = "20%" ><?php echo $value['C_name']; ?></td>
                    <td width = "20%" align="left"><?php ShowBookingTableDetails($value['C_seats']); ?></td>
                    <td width = "20%" ><?php echo $value['C_time']; ?></td>
                    <td width = "20%" ><?php echo $value['PIN']; ?></td>
                    <td width = "20%" ><?php echo $form->checkbox($model, 'callbox', array('value' => $value["PIN"])); ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>    
</table>
<?php
$this->endWidget();
?>
