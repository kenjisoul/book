<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped condensed',
    'enablePagination' => true,
    'dataProvider' => Customers::model()->getBooker(0, 0),
    'template' => "{pager}\n{items}\n",
    'columns' => array(
        array(
            'name' => 'C_name',
            'header' => 'ชื่อ',
        ),
        array(
            'name' => 'C_seats',
            'header' => 'รายละเอียดการจอง',
            'value' => 'ShowBookingTableDetails($data->C_seats)',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),
        array(
            'name' => 'C_time',
            'header' => 'เวลา',
        ),
        array(
            'name' => 'PIN',
            'header' => 'PIN',
        ),
    ),
));
