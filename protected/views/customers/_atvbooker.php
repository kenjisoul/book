<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped condensed',
    'dataProvider' => Customers::model()->getBooker(1),
    'template' => "{items}",
    'columns' => array(
        array(
            'name' => 'C_name',
            'header' => 'ชื่อ',
        ),
        array(
            'name' => 'C_seats',
            'header' => 'จำนวน',
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

