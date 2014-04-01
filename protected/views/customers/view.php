<?php
include 'functions.php';
$this->breadcrumbs = array(
    'Booking' => array('index'),
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

<h1>ชื่อผู้รับบริการ #<?php echo $name; ?></h1>
<table id="yw0" class="detail-view table table-striped table-condensed">
    <tbody>
        <tr class="odd">
            <th>  <?php echo $form->label($model, 'C_name'); ?></th>
            <td> <?php echo $name; ?> </td>
        </tr>
        <tr class="even">
            <th> <?php echo $form->label($model, 'jdate'); ?> </th>
            <td> <?php echo $jdate; ?> </td>
        </tr>
        <tr class="odd">
            <th> <?php echo $form->label($model, 'C_time'); ?> </th>
            <td> <?php echo $time; ?> </td>
        </tr>
        <tr class="even">
            <th> <?php echo $form->label($model, 'C_seats'); ?> </th>
            <td> <?php echo ShowBookingTableDetails($seat); ?> </td>
        </tr>
        <tr class="odd">
            <th> <?php echo $form->label($model, 'PIN'); ?> </th>
            <td> <?php echo $PIN; ?> </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <span class="required"> กรุณาเก็บรหัส PIN ไว้เพื่อใช้ในการยืนยันการจองก่อนเวลา 30 นาที หากไม่มีการยืนยันกับทางร้านจะถือว่าสละสิทธิ์ </span>
            </td>
        </tr>
    </tbody>
</table>
<?php
$this->endWidget();
?>